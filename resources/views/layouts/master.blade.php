<!doctype html>
<html lang="{{ app()->getLocale() ?? 'pl' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @stack('page-css')

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <main>
        <div id="app">
            <app-layout>
                <x-toast/>
                @yield('content')

                @stack('body-lower')
            </app-layout>
        </div>
    </main>
    @stack('page-scripts')
</body>
</html>
