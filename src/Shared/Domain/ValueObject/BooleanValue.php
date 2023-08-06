<?php declare(strict_types=1);

namespace Mercadona\Shared\Domain\ValueObject;

abstract class BooleanValue
{
    public function __construct(
        private readonly bool $value
    ) {
    }

    public function value(): bool
    {
        return $this->value;
    }
}
