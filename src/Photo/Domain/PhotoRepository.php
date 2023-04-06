<?php declare(strict_types=1);

namespace Mercadona\Photo\Domain;

interface PhotoRepository 
{
    public function find(PhotoId $photoId): Photo;

    public function save(Photo $photo): Photo;

    public function saveAll(PhotoCollection $photos): PhotoCollection;
}