<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mercadona\Category\Application\SaveCategoriesFromApi\SaveCategoriesFromApi;
use Throwable;

class SaveProductsFromApiArtisanCommand extends Command
{
    protected $name = "save-products";
    protected $signature = 'save-products';
    protected $description = '';

    public function __construct(
       private readonly SaveCategoriesFromApi $getCategoriesFromApi
    )
    {
        parent::__construct();
    }
 
    public function handle(): void
    {
        try {
            $this->getCategoriesFromApi->execute();
        }catch(Throwable $e) {
            Log::info($e->getMessage());
        }
    }
}