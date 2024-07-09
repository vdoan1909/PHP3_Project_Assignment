<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>

        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span>Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ Request::RouteIs('admin.index') ? 'active' : '' }}"
                    href="{{ route('admin.index') }}">
                    <i class="ri-dashboard-2-line"></i> <span>Dashboards</span>
                </a>
            </li>

            @foreach ($menuItems as $item)
                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::routeIs(['admin.' . $item['routeName'] . '.index', 'admin.' . $item['routeName'] . '.create', 'admin.' . $item['routeName'] . '.edit']) ? 'active' : '' }}"
                        href="#{{ $item['id'] }}" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="{{ $item['id'] }}">
                        <i class="{{ $item['icon'] }}"></i> <span>{{ $item['name'] }}</span>
                    </a>
                    <div class="collapse menu-dropdown" id="{{ $item['id'] }}">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.' . $item['routeName'] . '.index') }}"
                                    class="nav-link {{ Request::routeIs('admin.' . $item['routeName'] . '.index') ? 'active' : '' }}">
                                    List {{ $item['name'] }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.' . $item['routeName'] . '.create') }}"
                                    class="nav-link {{ Request::routeIs('admin.' . $item['routeName'] . '.create') ? 'active' : '' }}">
                                    Create {{ $item['name'] }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
