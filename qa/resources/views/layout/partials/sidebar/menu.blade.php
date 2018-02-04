<ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    @foreach ($menus as $key => $menu)
        @can($key.'_view')
        @if($key=='dashboard' && $active === null)
        <li class="active">
        @else
            <li class="{{ ($key==$active) ? 'active' : '' }}">
        @endif
            <a href="{{ route('admin.'.$key.'.index') }}"> <i class="fa {{ $menu['icon'] }}"></i>
                <span class="fa-fw">{{ trans('messages.'.$key) }}</span>
            </a>
        </li>
        @endcan
    @endforeach
</ul>