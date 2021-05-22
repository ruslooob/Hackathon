<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Poster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class ImportPostersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:posters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get posters from back-poster.admlr.lipetsk.ru';

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
        $posters = $import->client->request('GET', 'posters');
        $posters = json_decode($posters->getBody()->getContents())->results;


        foreach ($posters as $poster) {
            $poster = (array)($poster);
            $categoryId = $poster['categories']->id;
            $posterId = $poster['id'];

            if (!Poster::find($poster['id'])) {
                $poster['date'] = $poster['date']->lower;

                $poster = Poster::create($poster);
                DB::table('category_poster')->insert(
                    ['category_id' => $categoryId, 'poster_id' => $posterId],
                );
//                $poster = Poster::create($poster)->each(function($poster) use($posterId, $categoryId) {
//                    $poster->pivot->poster_id = $posterId;
//                    $poster->pivot->category_id = $categoryId;
//                });
            }
        }
    }
}
