<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

interface CategoryReadRepository {
    public function findParentCategories(): CategoryCollection;
    
    public function findDetailCategory(Category $categories, ?Category $parent = null): Category;
}