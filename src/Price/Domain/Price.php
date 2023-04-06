<?php declare(strict_types=1);

namespace Mercadona\Price\Domain;

final class Price {
    public function __construct(
        private readonly ?PriceId $id,
        private readonly Iva $iva,
        private readonly bool $isNew,
        private readonly bool $isPack,
        private readonly ?float $packSize,
        private readonly ?int $unitName,        
        private readonly float $unitSize,        
        private readonly float $bulkPrice,        
        private readonly float $unitPrice,        
        private readonly bool $approxSize,        
        private readonly string $sizeFormat,        
        private readonly ?int $totalUnits,        
        private readonly bool $unitSelector,        
        private readonly bool $bunchSelector,        
        private readonly ?float $drainedWeight,        
        private readonly ?int $sellingMethod,        
        private readonly bool $priceDecreased,        
        private readonly float $referencePrice,        
        private readonly float $minBunchAmount,        
        private readonly string $referenceFormat,        
        private readonly float $incrementBunchAmount,        
    ) {
    }

    public function id(): ?PriceId
    {
    	return $this->id;
    }
    
    public function iva(): Iva
    {
    	return $this->iva;
    }
    
    public function isNew(): bool
    {
    	return $this->isNew;
    }
    
    public function isPack(): bool
    {
    	return $this->isPack;
    }
    
    public function packSize(): ?float
    {
    	return $this->packSize;
    }
    
    public function unitName(): ?int
    {
    	return $this->unitName;
    }
    
    public function unitSize(): float
    {
    	return $this->unitSize;
    }
    
    public function bulkPrice(): float
    {
    	return $this->bulkPrice;
    }
    
    public function unitPrice(): float
    {
    	return $this->unitPrice;
    }
    
    public function approxSize(): bool
    {
    	return $this->approxSize;
    }
    
    public function sizeFormat(): string
    {
    	return $this->sizeFormat;
    }
    
    public function totalUnits(): ?int
    {
    	return $this->totalUnits;
    }
    
    public function unitSelector(): bool
    {
    	return $this->unitSelector;
    }
    
    public function bunchSelector(): bool
    {
    	return $this->bunchSelector;
    }
    
    public function drainedWeight(): ?float
    {
    	return $this->drainedWeight;
    }
    
    public function sellingMethod(): ?int
    {
    	return $this->sellingMethod;
    }
    
    public function priceDecreased(): bool
    {
    	return $this->priceDecreased;
    }
    
    public function referencePrice(): float
    {
    	return $this->referencePrice;
    }
    
    public function minBunchAmount(): float
    {
    	return $this->minBunchAmount;
    }
    
    public function referenceFormat(): string
    {
    	return $this->referenceFormat;
    }
    
    public function incrementBunchAmount(): float
    {
    	return $this->incrementBunchAmount;
    }
}
