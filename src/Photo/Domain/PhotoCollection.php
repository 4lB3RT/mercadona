<?php declare(strict_types=1);

namespace Mercadona\Photo\Domain;

use Mercadona\Shared\Domain\Collection;

final class PhotoCollection extends Collection
{
    public function type(): string
    {
        return Photo::class;
    }
}
