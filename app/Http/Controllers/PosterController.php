<?php

namespace App\Http\Controllers;

use App\Components\ImportDataClient;
use App\Models\Category;
use App\Models\Poster;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PosterController extends Controller
{
    public function create()
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

    public function sortByDate(): JsonResponse
    {
        $posters = DB::table('posters')->orderBy('date')->get();
        return Response()->json($posters);
    }

    public function sortByPrice(): JsonResponse
    {
        $posters = DB::table('posters')->orderBy('price')->get();
        return Response()->json($posters);
    }

    public function showPoster($id) : JsonResponse
    {
        $poster = Poster::find($id);
        return Response()->json($poster);
    }

}
