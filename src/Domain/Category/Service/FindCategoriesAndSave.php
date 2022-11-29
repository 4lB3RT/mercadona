<?php declare(strict_types=1);

namespace Mercadona\Domain\Category\Service;

use Mercadona\Domain\Category\CategoryCollection;

interface FindCategoriesAndSave {
    public function findAndSave(CategoryCollection $categories): CategoryCollection;
}