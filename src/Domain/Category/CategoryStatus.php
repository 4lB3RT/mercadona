<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

enum CategoryStatus: string
{
    case READY = "READY";
    case NOT_PROCESSED = "NOT_PROCESSED";
    case PROCESSED = "PROCESSED";
    case FAIL = "FAIL";
}