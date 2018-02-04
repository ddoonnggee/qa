@extends('layout.backend')

@section('title')
   {{trans('messages.permission_denied')}}
@stop

@section('contenttitle')

@stop

@section('content')
<div class="error-page">
    <h2 class="headline text-yellow">403</h2>
    <br>
    <div class="error-content">
        <h3> <i class="fa fa-warning text-yellow"></i>
            {{trans('messages.permission_denied')}}
        </h3>
        <p>
            如有疑问请联系管理员。<br>
            <a href="{{ URL::previous() }}">返回上一页</a>
            {{-- <a href="{{ route('admin.dashboard.index') }}">返回首页 --}}
            </a>
        </p>
    </div>
    <!-- /.error-content -->
</div>
<!-- /.error-page -->
@stop
