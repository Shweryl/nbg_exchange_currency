<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateConvertRequest;
use App\Models\ExchangeRate;
use App\Models\HistoryRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{

    public function exchange(ValidateConvertRequest $request){

        $amount = $request->amount ?? 1;

        $currency = $this->fetchCurrency($request->from, $request->to);

        // return $currency;

        $reverse = $this->fetchCurrency($request->to, $request->from);

        $results = $this->returnResults($currency->from, $currency->to, $currency->rate, $amount);
        // $results = [
        //     'from' => $currency->from,
        //     'to' => $currency->to,
        //     'rate' => $currency->rate,
        //     'amount' => $amount,
        //     'result' => round($amount * $currency->rate, 2)
        // ];

        $restCurrencies = $this->restCurrencies($request->from);

        return view('welcome', compact('results', 'reverse', 'restCurrencies'));
    }


    public function welcome(){

        $currency = $this->fetchCurrency('USD', 'SGD');

        $reverse = $this->fetchCurrency('SGD', 'USD');

        $results = $this->returnResults($currency->from, $currency->to, $currency->rate, 1);

        // $results = [
        //     'from' => $currency->from,
        //     'to' => $currency->to,
        //     'rate' => $currency->rate,
        //     'amount' => 1,
        //     'result' => round($currency->rate, 2)
        // ];

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
        $currencies = ['USD', 'PHP', 'MYR','SGD', 'THB'];

        $restCurrencies = array_filter($currencies, function($currency) use($from){
            return $currency != $from;
        });

        return $restCurrencies;
    }

    public function returnResults($from, $to, $rate, $amount){
        $results = [
            'from' => $from,
            'to' => $to,
            'rate' => $rate,
            'amount' => $amount,
            'result' => round($this->calculateRate($amount, $rate), 2)
        ];

        return $results;

    }

    public function calculateRate($amount, $rate){
        return $amount * $rate;
    }

}
