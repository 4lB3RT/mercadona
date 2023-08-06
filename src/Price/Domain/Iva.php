<?php declare(strict_types=1);

namespace Mercadona\Price\Domain;

enum Iva: int
{
    case NONE = 0;
    case SUPERREDUCIDO_4 = 4;
    case SUPERREDUCIDO_5 = 5;
    case REDUCIDO = 10;
    case GENERAL = 21;
}