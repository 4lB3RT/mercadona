<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

interface FinderCategoryRepository {
    public function findCategories(): CategoryCollection;
}