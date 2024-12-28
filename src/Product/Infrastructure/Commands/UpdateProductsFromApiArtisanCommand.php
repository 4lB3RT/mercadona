<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mercadona\Category\Application\SaveCategoriesFromApi\SaveCategoriesFromApi;
use Mercadona\Product\Application\UpdateProductsFromApi\UpdateProductsFromApi;
use Throwable;

class UpdateProductsFromApiArtisanCommand extends Command
{
    protected $name = "update-products";
    protected $signature = 'update-products';
    protected $description = 'Command that update products from api data';

    public function __construct(
       private readonly UpdateProductsFromApi $updateProductsFromApi
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $this->updateProductsFromApi->execute();
        }catch(Throwable $e) {
            Log::info($e->getMessage());
        }
    }
}
