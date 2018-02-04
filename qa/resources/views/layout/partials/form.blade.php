@extends('layout.backend')

@section('breadcrumbs')
    {!! Breadcrumbs::render($route['current'],trans('messages.'.$route['table'])) !!}
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div id="frmModel" class="box {{($route['action']== 'create') ? 'box-success': 'box-primary'}}">
                <div class="box-body">
                    @yield('form', form($form))
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <div class="text-right">
                            <button class="btn btn-warning btn-apply pull-left"><i class="fa fa-edit fa-fw"></i>{{ trans('messages.apply') }}</button>
                            <a class="btn btn-default" href="{{ route('admin.'.$route['table'].'.index') }}"><i class="fa fa-times fa-fw"></i>{{ trans('messages.cancel') }}</a>
                            <button class="btn btn-primary"><i class="fa fa-floppy-o fa-fw"></i>{{ trans('messages.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @if(isset($script))
        {!! Html::script($script) !!}
    @endif
@stop