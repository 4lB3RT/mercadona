<?php declare(strict_types=1);

namespace Mercadona\Price\Domain;

use Mercadona\Shared\Domain\Collection;

final class PriceCollection extends Collection
{
    public function type(): string
    {
        return Price::class;
    }
}
