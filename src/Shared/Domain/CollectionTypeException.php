<?php declare(strict_types=1);

namespace Mercadona\Shared\Domain;

use DomainException;

final class CollectionTypeException extends DomainException
{
    const MESSAGE = "The entity type is nos same as collection";

    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
