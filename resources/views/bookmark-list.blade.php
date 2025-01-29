@extends('layouts.main-theme')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="py-2">
                <div class="">
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
                                        <option value="USD" {{ !is_null(request('from')) ? (request('from') == 'USD' ? 'selected' : '') : '' }}>USD</option>
                                        <option value="SGD" {{ !is_null(request('from')) ? (request('from') == 'SGD' ? 'selected' : '') : '' }}>SGD</option>
                                        <option value="MYR" {{ !is_null(request('from')) ? (request('from') == 'MYR' ? 'selected' : '') : '' }}>MYR</option>
                                        <option value="THB" {{ !is_null(request('from')) ? (request('from') == 'THB' ? 'selected' : '') : '' }}>THB</option>
                                        <option value="PHP" {{ !is_null(request('from')) ? (request('from') == 'PHP' ? 'selected' : '') : '' }}>PHP</option>
                                    </select>
                                </div>
                                <div class="me-2">
                                    <span class="text-primary">To</span>
                                    <select class="text-primary py-1 px-2 border border-primary-50 rounded-1" name="to"
                                        id="">
                                        <option value="SGD" {{ !is_null(request('to')) ? (request('to') == 'SGD' ? 'selected' : '') : '' }}>SGD</option>
                                        <option value="USD" {{ !is_null(request('to')) ? (request('to') == 'USD' ? 'selected' : '') : '' }}>USD</option>
                                        <option value="MYR" {{ !is_null(request('to')) ? (request('to') == 'JPY' ? 'selected' : '') : '' }}>MYR</option>
                                        <option value="PHP" {{ !is_null(request('to')) ? (request('to') == 'PHP' ? 'selected' : '') : '' }}>PHP</option>
                                        <option value="THB" {{ !is_null(request('to')) ? (request('to') == 'THB' ? 'selected' : '') : '' }}>THB</option>
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
                        @forelse ($bookmarks as $bookmark)
                            <div class="col-6 col-md-4 col-lg-3 mb-3">
                                <div class="card shadow-sm bg-white py-2 border border-primary-50">
                                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                        <small
                                            class="text-primary fw-bold"><i class="bi bi-calendar2 me-1"></i> {{ $bookmark->created_at->format('d M Y') }}</small>
                                        <form action="{{ route('bookmark.delete', $bookmark->id) }}" class="delete-bookmark" method="post">
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
                                                <span>{{ round($bookmark->result, 2) }}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="mt-2 mb-0 text-danger">1 {{ $bookmark->from }} =
                                            {{ round($bookmark->rate, 2) }} {{ $bookmark->to }}</p>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body text-center">
                                        No bookmarks found. Start adding your favorite items!
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <hr>
                    {{-- pagination for bookmarks --}}
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

{{-- show message of book create or delete --}}
@if (session('message'))
    @push('js')
        <script type="module">
            showToast("{{session('message')}}")
        </script>
    @endpush
@endif

{{-- Show confirm box for deleting bookmark --}}
@push('js')
    <script>
        let deleteForms = document.querySelectorAll('.delete-bookmark')
        deleteForms.forEach((form)=>{
            form.addEventListener('submit', function(event){
                event.preventDefault();
                showConfirmBox(form, 'Want to Delete this bookmark?');
            })
        })
    </script>
@endpush
