<?php declare(strict_types=1);

namespace Mercadona\Domain\Category\Service;

use Mercadona\Domain\Category\Category;

interface FindAndSaveCategory {
    public function findAndSave(Category $categoryId, ?Category $category = null): Category;
}