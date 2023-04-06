<?php declare(strict_types=1);

namespace Mercadona\Price\Domain;

interface PriceRepository 
{
    public function find(PriceId $priceId): Price;

    public function save(Price $price): Price;

    public function saveAll(PriceCollection $prices): PriceCollection;
}