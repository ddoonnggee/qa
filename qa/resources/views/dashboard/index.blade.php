@extends('layout.backend')

@section('styles')
<style type="text/css">
	#canvas-holder{text-align: center; width: 100%}
</style>
@stop

@section('scripts')

@stop

@section('content')
	<ol class="breadcrumb">
	<li>{!! trans('messages.welcome', ['name' => auth()->user()->name]) !!}</li>
    </ol>
@stop