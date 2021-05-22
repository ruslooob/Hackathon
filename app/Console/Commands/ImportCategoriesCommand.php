<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Category;
use Illuminate\Console\Command;

class ImportCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get categories from back-poster.admlr.lipetsk.ru';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $import = new ImportDataClient();
        $categories = $import->client->request('GET', 'categories');
        $categories = json_decode($categories->getBody()->getContents());

        foreach ($categories as $category) {
            $category = (array)$category;
            if (!Category::find($category['id'])) {
                Category::create($category);
            }
        }
    }
}
