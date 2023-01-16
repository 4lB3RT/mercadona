<?php declare(strict_types=1);

namespace Mercadona\Domain\Photo;

use Mercadona\Shared\Domain\Entity;

final class Photo extends Entity
{
    public function __construct(
        private readonly ?PhotoId $id,
        private readonly string $zoom,
        private readonly string $regular,
        private readonly string $thumbnail,
        private readonly int $perspective,
    ) {
    }

    public function id(): ?PhotoId 
    {
    	return $this->id;
    }
    
    public function zoom(): string 
    {
    	return $this->zoom;
    }
    
    public function regular(): string 
    {
    	return $this->regular;
    }
    
    public function thumbnail(): string 
    {
    	return $this->thumbnail;
    }
    
    public function perspective(): int 
    {
    	return $this->perspective;
    }
}