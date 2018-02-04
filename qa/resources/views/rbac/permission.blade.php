@extends('layout.partials.show')

@section('name')
    {{ $permission->display_name }}
@stop

@section('show')
    @include('layout.partials.fields.text', ['label' => trans('messages.name'), 'field' => $permission->name])
@stop

