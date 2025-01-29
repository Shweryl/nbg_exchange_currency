<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKey = config('services.freecurrency.api_key');
        $url =  "https://api.freecurrencyapi.com/v1/latest";
        $currencies = ['MYR','PHP','SGD','THB','USD'];

        $rates = [];

        foreach($currencies as $baseCurrency){
            $response = Http::get($url, [
                'apikey' => $apiKey,
                'base_currency' => $baseCurrency,
                'currencies' => implode(',', $currencies)
            ]);

            if($response->successful()){
                $data = $response->json();

                $rates[$baseCurrency] = $data['data'];
            }
        }


        $reloopedData = [];

        foreach($rates as $base => $targetDatas){
            foreach($targetDatas as $target => $rate){
                $reloopedData[] = [
                    'from' => $base,
                    'to' => $target,
                    'rate' => $rate,
                ];
            }
        }

        ExchangeRate::insert($reloopedData);
    }
}
