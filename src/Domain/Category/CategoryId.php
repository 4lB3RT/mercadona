<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

final class CategoryId
{
    public function __consturct(
        private readonly int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }
}
