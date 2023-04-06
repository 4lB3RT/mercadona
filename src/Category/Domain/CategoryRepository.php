<?php declare(strict_types=1);

namespace Mercadona\Category\Domain;

interface CategoryRepository {
    public function find(CategoryId $categoryId): Category;

    public function findAll(): CategoryCollection; 

    public function save(Category $category): void;
    
    public function saveAll(CategoryCollection $categories): void;
}