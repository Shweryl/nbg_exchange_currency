@extends('layouts.main-theme')

@section('content')
<div class="card border border-0">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-4 d-flex justify-content-center align-items-center custom-bg-img py-5 py-lg-0 " style="object-fit: contain">
                <div class="register-text-bg p-5 rounded-1">
                    <h1 class="text-warning text-center">Register</h1>
                    <h3 class="text-warning text-center">Your Account</h3>
                    <a href="{{route('login')}}" class="text-white text-decoration-none mt-5">Already have an account?</a>
                </div>
            </div>
            <div class="col-lg-4 p-5 bg-white border border-black-50 shadow">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="text-primary">Your Name</label>
                        <div class="input-group">
                            <span class="input-group-text py-2 bg-body-bg text-primary" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
                            <input type="name" value="{{old('name')}}" class="form-control text-primary py-2" name="name" aria-label="Name" required aria-describedby="basic-addon1">
                        </div>

                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="email" class="text-primary">Your Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-body-bg py-2 text-primary" id="basic-addon1"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" value="{{old('email')}}" class="form-control text-primary py-2" name="email" aria-label="Email" required aria-describedby="basic-addon1">
                        </div>

                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="password" class="">Your Password</label>
                        <div class="input-group">
                            <span class="input-group-text py-2 text-primary" id="basic-addon1"><i class="bi bi-lock-fill"></i></i></span>
                            <input type="password" name="password" class="form-control text-primary py-2" aria-label="Password" required aria-describedby="basic-addon1">
                        </div>

                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="password" class="text-primary">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text text-primary py-2" id="basic-addon1"><i class="bi bi-lock-fill"></i></i></span>
                            <input type="password" name="password_confirmation" class="form-control text-primary py-2" aria-label="Password" required aria-describedby="basic-addon1">
                        </div>

                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" id="register-btn" class="btn btn-primary rounded-pill w-50">
                            <span id="spinner" class="spinner-border spinner-border-sm me-2" style="display: none" aria-hidden="true"></span>
                            Register
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

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script type="module">
        document.addEventListener('submit', function (event) {
            isLoading(event, 'register-btn');
        });

    </script>
@endpush
