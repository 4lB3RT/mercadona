<?php declare(strict_types=1);

namespace Tests\Mercadona\Photo\Domain;

use Mercadona\Photo\Domain\PhotoId;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class PhotoIdExample {

    public static function dummy(): PhotoId
    {
        return new PhotoId(1);
    }

    public static function create(
        ?PhotoId $photoId = null
    ): PhotoId {
        return $photoId ?? self::random();
    }

    public static function random(): PhotoId
    {
        return new PhotoId(IntegerExample::random());
    }
}