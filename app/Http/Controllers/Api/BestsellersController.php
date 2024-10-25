<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

use App\Rules\ISBNRule;
use App\Rules\OffsetRule;


use App\Http\Requests\BestsellersRequest;

class BestsellersController extends Controller
{
    public $url = 'https://api.nytimes.com/svc/books/v3/lists/best-sellers/history.json?%s';

    /**
     * Display a listing of the resource.
     */
    public function index(BestsellersRequest $request)
    {
        $api_key = config('services.nyt.key');

        $data = array(
            'api-key' =>$api_key,
            'author' => $request->get('author'),
            'title' => $request->get('title'),
            'isbn' => $request->get('isbn'),
            'offset' => $request->get('ofset'),
        );

        $query = http_build_query($data);
        $bestsellers_url = sprintf($this->url, $query);
        $response = Http::get($bestsellers_url);

        if($response->status() == 200)
        {
            return response()->json(['offset'=>$request->get('ofset'), 'bestsellers'=>$response->body()]);
        }
        else
        {
            Log::error("Remote NYT request failed: " . $response->body());
            return response($response->body(), 502);
        }
    }
}
