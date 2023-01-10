<?php declare(strict_types=1);

namespace Mercadona\Shared\Domain;

abstract class IntegerId
{
    public function __construct(
        private readonly int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }
}
