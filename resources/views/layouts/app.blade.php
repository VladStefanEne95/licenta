<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="/js/timer.js"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>

 <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="/css/app.css">
        
</head>
<body>
        <div id="app">
                @include('inc.navbar')
                <div class="container">
                    @include('inc.messages')
                    @yield('content')
                </div>
        </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
