<?php declare(strict_types=1);

namespace Mercadona\Category\Domain\ValueObject;

use Mercadona\Shared\Domain\Collection;

final class CategoryIdCollection extends Collection
{
    public function type(): string
    {
        return CategoryId::class;
    }
}
