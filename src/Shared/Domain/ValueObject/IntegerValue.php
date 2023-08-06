<?php declare(strict_types=1);

namespace Mercadona\Shared\Domain\ValueObject;

abstract class IntegerValue
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
