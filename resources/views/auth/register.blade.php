@extends('layouts.base')
@section('title','Register')

@section('header')

    @vite(['resources/css/auth.css'])

@endsection

@section('content')

    <main>
        <div class="slider-area">
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="auth register">
                                <div class="hero__caption">
                                    <h2>{{ __('register.title') }}</h2>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <!-- Company Name -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-4">
                                                <label for="company_name">{{ __('register.company_name') }}</label>
                                                <input id="company_name" class="form-control" type="text"
                                                       name="company_name" value="{{ old('company_name') }}" required>
                                                @error('company_name')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Email Address -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-4">
                                                <label for="email">{{ __('register.email') }}</label>
                                                <input id="email" class="form-control" type="email" name="email"
                                                       value="{{ old('email') }}" required>
                                                @error('email')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Phone -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-4">
                                                <label for="phone">{{ __('register.phone') }}</label>
                                                <input id="phone" class="form-control" type="text" name="phone"
                                                       value="{{ old('phone') }}" required>
                                                @error('phone')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mt-4">
                                                <label for="password">{{ __('register.password') }}</label>
                                                <input id="password" class="form-control" type="password"
                                                       name="password" required>
                                                @error('password')
                                                <span class="error-message">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-white hover:text-orange-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                           href="{{ route('login') }}">
                                            {{ __('register.already_registered') }}
                                        </a>
                                        <button class="ml-3 btn-register">
                                            {{ __('register.register') }}
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

