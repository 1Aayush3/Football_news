<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GuzzleContoller extends Controller
{
    public function getRemoteData(){
        $client = new Client();
        $res = $client->request('GET', 'https://livescore-api.com/api-client/fixtures/matches.json?key=LLPdb8UjRIFuupej&secret=qAaiwvKfEqcat5oeQds2mnle51IzrXTS&league=25', []);
        $decodeData = json_decode($res->getBody(), true);
        $fixtures = $decodeData['data']['fixtures'];
        return view('pages.api.index',compact('fixtures'));
    }

    public function getData(Request $request){
        $id=$request->id;
        $client = new Client();
        $res = $client->request('GET', 'https://livescore-api.com/api-client/fixtures/matches.json?key=LLPdb8UjRIFuupej&secret=qAaiwvKfEqcat5oeQds2mnle51IzrXTS&league='.$id, []);
        $decodeData = json_decode($res->getBody(), true);
        $fixtures = $decodeData['data']['fixtures'];
        return response()->json($fixtures, 200);
    }
    public function welcome()
    {
        // dd('here');
        return view('layouts.welcome');
    }
}
