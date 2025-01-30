<?php

namespace App\Http\Controllers;

use App\Models\HistoryRate;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history_rates()
    {
        $sgd = HistoryRate::where('to','SGD')->orderBy('date','asc')->get();
        $myr = HistoryRate::where('to','MYR')->orderBy('date','asc')->get();
        $php = HistoryRate::where('to','PHP')->orderBy('date','asc')->get();
        $thb = HistoryRate::where('to','THB')->orderBy('date','asc')->get();

        $dates = $sgd->pluck('date');
        

        // data for table data
        $historyRates = [];
        foreach ($dates as $date) {
            $historyRates[] = [
                'date' => $date,
                'SGD' => $sgd->where('date', $date)->first()->rate,
                'MYR' => $myr->where('date', $date)->first()->rate,
                'PHP' => $php->where('date', $date)->first()->rate,
                'THB' => $thb->where('date', $date)->first()->rate,
            ];
        }


        // data for table dataset
        $sgd = $sgd->pluck('rate');
        $myr = $myr->pluck('rate');
        $php = $php->pluck('rate');
        $thb = $thb->pluck('rate');

        return view('History-rate', compact('sgd', 'myr', 'php', 'thb', 'dates', 'historyRates'));
    }
}
