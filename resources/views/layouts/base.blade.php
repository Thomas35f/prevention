    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/lery.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    @vite(['resources/js/main.ts'])
    @vite(['resources/js/app.ts'])

    @vite(['resources/css/style.css'])
    @vite(['resources/css/app.css'])

    <title> @yield('title','Base')</title>
    @yield('header')
</head>

<body>
    @include('layouts.nav')

@yield('content')

    @include('layouts.back-top')
    @include('layouts.footer')

</body>

</html>
