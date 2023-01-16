<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Photo;

use Mercadona\Domain\Photo\Photo;
use Mercadona\Domain\Photo\PhotoId;
use Tests\Mercadona\Shared\Domain\IntegerExample;
use Tests\Mercadona\Shared\Domain\StringExample;

final class PhotoExample {

    public static function dummy(): Photo
    {
        return new Photo(
            id: new PhotoId(1),
            zoom: "https://example.com/zoom.jpg",
            regular: "https://example.com/regular.jpg",
            thumbnail: "https://example.com/thumbnail.jpg",
            perspective: 2
        );
    }

    public static function random(): Photo
    {
        return new Photo(
            id: PhotoIdExample::random(),
            zoom: StringExample::random(),
            regular: StringExample::random(),
            thumbnail: StringExample::random(),
            perspective: IntegerExample::random()
        );
    }
}