<?php

namespace Database\Seeders;

use App\Models\HistoryRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class HistoryRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKey = config('services.freecurrency.api_key');
        $url =  "https://api.freecurrencyapi.com/v1/historical";

        $dates = ['2025-01-19', '2025-01-20', '2025-01-21', '2025-01-22', '2025-01-23', '2025-01-24', '2025-01-25'];

        foreach($dates as $date){
            $response = Http::get($url, [
                'apikey' => $apiKey,
                'base_currency' => 'USD',
                'currencies' => "PHP,SGD,MYR,THB",
                'date' => $date
            ]);

            if($response->successful()){
                $datas = $response->json();
                $rates = $datas['data'];

                foreach($rates[$date] as $target=>$rate){
                    HistoryRate::insert([
                        'from' => 'USD',
                        'to' => $target,
                        'rate' => $rate,
                        'date' => $date,
                    ]);
                };

            }
        };






        // foreach($dates as $date){
        //     foreach($currencies as $baseCurrency){
        //         $response = Http::get($url, [
        //             'apikey' => $apiKey,
        //             'base_currency' => $baseCurrency,
        //             'currencies' => implode(',', $currencies),
        //             'date' => $date
        //         ]);

        //         if($response->successful()){
        //             $data = $response->json();
        //             $rates = $data['data'];

        //             foreach($rates[$date] as $target=>$rate){
        //                 HistoryRate::insert([
        //                     'from' => $baseCurrency,
        //                     'to' => $target,
        //                     'date' => $date,
        //                     'rate' => $rate,
        //                 ]);
        //             }
        //         }
        //     }
        // }
    }
}
