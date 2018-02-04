@extends('layout.partials.auth')

@section('panel')
<p class="login-box-msg">{{ trans('messages.login') }}</p>
    @include('layout.partials.error')
    <form role="form" method="POST" action="/auth/login">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group has-feedback">
             <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="{{ trans('messages.email') }}">
             <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('messages.password') }}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
         <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember"> {{ trans('messages.remember') }}
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
               <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('messages.login') }}</button>
            </div><!-- /.col -->
         </div>
        <a class="btn-link" href="/password/email">{{ trans('messages.forgot') }}</a>
    </form>
@stop


@section('scripts')
    <script>
      $(function () {
        $("body").removeClass('skin-blue sidebar-mini').addClass('hold-transition login-page');
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
@stop