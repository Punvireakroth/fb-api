<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;


class ApiFetchController extends Controller
{


    public function fetchData()
    {
        $url = "https://graph.facebook.com/v19.0/me/feed?access_token=" . env('FACEBOOK_ACCESS_TOKEN');

        // dd($url);

        $headers = [
            'Content-Type' => 'application/json'
        ];
        $data = "";
        $method = "GET";

        $response = $this->sendRequestData($url, $method, $data, $headers);

        return $response;
    }

    private function sendRequestData($url, $method, $data, $headers)
    {
        switch ($method) {
            case 'GET':
                $response = Http::withHeaders($headers)->get($url);
                break;
            case 'POST':
                $response = Http::withHeaders($headers)->post($url, $data);
                break;
            case 'PUT':
                $response = Http::withHeaders($headers)->put($url, $data);
                break;
            case 'DELETE':
                $response = Http::withHeaders($headers)->delete($url);
                break;
            default:
                $response = null;
                break;
        }

        $code = $response->status();

        return compact("response", "code");
    }

}