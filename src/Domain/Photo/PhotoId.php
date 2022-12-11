<?php declare(strict_types=1);

namespace Mercadona\Domain\Photo;

final class PhotoId
{
    public function __construct(
        public readonly int $value
    ) {
    }
}
