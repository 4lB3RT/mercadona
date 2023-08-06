<?php declare(strict_types=1);

namespace Mercadona\Photo\Domain;

interface PhotoRepository 
{
    public function find(PhotoId $photoId): Photo;

    public function save(Photo $photo): void;

    public function saveAll(PhotoCollection $photos): void;
}