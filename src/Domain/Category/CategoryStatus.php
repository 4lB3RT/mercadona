<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

enum CategoryStatus
{
    case READY;
    case NOT_PROCESSED;
    case PROCESSED;
    case FAIL;
}