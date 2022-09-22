<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class GiphyController extends Controller
{
    public function giphySearch(Request $request){

        // Validate Request
        $this->validate($request, [
            'search_query' => 'required'
        ]);

        // Giphy Request
        $response = Http::asForm()->get('api.giphy.com/v1/gifs/random', [
            'api_key' => config('services.giphy.key'),
            'tag' => $request->search_query
        ]);

        // Decode body to json obj
        $data = json_decode($response->getBody()->getContents());

        // Grab giphy image obj
        $giphyObject = $data->data;

        // Check for valid image
        if( !isset( $giphyObject->url ) ) return back()->with(['status' => 'Error generating image!']);

        // Create history log
        UserHistory::create([
            'user'=>Auth::id(),
            'search'=>$request->search_query,
            'return'=>$giphyObject->url
        ]);

        return back()->with(['status' => 'Image Generated!', "result" => $giphyObject->images->original->url]);
    }
}
