<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mercadona\Category\Application\SaveCategoriesFromApi\SaveCategoriesFromApi;
use Throwable;

class SaveCategoriesFromApiArtisanCommand extends Command
{
    protected $name = "save-categories";
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
            dd($e->getMessage());
            Log::info($e->getMessage());
        }
    }
}