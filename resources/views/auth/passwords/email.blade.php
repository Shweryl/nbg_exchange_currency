@extends('main-theme')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-white py-3 mb-5 shadow">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-primary" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="">
                        <h3 class="text-center fw-bold text-primary mb-2">Forgot Your Password?</h3>
                    </div>
                    <div class="text-center">
                        <img class="w-75" src="{{asset('assets/forgot_password.png')}}" alt="">
                    </div>

                    <form method="POST" onsubmit="disableContinueBtn(event)" class="w-100 px-2 px-lg-5" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group px-lg-5 mb-3 text-center">
                            <label for="email" class="text-primary mb-3">Enter your email and we can help you reset your password.</label>

                            <div class="">
                                <input id="email" type="email" class="form-control py-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                            <button id="continue-btn" type="submit" class="btn btn-primary">
                                <span id="spinner" class="spinner-border spinner-border-sm me-2" style="display: none" aria-hidden="true"></span>
                                Continue
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        function disableContinueBtn(event){
            let continueBtn = document.getElementById('continue-btn')
            let spinner = document.getElementById('spinner')
            continueBtn.disabled = true
            spinner.style.display = "inline-block"
        }
    </script>
@endpush
