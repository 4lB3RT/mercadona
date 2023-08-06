<?php declare(strict_types=1);

namespace Mercadona\Photo\Infrastructure\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Mercadona\Photo\Domain\Photo;
use Mercadona\Photo\Domain\PhotoId;
use Mercadona\Photo\Domain\PhotoCollection;
use Mercadona\Photo\Domain\PhotoRepository;
use Mercadona\Photo\Infrastructure\Models\PhotoEloquent;
use Mercadona\Photo\Infrastructure\Transformers\PhotoDataTransformer;
use Throwable;

final class EloquentPhotoRepository implements PhotoRepository
{
    public function find(PhotoId $photoId): Photo
    {
        return PhotoEloquent::fromModel(PhotoEloquent::findOrFail($photoId->value()));
    }

    public function save(Photo $photo): void
    {
        try{
            DB::beginTransaction();
            
            $photoArray = PhotoDataTransformer::fromEntity($photo);
            $photoDao = PhotoEloquent::updateOrCreate(
                ['id' => $photo->id()?->value()],
                $photoArray
            );
        
            $photo->modifyId(new PhotoId($photoDao->id));

            DB::commit();
        }catch (Throwable $e) {
            DB::rollBack();
        }
    }

    public function saveAll(PhotoCollection $photos): void
    {
         /** @var Photo $photo */
         foreach ($photos->items() as $photo) {
            $photoCollection[] = $this->save($photo);
        }
    }
}