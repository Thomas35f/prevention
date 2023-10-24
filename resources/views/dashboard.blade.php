<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo-lery.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    @vite(['resources/js/main.ts'])
    @vite(['resources/js/app.ts'])

    <title>Dashboard</title>

</head>

<body>

<div id="app"
     data-token="{{ session('token') }}"
     data-firstname="{{ session('firstname') }}"
     data-lastname="{{ session('lastname') }}">
    <App></App>
</div>

</body>

</html>


