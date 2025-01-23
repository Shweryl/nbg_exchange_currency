<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    // public function exchange(Request $request){

    //     $response = $this->getCurrencyRate($request->from, $request->to);

    //     if(isset($response['data'])){

    //         $results = [
    //             'from' => $request->from,
    //             'to' => $request->to,
    //             'amount' => $request->amount,
    //             'rate' => $response['data'][$request->to],
    //             'result' => $response['data'][$request->to] * $request->amount
    //         ];

    //         return view('welcome', compact('results'));
    //     }



    //     return back()->with('error', 'Currecy not found');
    // }

    // public function getCurrencyRate($base= 'USD', $target = 'SGD'){
    //     $url = 'https://api.freecurrencyapi.com/v1/latest';
    //     $apiKey = config('services.freecurrency.api_key');

    //     $response = Http::get($url, [
    //         'apikey' => $apiKey,
    //         'base_currency' => $base,
    //         'currencies' => $target,
    //     ]);


    //     if ($response->successful()) {
    //         return $response->json();
    //     };

    //     return ['error' => 'Unable to fetch exchange rates.'];

    // }

    // public function welcome(){
    //     $response = $this->getCurrencyRate();

    //     if(isset($response['data'])){

    //         $results = [
    //             'from' => 'USD',
    //             'to' => 'SGD',
    //             'amount' => 1,
    //             'rate' => $response['data']['SGD'],
    //             'result' => $response['data']['SGD'],
    //         ];

    //         return view('welcome', compact('results'));
    //     }

    //     return view('welcome', ['error' => 'Server Error']);
    // }


    public function exchange(Request $request){

        $currency = $this->fetchCurrency($request->from, $request->to);

        $reverse = $this->fetchCurrency($request->to, $request->from);

        $results = [
            'from' => $currency->from,
            'to' => $currency->to,
            'rate' => $currency->rate,
            'amount' => $request->amount,
            'result' => round($request->amount * $currency->rate, 4)
        ];

        $restCurrencies = $this->restCurrencies($request->from);

        return view('welcome', compact('results', 'reverse', 'restCurrencies'));
    }


    public function welcome(){

        $currency = $this->fetchCurrency('USD', 'SGD');

        $reverse = $this->fetchCurrency('SGD', 'USD');

        $results = [
            'from' => $currency->from,
            'to' => $currency->to,
            'rate' => $currency->rate,
            'amount' => 1,
            'result' => round($currency->rate, 4)
        ];

        $restCurrencies = $this->restCurrencies('USD');

        return view('welcome', compact('results', 'reverse', 'restCurrencies'));
    }


    public function fetchCurrency($from , $to){
        $currency = ExchangeRate::where('from', $from)
                                        ->where('to', $to)
                                        ->first();

        return $currency;
    }


    public function restCurrencies($from){
        $currencies = ['USD', 'PHP', 'JPY','SGD', 'THB'];

        $restCurrencies = array_filter($currencies, function($currency) use($from){
            return $currency != $from;
        });

        return $restCurrencies;
    }

}
