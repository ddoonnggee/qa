@extends('layout.frontend')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="/">{!! config('custom.htmlname') !!}</a>
    </div>
    <div class="login-box-body">
        @yield('panel')
    </div>
</div>
@stop