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
                        داشبورد
                    </a>
                </li>
                <li>
                    <a {!! request()->routeIs('dashboard.tourRequest') ? 'class="active"' : '' !!} href="{{ route('dashboard.tourRequest') }}">
                        <i class="icon-first-order"></i>
                        درخواست ها تور نمایشگاهی
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-first-order"></i>
                        درخواست غرفه سازی
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-first-order"></i>
                        درخواست غرفه سازی
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
