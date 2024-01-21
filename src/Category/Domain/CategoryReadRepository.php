<?php declare(strict_types=1);

namespace Mercadona\Category\Domain;

interface CategoryReadRepository {
    public function findParentCategories(): CategoryCollection;
    
    public function findDetailCategory(Category $category, ?Category $parent = null): Category;
}