@extends('layout.partials.table')

@section('table')
    <tr>
        <th class="text-center" width="1"><input type="checkbox" name="chb-all" id="chb-all" /></th>
        <th class="text-center" width="1">{!! sort_by('admin.articles.index', 'id', trans('messages.id')) !!}</th>
        <th>{!! sort_by('admin.articles.index', 'name', trans('messages.name')) !!}</th>
        <th class="text-center" width="100">{!! sort_by('admin.articles.index', 'created_at', trans('messages.created_at')) !!}</th>      
        <th class="text-center" width="100">#</th>
    </tr>
    @foreach ($results as $article)
    <tr>
        <td class="text-center"><input type="checkbox" name="ids[]" value="{{ $article->id }}" class="chbids" /></td>
        <td class="text-center">{{ $article->id }}</td>
        <td>{{ $article->name }}</td>
        <td class="text-center">{{ $article->created }}</td>
        <td class="text-center">
            <a href="{{ route('admin.articles.show', $article->id) }}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
        </td>
    </tr>
    @endforeach
@stop