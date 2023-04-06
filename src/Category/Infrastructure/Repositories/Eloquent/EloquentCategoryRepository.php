<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Repositories\Eloquent;

use Throwable;
use Illuminate\Support\Facades\DB;
use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryId;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Category\Infrastructure\Models\CategoryEloquent;
use Mercadona\Category\Infrastructure\Repositories\Transformers\CategoryDataTransformer;
use Mercadona\Product\Domain\ProductRepository;

final class EloquentCategoryRepository implements CategoryRepository
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {}

    public function find(CategoryId $categoryId): Category
    {
        return CategoryDataTransformer::fromModel(CategoryEloquent::with("categories", "products")->findOrFail($categoryId->value()));
    }

    public function findAll(): CategoryCollection
    {
        $categoryEloquent = new CategoryEloquent();

        $categoryCollectionEloquent = $categoryEloquent->with("categories", "products")->get();
        
        return CategoryDataTransformer::fromCollection($categoryCollectionEloquent);
    }

    public function save(Category $category): void
    {
        try{
            DB::beginTransaction();
            
            $categoryArray = CategoryDataTransformer::fromEntity($category);
            $dao = CategoryEloquent::updateOrCreate(
                ['id' => $category->id()->value()],
                $categoryArray
            );
    
            if (!$category->products()->isEmpty()) {
                foreach ($category->products() as $product) {
                    $this->productRepository->save($product);
                }
    
                $dao->products()->sync(
                    $category->products()->ids()
                );
            }    

            DB::commit();
        }catch (Throwable $e) {
            DB::rollBack();
        }
    }

    public function saveAll(CategoryCollection $categories): void
    {
        /** @var Category $category */
        foreach ($categories->items() as $category) {
            $this->save($category);

            if ($category->categories()->isEmpty() === false) {
                $this->saveAll($category->categories());
            }
        }
    }
}
