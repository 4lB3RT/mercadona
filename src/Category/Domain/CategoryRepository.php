<?php declare(strict_types=1);

namespace Mercadona\Category\Domain;

use Mercadona\Category\Domain\ValueObject\CategoryId;

interface CategoryRepository {
    public function find(CategoryId $categoryId): Category;

    public function findAll(): CategoryCollection; 

    public function save(Category $category): void;
    
    public function saveAll(CategoryCollection $categories): void;
}