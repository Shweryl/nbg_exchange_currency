@extends('main-theme')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card bg-white py-3">
                <div class="card-header bg-white px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            <h4 class="mb-1 fw-bold text-secondary">Exchange Currency</h4>
                            <small class="text-secondary px-2 border border-1 border-primary-50">Reliable & trustworthy</small>
                        </div>

                        {{-- Bookmark Form --}}
                        <form class="d-inline-block" action="{{ route('bookmark') }}" method="post">
                            @csrf
                            <input type="hidden" name="from" value="{{ isset($results) ? $results['from'] : 'USD' }}">
                            <input type="hidden" name="to" value="{{ isset($results) ? $results['to'] : 'SGD' }}">
                            <input type="hidden" name="amount" value="{{ isset($results) ? $results['amount'] : '1' }}">
                            <input type="hidden" name="rate" value="{{ isset($results) ? $results['rate'] : '1' }}">
                            <input type="hidden" name="result" value="{{ isset($results) ? $results['result'] : '1' }}">

                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-bookmark-star-fill"></i>
                            </button>
                        </form>

                    </div>
                </div>
                <div class="card-body">
                    {{-- Convert Currency Form --}}
                    <form action="{{ route('currency.change') }}" method="GET">
                        <div class="row justify-content-center align-items-center">
                            {{-- From currency  select --}}
                            <div class="col-12 col-lg-5 d-flex flex-column">
                                <div class="w-100">
                                    <p>From</p>
                                    <select id="selectOne" style="width:100% !important;" class=" p-3" name="from"
                                        aria-label="Default select example">
                                        <option data-image="{{ asset('assets/flags/USD.png') }}" {{$results['from'] == 'USD' ? 'selected' : ''}} value="USD"
                                            class="mt-3">USD US Dollar</option>
                                        <option data-image="{{ asset('assets/flags/KHR.png') }}" {{$results['from'] == 'JPY' ? 'selected' : ''}} value="JPY">JPY Japan Yen
                                        </option>
                                        <option data-image="{{ asset('assets/flags/SGD.png') }}" {{$results['from'] == 'SGD' ? 'selected' : ''}} value="SGD">SGD
                                            Singapore Dollar</option>
                                        <option data-image="{{ asset('assets/flags/THB.png') }}" {{$results['from'] == 'THB' ? 'selected' : ''}} value="THB">THB Thai
                                            Baht</option>
                                        <option data-image="{{ asset('assets/flags/PHP.png') }}" {{$results['from'] == 'PHP' ? 'selected' : ''}} value="PHP">PHP
                                            Philippine Piso</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="number"
                                        class="fs-3 form-control border border-0 border-bottom rounded-0 bg-custom px-3 py-2"
                                        name="amount" value="{{ isset($results) ? $results['amount'] : '1' }}">
                                </div>
                            </div>
                            {{-- End From currency --}}

                            {{-- swap button for large screen --}}
                            <div class="col-12 col-lg-1 text-center switch-btn d-none d-lg-block">
                                <i type="button" class="bi bi-arrow-left-right text-dark fs-4 fw-bold"></i>
                            </div>

                            {{-- swap button for small screen --}}
                            <div class="col-12 col-lg-1 text-center switch-btn d-block d-lg-none">
                                <i type="button" class="bi bi-arrow-down-up text-dark fs-4 fw-bold"></i>
                            </div>

                            {{-- To currency select --}}
                            <div class="col-12 col-lg-5 d-flex flex-column">
                                <div class="w-100">
                                    <p>To</p>
                                    <select id="selectTwo" style="width:100% !important;" class="w-100 p-3" name="to"
                                        aria-label="Default select example">
                                        <option data-image="{{ asset('assets/flags/SGD.png') }}" {{$results['to'] == 'SGD' ? 'selected' : ''}} value="SGD"
                                            class="">SGD Singapore Dollar</option>
                                        <option data-image="{{ asset('assets/flags/USD.png') }}" {{$results['to'] == 'USD' ? 'selected' : ''}} value="USD">USD US
                                            Dollar</option>
                                        <option data-image="{{ asset('assets/flags/KHR.png') }}" {{$results['to'] == 'JPY' ? 'selected' : ''}} value="JPY">JPY Japan
                                            Yen</option>
                                        <option data-image="{{ asset('assets/flags/THB.png') }}" {{$results['to'] == 'THB' ? 'selected' : ''}} value="THB">THB Thai
                                            Baht</option>
                                        <option data-image="{{ asset('assets/flags/PHP.png') }}" {{$results['to'] == 'PHP' ? 'selected' : ''}} value="PHP">PHP
                                            Philippine
                                            Piso</option>
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <p type=""
                                        class="fs-3 border border-0 border-bottom rounded-0 bg-custom px-3 py-2 mb-0"
                                        >{{ isset($results) ? $results['result'] : '_ _' }}</p>
                                </div>
                            </div>
                            {{-- End To Currency --}}
                        </div>
                        <div class="row mt-3">
                            <div class="text-center ">
                                <button type="submit" class="btn btn-primary shadow-sm">Convert</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Show average rate and available conversions  --}}
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12 col-lg-6 mt-md-0 mt-2">
                    <div class="card bg-secondary px-2">
                        <div class="card-body">
                            <span class="fs-4 fw-bold text-warning mb-2 d-block">Average Rate</span>
                            <span class="fs-6 text-white">1 {{$results['from']}} = {{round($results['rate'], 4)}} {{$results['to']}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 mt-lg-0 mt-2">
                    <div class="card bg-secondary px-2">
                        <div class="card-body">
                            <span class="fs-4 fw-bold text-warning mb-2 d-block">Reverse Rate</span>
                            <span class="fs-6 text-white">1 {{$reverse->from}} = {{round($reverse->rate, 4)}} {{$reverse->to}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <h4 class="text-primary">Available Conversions</h4>
                @foreach ($restCurrencies as $restCurrency )
                <div class="col-6 mt-2">
                    <a href="{{route('currency.change', ['from' => $results['from'], 'amount' => 1, 'to' => $restCurrency])}}">
                        <div class="card bg-white">
                            <div class="card-body text-center">
                                <p class="mb-0 fs-6 fw-semibold text-primary">
                                    1 {{$results['from']}} to {{$restCurrency}}
                                    <i class="bi bi-arrow-right-circle ms-4 fw-bold"></i>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Conversion tables --}}
    <div class="row my-5">
        <div class="col-md-6">
            <div class="card d-flex">
                <div class="card-header bg-secondary py-3">
                    <h4 class="text-center mb-0 text-warning fw-bold">Covertion from {{$results['from']}} to {{$results['to']}}</h4>
                </div>
                <div class="card-body">

                    <table class="table bg-white">
                        <thead>
                            <tr>
                                <th class="text-center text-primary">
                                    <img src="{{ asset('assets/flags/'.$results['from'].'.png') }}" width="30" alt="">
                                    {{$results['from']}}
                                </th>
                                <th class="text-center text-primary">
                                    <img src="{{ asset('assets/flags/'.$results['to'].'.png') }}" width="30" alt="">
                                    {{$results['to']}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td class="text-center text-primary">1 {{$results['from']}}</td>
                                <td class="text-center text-primary">{{round(1 * $results['rate'], 4)}} {{$results['to']}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">5 {{$results['from']}}</td>
                                <td class="text-center text-primary">{{round((5 * $results['rate']), 4)}} {{$results['to']}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">10 {{$results['from']}}</td>
                                <td class="text-center text-primary">{{round((10 * $results['rate']), 4)}} {{$results['to']}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">100 {{$results['from']}}</td>
                                <td class="text-center text-primary">{{round((100 * $results['rate']), 4)}} {{$results['to']}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">1000 {{$results['from']}}</td>
                                <td class="text-center text-primary">{{round((1000 * $results['rate']), 4)}} {{$results['to']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-lg-0 mt-3">
            <div class="card d-flex">
                <div class="card-header bg-secondary py-3">
                    <h4 class="text-center mb-0 text-warning fw-bold">Covertion from {{$reverse['from']}} to {{$reverse['to']}}</h4>
                </div>
                <div class="card-body">

                    <table class="table bg-white">
                        <thead>
                            <tr>
                                <th class="text-center text-primary">
                                    <img src="{{ asset('assets/flags/'.$reverse->from.'.png') }}" width="30" alt="">
                                    {{$reverse->from}}
                                </th>
                                <th class="text-center text-primary">
                                    <img src="{{ asset('assets/flags/'.$reverse->to.'.png') }}" width="30" alt="">
                                    {{$reverse->to}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td class="text-center text-primary">1 {{$reverse->from}}</td>
                                <td class="text-center text-primary">{{round(1 * $reverse->rate, 4)}} {{$reverse->to}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">5 {{$reverse->from}}</td>
                                <td class="text-center text-primary">{{round((5 * $reverse->rate), 4)}} {{$reverse->to}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">10 {{$reverse->from}}</td>
                                <td class="text-center text-primary">{{round((10 * $reverse->rate), 4)}} {{$reverse->to}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">100 {{$reverse->from}}</td>
                                <td class="text-center text-primary">{{round((100 * $reverse->rate), 4)}} {{$reverse->to}}</td>
                            </tr>
                            <tr>
                                <td class="text-center text-primary">1000 {{$reverse->from}}</td>
                                <td class="text-center text-primary">{{round((1000 * $reverse->rate), 4)}} {{$reverse->to}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{-- swapping select --}}
    <script>
        let switchBtn = document.querySelectorAll('.switch-btn');
        let selectOne = document.getElementById('selectOne');
        let selectTwo = document.getElementById('selectTwo');

        switchBtn.forEach(button => {
            button.addEventListener('click', function() {
                let valueOne = selectOne.value;
                let valueTwo = selectTwo.value;
                selectOne.value = valueTwo;
                selectTwo.value = valueOne;

                $('#selectOne').trigger('change');
                $('#selectTwo').trigger('change');
            });
        });

        // switchBtn.addEventListener('click', function() {
        //     let valueOne = selectOne.value;
        //     let valueTwo = selectTwo.value;
        //     selectOne.value = valueTwo;
        //     selectTwo.value = valueOne;

        //     $('#selectOne').trigger('change');
        //     $('#selectTwo').trigger('change');
        // })
    </script>
    <script>
        $(document).ready(function() {
            function formatOption(option) {
                if (!option.id) return option.text;
                const imgSrc = option.element.dataset.image;
                return $(
                    `<span><img src="${imgSrc}" style="width: 20px; height: 20px; margin-right: 8px;"> ${option.text}</span>`
                );
            }
            $('#selectOne, #selectTwo').select2({
                // width : 100%,
                tags: true,
                templateResult: formatOption,

                templateSelection: formatOption,
                minimumResultsForSearch: -1
            });

            // $('#selectOne').select2();
            // $('#selectTwo').select2();
        });
    </script>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Currency Rate',
                        data: [65, 59, 80, 81, 56, 55, 40],
                        fill: true,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,

                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            grid: {
                                display: false, // Disable x-axis grid lines
                            }
                        },
                        y: {
                            grid: {
                                display: false, // Disable y-axis grid lines
                            }
                        }
                    },
                }

            });
        })
    </script>
@endpush
