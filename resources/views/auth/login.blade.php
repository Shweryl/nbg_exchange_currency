@extends('layouts.main-theme')

@section('content')
<div class="card bg-white border py-4 border-0 shadow">
    <div class="card-body">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="text-center text-md-start">
                    <p class="fw-bold fs-4 text-primary">Login to your account</p>
                </div>
                <div class="w-100">
                    <img src="{{asset('assets/login.png')}}" class="w-100" alt="">
                </div>
            </div>
            <div class="col-md-5 mt-3 mt-md-0">
                <div class="card bg-white py-2 px-4">

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="mb-2 text-primary">Your Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-body-bg py-2 text-primary" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" value="{{old('email')}}" class="form-control text-primary py-2" name="email" aria-label="Email" required aria-describedby="basic-addon1">
                                </div>

                                @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="email" class="mb-2 text-primary">Your Password</label>
                                <div class="input-group">
                                    <span class="input-group-text py-2 text-primary" id="basic-addon1"><i class="bi bi-lock-fill"></i></i></span>
                                    <input type="password" name="password" class="form-control py-2 text-primary" aria-label="Password" required aria-describedby="basic-addon1">
                                </div>

                                @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="text-center mt-3">
                                <button type="submit" id="login-btn" class="btn btn-primary rounded-pill w-50">
                                    <span id="spinner" class="spinner-border spinner-border-sm me-2" style="display: none" aria-hidden="true"></span>
                                    Log in
                                </button>
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="mt-3 d-flex flex-column flex-lg-row align-items-center justify-content-lg-between mb-0">
                                <a href="{{route('register')}}" class="text-black-50 register-link text-decoration-none">Don't have an account?</a>

                                @if (Route::has('password.request'))
                                    <a class="text-black-50 text-decoration-none forget-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script type="module">
        document.addEventListener('submit', function (event) {
            isLoading(event, 'login-btn');
        });

    </script>
@endpush
