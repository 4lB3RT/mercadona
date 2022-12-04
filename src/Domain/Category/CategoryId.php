<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

final class CategoryId
{
    public function __construct(
        public readonly int $value
    ) {
    }
}
