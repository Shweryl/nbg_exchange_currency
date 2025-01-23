<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($base = 'USD', $symbols = 'SGD,EUR')
    {
        // $url = 'https://api.freecurrencyapi.com/v1/latest';

        $url = 'https://api.freecurrencyapi.com/v1/status';
        $apiKey = config('services.freecurrency.api_key');


        $response = Http::get($url, [
            'apikey' => $apiKey,
            // 'date' => '2023-10-03',
            // 'base_currency' => $base,
            // 'currencies' => $symbols,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return ['error' => 'Unable to fetch exchange rates.'];
    }
}
