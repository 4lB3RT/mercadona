<?php declare(strict_types=1);

namespace Mercadona\Photo\Infrastructure\Transformers;

use Mercadona\Photo\Domain\Photo;
use Mercadona\Shared\Domain\Collection;
use Mercadona\Photo\Domain\PhotoCollection;
use Mercadona\Photo\Domain\PhotoId;

final class PhotoDataTransformer
{
    public static function fromArray(array $result): Photo
    {
        return new Photo(
            isset($result["id"]) ? new PhotoId((int) $result["id"]) : null,
            $result["zoom"],
            $result["regular"],
            $result["thumbnail"],
            $result["perspective"]
        );
    }

    public static function fromArrays(array $photosArray): PhotoCollection
    {
        $photos = [];
        foreach ($photosArray as $photoArray) {
            $photos[] = self::fromArray($photoArray);
        }

        return new PhotoCollection($photos);
    }

    public static function fromEntity(Photo $photo): array
    {
       return [
            "id" => $photo->id()?->value(),
            "zoom" => $photo->zoom(),
            "regular" => $photo->regular(),
            "thumbnail" => $photo->thumbnail(),
            "perspective" => $photo->perspective(),
        ];
    }

    public static function fromEntities(PhotoCollection $photos): array
    {
        $photosArray = [];

        /** @var Product $product */
        foreach ($photos as $photo) {
            $photosArray[] = self::fromEntity($photo);
        }

        return $photosArray;
    }

    public static function fromCollection(Collection $collection): PhotoCollection
    {
        $photos = [];
        /** @var Model $model */
        foreach ($collection as $model) {
            $photos[] = self::fromModel($model);
        }

        return new PhotoCollection($photos);
    }

    public static function fromModel(Model $model): Photo
    {
        return new Photo(
            new PhotoId($model->id),
            $model->zoom,
            $model->regular,
            $model->thumbnail,
            $model->perspective
        );
    }

}
