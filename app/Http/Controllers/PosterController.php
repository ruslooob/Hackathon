<?php

namespace App\Http\Controllers;

use App\Components\ImportDataClient;
use App\Models\Poster;
use Illuminate\Http\Request;

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
}
