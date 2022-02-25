<?php

use Illuminate\Support\Facades\Http;

function callApiClient($url, $response_type)
{
    $response = Http::get($url);

    switch ($response_type) {
        case 'body':
            return $response->body();
            break;

        case 'json':
            return $response->json($key = null);
            break;

        case 'object':
            return $response->object();
            break;

        default:
            return $response;
            break;
    }

}
