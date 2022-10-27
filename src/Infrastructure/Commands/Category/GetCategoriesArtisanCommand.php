<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Commands\Category;

use Illuminate\Console\Command;
use Mercadona\Application\Category\GetCategories;

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
        $this->getCategories->execute();
    }
}
