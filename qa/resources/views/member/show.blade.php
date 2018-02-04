@extends('layout.partials.show')

@section('name')
    {{ $object->nickname }}
@stop

@section('show')
    @include('layout.partials.fields.text', ['label' => trans('messages.avatar'), 'field' => '<img src="'.$object->avatar.'" height=64>'])
    @include('layout.partials.fields.text', ['label' => trans('messages.score'), 'field' => $object->score])
    @include('layout.partials.fields.text', ['label' => trans('messages.count'), 'field' => $object->count])
    @include('layout.partials.fields.text', ['label' => trans('messages.win_count'), 'field' => $object->win_count])
    @include('layout.partials.fields.text', ['label' => trans('messages.lose_count'), 'field' => $object->lose_count])
    @include('layout.partials.fields.text', ['label' => trans('messages.draw_count'), 'field' => $object->draw_count])
@stop