<?php declare(strict_types=1);

declare(strict_types=1);

namespace Mercadona\Shared\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection implements Countable, IteratorAggregate
{
    public function __construct(protected readonly array $items)
    {
        Assert::arrayOf($this->type(), $items);
    }

    abstract protected function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function count(): int
    {
        return count($this->items());
    }

    public function items(): array
    {
        return $this->items;
    }

    public static function empty(): static
    {
        return new static([]);
    }

    public function isEmpty(): bool
    {
        return empty($this->items) ? true : false;
    }

    public function ids(): array
    {
        $itemsIds = [];
        foreach ($this->items() as $item) {
            $itemsIds[] = (int) $item->id->value;
        }

        return $itemsIds;
    }
}