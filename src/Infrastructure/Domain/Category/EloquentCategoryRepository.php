<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Illuminate\Support\Facades\DB;
use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryId;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Product\ProductRepository;
use Throwable;

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
