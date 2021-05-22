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
