<div class="content-wrapper">
    <section class="content-header">
        <h1>@yield('contenttitle',($route['action']== 'index') ? trans('messages.'.$route['table']) : trans('messages.'.$route['action']).trans('messages.'.$route['table']))</h1>
        @yield('toolbars')
        @yield('breadcrumbs')
    </section>
    <section class="content">
        @include('layout.partials.error_form')
        @yield('content')
    </section>
</div>