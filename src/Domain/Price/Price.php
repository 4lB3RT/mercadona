<?php declare(strict_types=1);

namespace Mercadona\Domain\Price;

final class Price
{
    public function __construct(
        public readonly ?PriceId $id,
        public readonly Iva $iva,
        public readonly bool $isNew,
        public readonly bool $isPack,
        public readonly ?float $packSize,
        public readonly ?int $unitName,        
        public readonly float $unitSize,        
        public readonly float $bulkPrice,        
        public readonly float $unitPrice,        
        public readonly bool $approxSize,        
        public readonly string $sizeFormat,        
        public readonly ?int $totalUnits,        
        public readonly bool $unitSelector,        
        public readonly bool $bunchSelector,        
        public readonly ?float $drainedWeight,        
        public readonly ?int $sellingMethod,        
        public readonly bool $priceDecreased,        
        public readonly float $referencePrice,        
        public readonly float $minBunchAmount,        
        public readonly string $referenceFormat,        
        public readonly float $incrementBunchAmount,        
    ) {
    }
}
