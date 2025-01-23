@extends('main-theme')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-6">
                        <h3 class="mb-3 text-primary">Reset your Password</h3>
                        <form method="POST" onsubmit="disableReset(event)" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group mb-3">
                                <label for="email" class="mb-2 text-primary">{{ __('Email Address') }}</label>

                                <input id="email" type="email"
                                    class="form-control text-primary @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="mb-2 text-primary">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control text-primary @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password-confirm"
                                    class="mb-2 text-primary">Confirm Password</label>

                                <input id="password-confirm" type="password" class="form-control text-primary"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="text-center">
                                <button type="submit" id="reset-btn" class="btn btn-primary">
                                    <span id="spinner" class="spinner-border spinner-border-sm me-2" style="display: none" aria-hidden="true"></span>
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="w-100">
                            <img class="w-100 h-75" src="{{asset('assets/reset2.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function disableReset(event){
            let resetBtn = document.getElementById('reset-btn')
            let spinner = document.getElementById('spinner')
            resetBtn.disabled = true
            spinner.style.display = "inline-block"
        }
    </script>
@endpush
