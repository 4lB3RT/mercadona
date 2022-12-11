<?php declare(strict_types=1);

namespace Mercadona\Domain\Photo;

use Mercadona\Shared\Domain\Entity;

final class Photo extends Entity
{
    public function __construct(
        public readonly ?PhotoId $id,
        public readonly string $zoom,
        public readonly string $regular,
        public readonly string $thumbnail,
        public readonly int $perspective,
    ) {
    }
}