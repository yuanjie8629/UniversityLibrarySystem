@extends('layouts.auth')

@section('content')
<div class="d-flex justify-content-center">
    <div style="width: 50%">
        <div class="card">
            <div style="padding: 50px">
                <div>
                    <p class="fw-bold fs-1">University Library Management System</p>
                    <p style="color: #868686">Registration</p>
                    <div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        {{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                        required autocomplete="name" autofocus>--}}
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        {{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                        required autocomplete="email">--}}
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="telephone"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Telephone') }}</label>

                                    <div class="col-md-6">
                                        {{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                        required autocomplete="email">--}}
                                        <input id="telephone" type="tel"
                                            class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                                            placeholder="0124228523" pattern="[0-9]{10}"
                                            required>

                                        @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" required autocomplete="new-password">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <label for="role"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-select" aria-label="Default select example" name="role">
                                            <option value="LECTURER">Lecturer</option>
                                            <option value="STUDENT">Student</option>
                                            <option value="ADMIN">Admin</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit"
                                            style="background-color: #B5CFD8; border-color: #B5CFD8; font-size: 18px; padding: 5px 60px 5px 60px; text-align: center; border-radius: 5px">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                @endsection
