<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Commands\Category;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Mercadona\Application\Category\GetCategories;
use Throwable;

class GetCategoriesArtisanCommand extends Command
{
    protected $signature = 'get-categories';
    protected $description = '';

    public function __construct(
       private readonly GetCategories $getCategories
    )
    {
        parent::__construct();
    }
 
    public function handle(): void
    {
        try {
            $this->getCategories->execute();
        }catch(Throwable $e) {
            Log::info($e->getMessage());
        }
    }
}
