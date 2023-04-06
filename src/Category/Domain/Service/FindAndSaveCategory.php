<?php declare(strict_types=1);

namespace Mercadona\Category\Domain\Service;

use Mercadona\Category\Domain\Category;

interface FindAndSaveCategory {
    public function findAndSave(Category $categoryId, ?Category $category = null): Category;
}