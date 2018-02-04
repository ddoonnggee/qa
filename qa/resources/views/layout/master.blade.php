<!DOCTYPE html>
<html lang="{{ Config::get('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>
        @yield('title',($route['action']== 'index') ? trans('messages.'.$route['table'])."-".config('custom.name') : trans('messages.'.$route['action']).trans('messages.'.$route['table'])."-".config('custom.name'))
        </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link href="{{ elixir('css/backend.css') }}" rel="stylesheet" type="text/css" />
        @yield('styles')
    </head>
    <body class="skin-blue">
        @yield('template')
        <script src="{{ elixir('js/backend.js') }}" type="text/javascript"></script>
        @yield('scripts')
        @include('layout.partials.flash')
    </body>
</html>