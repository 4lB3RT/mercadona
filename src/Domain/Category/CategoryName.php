<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

final class CategoryName
{
    public function __construct(
        public readonly string $value
    ) {
    }
}
