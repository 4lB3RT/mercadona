<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

use DomainException;
use Mercadona\Shared\Domain\Exception\NotFoundException;

final class ProductNotFoundException extends DomainException
{
    public function __construct(ProductId $productId)
    {
        parent::__construct(sprintf('Product with id %s not found', $productId->value()));
    }
}
