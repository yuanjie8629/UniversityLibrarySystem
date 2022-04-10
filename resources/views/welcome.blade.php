@extends('layouts.auth')

<div class="d-flex justify-content-center py-4">
    <div style="width: 50%;">
        <div class="card">
            <div style="padding: 50px">
                <div>
                    <p class="fw-bold fs-1">University Library Management System</p>
                    <p style="color: #868686">Login</p>
                    <div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                <!-- <form method="POST" action="/api/login"> -->
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-around">
                                    <div>
                                        <button type="submit" class="btn btn-primary" style="background-color: #fff; border-color: #B5CFD8; font-size: 18px; padding: 5px 60px 5px 60px; text-align: center; border-radius: 5px;">
                                            @if (Route::has('register'))
                                            <a style="text-decoration:none; color:#8EAAB4" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            @endif
                                        </button>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary" style="background-color: #B5CFD8; border-color: #B5CFD8; color:#000; font-size: 18px; padding: 5px 60px 5px 60px; text-align: center; border-radius: 5px">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>