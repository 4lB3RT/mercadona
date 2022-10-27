<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

final class CategoryName
{
    public function __consturct(
        private readonly string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
