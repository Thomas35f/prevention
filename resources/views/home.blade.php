@extends('layouts.base')
@section('title','Home')

@section('header')
    @vite(['resources/js/home.ts'])
@endsection

@section('content')

    <main>
        <div class="slider-area ">
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center">

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 title-home">
                                <div class="hero__caption">
                                    <h1>{{__('home.title_1') }}
                                        <span>{{__('home.road') }}</span><br>{{__('home.title_2') }}</h1>
                                </div>
                            </div>
                            @if (!Auth::check())

                                <div class="col-xl-3 col-lg-3">
                                    <div class="form-login">
                                        <div class="hero__caption">
                                            <h2 class="login-title">{{__('login.login') }}</h2>
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
                                            <div class="input-login">
                                                <x-input-label for="email" :value="__('login.email')" class="label"/>
                                                <x-text-input id="email" class="block mt-1" type="email" name="email"
                                                              :value="old('email')" required autofocus/>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                            </div>

                                            <!-- Password -->
                                            <div class="input-login">
                                                <x-input-label for="password" :value="__('login.password')"
                                                               class="label"/>

                                                <x-text-input id="password" class="block mt-1"
                                                              type="password"
                                                              name="password"
                                                              required autocomplete="current-password"/>

                                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                            </div>

                                            <!-- Remember Me -->
                                            <div class="block mt-4">
                                                <label for="remember_me" class="inline-flex items-center">
                                                    <input id="remember_me" type="checkbox"
                                                           class="hidden orange-checkbox" name="remember">
                                                    <span class="custom-checkbox"></span>
                                                    <span class="ml-2 text-sm text-white">{{ __('login.remember_me') }}</span>
                                                </label>
                                            </div>

                                            <div class="submit-container">
                                                <div class="flex items-center justify-end mt-4 submit-login">
                                                    @if (Route::has('password.request'))
                                                        <a class="underline text-sm text-orange-600 hover:text-orange-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                           href="{{ route('password.request') }}">
                                                            {{ __('login.forgot_password') }}
                                                        </a>
                                                    @endif

                                                    <button class="ml-3 btn-login">
                                                        {{ __('login.btn_login') }}
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    @endif
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--? Categories Area Start -->
        <div class="categories-area section-padding30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-80">
                            <span>{{__('home.services') }}</span>
                            <h2> {{__('home.services_title') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <a href="{{ route('offers') }}">
                            <div class="single-cat text-center mb-50" id="cat-1">
                                <div class="cat-icon">
                                    <img src="{{ asset('images/home/services/computer.png') }}" class="services-logo"
                                         id="computer">
                                </div>
                                <div class="cat-cap">
                                    <h5>{{__('home.service_1_title') }}</h5>
                                    <p>{{__('home.service_1_description') }}
                                        <br>
                                        <br>
                                        <br>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <a href="{{ route('offers') }}">
                            <div class="single-cat text-center mb-50" id="cat-2">
                                <div class="cat-icon">
                                    <img src="{{ asset('images/home/services/database.png') }}" class="services-logo"
                                         id="database">
                                </div>
                                <div class="cat-cap">
                                    <h5>{{__('home.service_2_title') }}</h5>
                                    <p>{{__('home.service_2_description') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <a href="{{ route('offers') }}">
                            <div class="single-cat text-center mb-50" id="cat-3">
                                <div class="cat-icon">
                                    <img src="{{ asset('images/home/services/dashcam.png') }}" class="services-logo"
                                         id="dashcam">
                                </div>
                                <div class="cat-cap">
                                    <h5>{{__('home.service_3_title') }}</h5>
                                    <p>{{__('home.service_3_description') }}
                                        <br>
                                        <br>
                                        <br>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Categories Area End -->

    </main>

@endsection



