<?php declare(strict_types=1);

namespace Mercadona\Shared\Domain\ValueObject;

abstract class StringValue
{
    public function __construct(
        private readonly string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
