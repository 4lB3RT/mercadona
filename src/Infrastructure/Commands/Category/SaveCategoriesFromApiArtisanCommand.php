<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Commands\Category;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mercadona\Application\Category\SaveCategoriesFromApi;
use Throwable;

class SaveCategoriesFromApiArtisanCommand extends Command
{
    protected $signature = 'save-categories';
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