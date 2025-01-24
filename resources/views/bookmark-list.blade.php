@extends('main-theme')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card px-3 py-2">
                <div class="card-body">
                    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="true">
                        <div class="toast-header">
                          <img src="..." class="rounded me-2" alt="...">
                          <strong class="me-auto">Bootstrap</strong>
                          <small>11 mins ago</small>
                          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                          Hello, world! This is a toast message.
                        </div>
                      </div>
                    {{-- Filter bookmarks --}}
                    <div class="row justify-content-between align-items-center mb-3">
                        <div class="col-md-6">
                            <h2 class="text-primary">Bookmark List</h2>
                        </div>
                        <div class="col-md-6">
                            <form class="d-flex justify-content-md-end align-items-center"
                                action="{{ route('bookmark.list') }}" method="GET">
                                <div class="me-2">
                                    <span class="text-primary">From</span>
                                    <select class="text-primary py-1 px-2 border border-primary-50 rounded-1" name="from"
                                        id="">
                                        <option value="USD">USD</option>
                                        <option value="SGD">SGD</option>
                                        <option value="JPY">JPY</option>
                                        <option value="THB">THB</option>
                                        <option value="PHP">PHP</option>
                                    </select>
                                </div>
                                <div class="me-2">
                                    <span class="text-primary">To</span>
                                    <select class="text-primary py-1 px-2 border border-primary-50 rounded-1" name="to"
                                        id="">
                                        <option value="SGD">SGD</option>
                                        <option value="USD">USD</option>
                                        <option value="JPT">JPY</option>
                                        <option value="PHP">PHP</option>
                                        <option value="THB">THB</option>
                                    </select>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        {{-- filtered text --}}
                        @if (request(['from', 'to']))
                            <div class="d-flex text-black-50">
                                <small class="me-2">Filtered from {{ request('from') }} to {{ request('to') }}</small>
                                <a href="{{ route('bookmark.list') }}"><i class="bi bi-x"></i></a>
                            </div>
                        @endif
                        {{-- Bookmarks cards --}}
                        @foreach ($bookmarks as $bookmark)
                            <div class="col-6 col-md-4 col-lg-3 mb-3">
                                <div class="card shadow-sm bg-white py-2 border border-primary-50">
                                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                        <small
                                            class="text-primary fw-bold"><i class="bi bi-calendar2 me-1"></i> {{ $bookmark->created_at->format('d M Y') }}</small>
                                        <form action="{{ route('bookmark.delete', $bookmark->id) }}" method="post">
                                            @csrf
                                            <button class="btn btn-sm btn-primary"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                    <div class="card-body px-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="">
                                                <span class="d-block fw-bold text-primary fs-5">{{ $bookmark->from }}</span>
                                                <span>{{ $bookmark->amount }}</span>
                                            </div>
                                            <div class="">
                                                <i class="bi bi-arrow-right-square fs-5 text-primary"></i>
                                            </div>
                                            <div class="">
                                                <span
                                                    class="d-block fw-bold text-primary text-end fs-5">{{ $bookmark->to }}</span>
                                                <span>{{ round($bookmark->result, 4) }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="mt-2 mb-0 text-danger">1 {{ $bookmark->from }} =
                                            {{ round($bookmark->rate, 4) }} {{ $bookmark->to }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="row">
                        <div>
                            {{ $bookmarks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if (session('message'))
    @push('js')
        <script type="module">
            showToast("{{session('message')}}")
        </script>
    @endpush
@endif
