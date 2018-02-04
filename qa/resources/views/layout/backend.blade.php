@extends('layout.master')

@section('template')
    <div class="wrapper">
        @include('layout.partials.header')
        @include('layout.partials.sidebar')
        @include('layout.partials.content')
        @include('layout.partials.footer')
        @include('layout.partials.control-sidebar')
    </div>
@stop