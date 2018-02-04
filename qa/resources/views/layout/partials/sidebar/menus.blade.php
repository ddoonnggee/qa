@foreach ($menus as $menu_l1)
    @if (isset($menu_l1['resource']))
    <li class="header">{{ $menu_l1['name'] }}</li>
    <li><a href="{{ route('admin.'.$menu_l1['resource'].'.index') }}">{{ $menu_l1['resource_name']}}</a></li>
    @endif
    @if (isset($menu_l1['children']))
        @foreach ($menu_l1['children'] as $menu_l2)
            @if (isset($menu_l2['children']))
                <li class="treeview">
                    <a href="#">
                                <i class="fa fa-table"></i> <span>{{ $menu_l2['name'] }}</span>
                                <i class="fa fa-angle-left pull-right"></i>
                              </a>
                    <ul class="treeview-menu">
                @foreach ($menu_l2['children'] as $menu_l3)
                    <li><a href="{{ route('admin.'.$menu_l3['resource'].'.index') }}">{{ $menu_l3['name'] }}</a></li>
                @endforeach
                </ul>
            </li>
            @else
                <li><a href="{{ route('admin.'.$menu_l2['resource'].'.index') }}">{{ $menu_l2['name'] }}</a></li>
            @endif
        @endforeach
    @endif
@endforeach