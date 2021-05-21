<?php

namespace App\Http\Controllers;

use App\Components\ImportDataClient;
use App\Models\Category;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosterController extends Controller
{
    public function create() {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'posters');
        $data = json_decode($response->getBody()->getContents())->results;

        foreach ($data as $item) {
            $item = (array)($item);
            $item['date'] = $item['date']->lower;
            $poster = Poster::create($item);
        }
    }

    public function sortByDate() {
        $posters = DB::table('posters')->orderBy('date')->get();
        return $posters;
    }

    public function sortByPrice() {
        $posters = DB::table('posters')->orderBy('price')->get();
        return $posters;
    }

    public function filterByCategories($id) {
        $postersID = DB::table('category_poster')->where('category_id', $id)->get();

        $posters = [];
        foreach ($postersID as $posterId) {
           array_push($posters, DB::table('posters')->find($posterId->poster_id));
        }
        return $posters;
    }
}
