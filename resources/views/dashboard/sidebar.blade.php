<div id="wbsSidebar">
    <div class="sidebar">
        <div class="logo text-center">
            <img src="{{ asset('images/ngs-logo.svg')  }}" alt="{{ __('Exhibition Makers') }}"/>
        </div>

        <div class="menu">
            <ul>
                <li>
                    <a {!! request()->routeIs('dashboard.index') ? 'class="active"' : '' !!} href="{{ route('dashboard.index') }}">
                        <i class="icon-sliders"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a {!! request()->routeIs('dashboard.tourRequest') ? 'class="active"' : '' !!} href="{{ route('dashboard.tourRequest') }}">
                        <i class="icon-first-order"></i>
                        {{ __('Tour Requests') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.boothBuilding') }}">
                        <i class="icon-first-order"></i>
                        {{ __('Booth Making Requests') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
