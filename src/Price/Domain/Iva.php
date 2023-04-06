<?php declare(strict_types=1);

namespace Mercadona\Price\Domain;

enum Iva: int
{
    case NONE = 0;
    case SUPERREDUCIDO = 4;
    case REDUCIDO = 10;
    case GENERAL = 21;
}