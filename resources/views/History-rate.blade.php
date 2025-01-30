@extends('layouts.main-theme')

@section('content')
    {{-- Charts for currency rate changes over past week --}}
    <div class="row justify-content-center mb-5">
        <div class="col-lg-6">
            <h6 class="mb-2 text-center">SGD Exchange Rates Over Past Week</h6>
            <canvas id="myChart1"></canvas>
        </div>
        <div class="col-lg-6 mt-lg-0 mt-5">
            <h6 class="mb-2 text-center">THB Exchange Rates Over Past Week</h6>
            <canvas id="myChart2"></canvas>
        </div>
        <div class="col-lg-6 mt-5">
            <h6 class="mb-2 text-center">PHP Exchange Rates Over Past Week</h6>
            <canvas id="myChart3"></canvas>
        </div>
        <div class="col-lg-6 mt-5">
            <h6 class="mb-2 text-center">MYR Exchange Rates Over Past Week</h6>
            <canvas id="myChart4"></canvas>
        </div>
    </div>

    {{-- Tables for currency rate changes over past week --}}
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card">
                <div class="card-header bg-secondary py-3">
                    <h3 class="text-warning mb-0 text-center">Currency Exchange Rates Over Past Week</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-primary fw-bold">
                                    <i class="bi bi-calendar2 me-1"></i>
                                    Date
                                </th>
                                <th class="text-primary fw-bold">
                                    <img src="{{ asset('assets/flags/USD.png') }}" width="30" alt="">
                                    USD
                                </th>
                                <th class="text-primary fw-bold">
                                    <img src="{{ asset('assets/flags/SGD.png') }}" width="30" alt="">
                                    SGD
                                </th>
                                <th class="text-primary fw-bold">
                                    <img src="{{ asset('assets/flags/PHP.png') }}" width="30" alt="">
                                    PHP
                                </th>
                                <th class="text-primary fw-bold">
                                    <img src="{{ asset('assets/flags/MYR.png') }}" width="30" alt="">
                                    MYR
                                </th>
                                <th class="text-primary fw-bold">
                                    <img src="{{ asset('assets/flags/THB.png') }}" width="30" alt="">
                                    THB
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historyRates as $history)
                                <tr>
                                    <td>{{ $history['date'] }}</td>
                                    <td>1 USD</td>
                                    <td>{{ round($history['SGD'], 3) }} SGD</td>
                                    <td>{{ round($history['PHP'], 3) }} PHP</td>
                                    <td>{{ round($history['MYR'], 3) }} MYR</td>
                                    <td>{{ round($history['THB'], 3) }} THB</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            // const ctx = document.getElementById('myChart');
            // new Chart(ctx, {
            //     type: 'bar',
            //     data: {

            //         'labels': @json($dates),
            //         'datasets': [{
            //                 label: 'SGD',
            //                 data: @json($sgd),
            //                 borderColor: 'rgba(75, 192, 192, 1)',
            //                 backgroundColor: 'rgb(46, 19, 58)',
            //                 fill: false,
            //                 tension: 0.4 // Smooth line
            //             },
            //             {
            //                 label: 'PHP',
            //                 data: @json($php),
            //                 borderColor: 'rgba(255, 99, 132, 1)',
            //                 backgroundColor: 'rgb(127, 78, 145)',
            //                 fill: false,
            //                 tension: 0.4
            //             },
            //             {
            //                 label: 'MYR',
            //                 data: @json($myr),
            //                 borderColor: 'rgba(54, 162, 235, 1)',
            //                 backgroundColor: 'rgb(54, 162, 235)',
            //                 fill: false,
            //                 tension: 0.4
            //             },
            //             {
            //                 label: 'THB',
            //                 data: @json($thb),
            //                 borderColor: 'rgba(255, 206, 86, 1)',
            //                 backgroundColor: 'rgba(255, 206, 86)',
            //                 fill: false,
            //                 tension: 0.4
            //             }
            //         ],

            //     },

            // });

            function createChart(canvasId, label, data, color) {
                let ctx = document.getElementById(canvasId);

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($dates),
                        datasets: [{
                            label: label,
                            data: data,
                            borderColor: color + '0.8)', // Solid color
                            backgroundColor: color + '0.5)',
                            fill: true,
                            tension: 0.4,
                            pointRadius: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true
                            }
                        },
                        scales: {
                            x: {
                                display: true
                            },
                            y: {
                                display: true
                            }
                        }
                    }
                });
            }

            createChart('myChart1', 'SGD', @json($sgd), 'rgba(75, 192, 192, ');
            createChart('myChart2', 'THB', @json($thb), 'rgba(255, 99, 132, ');
            createChart('myChart3', 'PHP', @json($php), 'rgba(127, 78, 145, ');
            createChart('myChart4', 'MYR', @json($myr), 'rgba(245, 197, 113, ');

        })
    </script>
@endpush
