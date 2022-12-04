<?php declare(strict_types=1);

namespace Mercadona\Shared\Infrastructure\Presenters;

use Mercadona\Shared\Application\Response;

interface JsonPresenter
{
    public function toJson(Response $response): array;
}
