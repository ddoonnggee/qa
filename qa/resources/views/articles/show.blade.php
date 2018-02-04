@extends('layout.partials.show')

@section('name')
    {{ $article->name }}
@stop

@section('show')
@can('articles_update',$article)
可以编辑文章
@endcan
{{ $article->description }}
@stop