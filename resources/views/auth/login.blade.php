@extends('layouts.base')
@section('title','Login')

@section('header')

    @vite(['resources/css/auth.css'])

@endsection

@section('content')

    <main>
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <div class="slider-area">
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="auth">
                                <div class="hero__caption">
                                    <h2>{{__('login.login') }}</h2>
                                </div>
                                <div class="login-no-account">
                                    <p>{{ __('login.no_account') }}</p>
                                    <a href="{{ route('register') }}">
                                        {{ __('login.create_account') }}
                                    </a>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="email" :value="__('login.email')"/>
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                                      :value="old('email')" required autofocus/>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <x-input-label for="password" :value="__('login.password')"/>

                                        <x-text-input id="password" class="block mt-1 w-full"
                                                      type="password"
                                                      name="password"
                                                      required autocomplete="current-password"/>

                                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="block mt-4">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" class="hidden orange-checkbox"
                                                   name="remember">
                                            <span class="custom-checkbox"></span>
                                            <span class="ml-2 text-sm text-white">{{ __('login.remember_me') }}</span>
                                        </label>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <a class="underline text-sm text-white hover:text-orange-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                               href="{{ route('password.request') }}">
                                                {{ __('login.forgot_password') }}
                                            </a>
                                        @endif

                                        <button class="ml-3 btn-login">
                                            {{ __('login.btn_login') }}
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
