@extends('layout.partials.show')

@section('name')
    {{ $object->title }}
@stop

@section('show')
	@if($list)
	@foreach($list as $v)
		@include('layout.partials.fields.text', ['label' => trans('messages.answer'), 'field' => $v->is_right ? $v->option.'<b style="color:green;">（正确）</b>' : $v->option])
	@endforeach
	@endif
	<hr>
    @include('layout.partials.fields.text', ['label' => trans('messages.created_at'), 'field' => $object->created_at])
    @include('layout.partials.fields.text', ['label' => trans('messages.updated_at'), 'field' => $object->created_at])
    @include('layout.partials.fields.text', ['label' => trans('messages.create_user_id'), 'field' => isset($object->userCreate->name) ? $object->userCreate->name : ''])
    @include('layout.partials.fields.text', ['label' => trans('messages.update_user_id'), 'field' => isset($object->userUpdate->name) ? $object->userUpdate->name : ''])
@stop