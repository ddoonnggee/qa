@extends('layout.partials.table')

@section('filters')
    <div class="col-md-offset-8 col-md-4">
        @include('layout.partials.filters.search')
    </div>
@stop

@section('table')
    <tr>
        <th class="text-center" width="1"><input type="checkbox" name="chb-all" id="chb-all" /></th>
        <th class="text-center" width="1">{!! sort_by('admin.settings.index', 'id', trans('messages.id')) !!}</th>
        <th>{!! sort_by('admin.settings.index', 'name', trans('messages.name')) !!}</th>
        <th class="text-center" width="100">{!! sort_by('admin.settings.index', 'created_at', trans('messages.created_at')) !!}</th>      
        <th class="text-center" width="100">#</th>
    </tr>
    @foreach ($results as $setting)
    <tr>
        <td class="text-center"><input type="checkbox" name="ids[]" value="{{ $setting->id }}" class="chbids" /></td>
        <td class="text-center">{{ $setting->id }}</td>
        <td>{{ $setting->name }}</td>
        <td class="text-center">{{ $setting->created }}</td>
        <td class="text-center">
            <a href="{{ route('admin.settings.show', $setting->id) }}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
            <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
        </td>
    </tr>
    @endforeach
@stop