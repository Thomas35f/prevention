@extends('layouts.base')
@section('title','Contact')

@section('header')
    @parent
    @vite(['resources/css/contact.css'])
    @vite(['resources/js/contact.ts'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
          integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
            crossorigin=""></script>
@endsection

@section('content')

    <div class="slider-area ">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap">
                            <h2>{{ __('contact.title') }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('home') }}">{{ __('contact.home') }}</a></li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('contact.contact') }}</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="contact-title">{{ __('contact.contact_title') }}</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="#" method="get" id="contactForm"
                          novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{ __('contact.subject') }}'"
                                           placeholder="{{ __('contact.subject') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                              onfocus="this.placeholder = ''"
                                              onblur="this.placeholder = '{{ __('contact.message') }}'"
                                              placeholder="{{ __('contact.message') }}"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{ __('contact.name') }}'"
                                           placeholder="{{ __('contact.name') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email"
                                           onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = '{{ __('contact.email') }}'"
                                           placeholder="{{ __('contact.email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button-contactForm">{{ __('contact.submit') }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>{{ __('contact.address_title') }}</h3>
                            <p>{{ __('contact.address') }}</p>
                            <p>{{ __('contact.address_city') }}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>{{ __('contact.phone_title') }}</h3>
                            <p>{{ __('contact.phone') }}</p>
                            <p>{{ __('contact.schedule') }}</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>{{ __('contact.email_title') }}</h3>
                            <p>{{ __('contact.email_address') }}</p>
                        </div>
                    </div>
                    <div class="map-container">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

