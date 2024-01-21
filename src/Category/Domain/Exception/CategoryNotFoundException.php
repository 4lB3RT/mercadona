<?php declare(strict_types=1);

namespace Mercadona\Category\Domain;

use Mercadona\Category\Domain\ValueObject\CategoryId;
use Mercadona\Shared\Domain\DomainException;

final class CategoryNotFoundException extends DomainException
{
    public function __construct(CategoryId $categoryId)
    {
        $message = "Category with ID {$categoryId} not found";
        parent::__construct($message);
    }
}
