<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            {{-- @include('layout.partials.nav.messages') --}}
            {{-- @include('layout.partials.nav.notifications') --}}
            {{-- @include('layout.partials.nav.tasks') --}}
            @include('layout.partials.nav.profile')
            <li><a href="javascript:;" onclick="window.location.reload();" role="button"><i class="fa fa-refresh  fa-spin"></i></a></li>
            <li><a href="javascript:;" class="fullscreen-toggle"><i class="icon ion-arrow-expand"></i></a></li>
            <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>
        </ul>
    </div>
</nav>