<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Repositories\Eloquent;

use Throwable;
use Illuminate\Support\Facades\DB;
use Mercadona\Category\Domain\Category;
use Mercadona\Product\Domain\ProductRepository;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Category\Domain\ValueObject\CategoryId;
use Mercadona\Category\Infrastructure\Models\CategoryEloquent;
use Mercadona\Category\Infrastructure\Transformers\CategoryDataTransformer;

final class EloquentCategoryRepository implements CategoryRepository
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {}

    public function find(CategoryId $categoryId): Category
    {
        try {
            $categoryDao = CategoryEloquent::with(["allChildrenCategories"])->findOrFail($categoryId->value());

            return CategoryDataTransformer::fromModel($categoryDao);
        }catch (Throwable $e) {
            throw $e;
        }
    }

    public function findAll(): CategoryCollection
    {
        $categoryEloquent = new CategoryEloquent();

        $categoryCollectionEloquent = $categoryEloquent->with("allChildrenCategories")->get();
        
        return CategoryDataTransformer::fromCollection($categoryCollectionEloquent);
    }

    public function save(Category $category): void
    {
        try{
            DB::beginTransaction();

            $categoryArray = CategoryDataTransformer::fromEntity($category);
            $categoryDao = CategoryEloquent::updateOrCreate(
                ['id' => $category->id()->value()],
                $categoryArray
            );
            
            $category->modifyId(new CategoryId($categoryDao->id));
    
            if (!$category->products()->isEmpty() && $category->isParent() === false) {
                foreach ($category->products() as $product) {
                    $this->productRepository->save($product);
                }
            }    

            DB::commit();
        }catch (Throwable $e) {
            dd($e->getMessage());
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
