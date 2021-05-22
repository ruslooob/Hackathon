<?php

namespace App\Http\Controllers;

use App\Components\ImportDataClient;
use App\Models\Category;
use App\Models\Poster;
use Illuminate\Http\JsonResponse;
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

    public function filterByCategories($id): JsonResponse
    {
//        $postersID = DB::table('category_poster')->where('category_id', $id)->get();
//
//        $posters = [];
//        foreach ($postersID as $posterID) {
//            array_push($posters, DB::table('posters')->find($posterID->poster_id));
//        }
        $import = new ImportDataClient();

        $posters = $import->client->request('GET', 'posters-by-category/' . $id);
        $posters = json_decode($posters->getBody()->getContents());
        return Response()->json($posters);


    }

    public function showPoster($id): JsonResponse
    {
//        $poster = Poster::find($id);
        $import = new ImportDataClient();
        $poster = $import->client->request('GET', 'posters/' . $id);
        $poster = json_decode($poster->getBody()->getContents());
        return Response()->json($poster);
    }

    public function indexPoster()
    {
        $import = new ImportDataClient();
        $posters = $import->client->request('GET', 'posters/');
        $posters = json_decode($posters->getBody()->getContents());
        return Response()->json($posters);
    }

}
