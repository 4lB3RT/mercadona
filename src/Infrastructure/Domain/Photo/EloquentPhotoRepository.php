<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Photo;

use Mercadona\Domain\Photo\Photo;
use Mercadona\Domain\Photo\PhotoCollection;
use Mercadona\Domain\Photo\PhotoId;
use Mercadona\Domain\Photo\PhotoRepository;

final class EloquentPhotoRepository implements PhotoRepository
{
    public function find(PhotoId $photoId): Photo
    {
        return PhotoEloquent::fromModel(PhotoEloquent::findOrFail($photoId->value()));
    }

    public function save(Photo $photo): Photo
    {
        $photoEloquent = new PhotoEloquent();
        $photoArray = PhotoDataTransformer::fromEntity($photo);
        $photoEloquentSaved = $photoEloquent->updateOrCreate(
            ['id' => $photo->id()?->value()],
            $photoArray
        );

        return PhotoDataTransformer::fromModel($photoEloquentSaved);
    }

    public function saveAll(PhotoCollection $photos): PhotoCollection
    {
        $photoCollection = [];
         /** @var Photo $photo */
         foreach ($photos->items() as $photo) {
            $photoCollection[] = $this->save($photo);
        }

        return new PhotoCollection($photoCollection);
    }
}