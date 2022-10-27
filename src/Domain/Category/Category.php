<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

final class Category
{
    public function __constryct(
        private readonly CategoryId $id,
        private readonly CategoryName $name,
    ) {}

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }
}
