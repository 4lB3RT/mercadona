<?php declare(strict_types=1);

namespace Mercadona\Photo\Infrastructure\Repositories\Eloquent;

use Mercadona\Photo\Domain\Photo;
use Mercadona\Photo\Domain\PhotoId;
use Mercadona\Photo\Domain\PhotoCollection;
use Mercadona\Photo\Domain\PhotoRepository;
use Mercadona\Photo\Infrastructure\Models\PhotoEloquent;
use Mercadona\Photo\Infrastructure\Transformers\PhotoDataTransformer;

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