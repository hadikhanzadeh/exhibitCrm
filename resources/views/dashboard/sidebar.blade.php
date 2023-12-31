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
                    <a {!! (app()->getLocale() === 'fa' && request()->segment(2) === 'tour-request') || (app()->getLocale() !== 'fa' && request()->segment(3) === 'tour-request')  ? 'class="active"' : '' !!} href="{{ route('dashboard.tourRequest') }}">
                        <i class="icon-first-order"></i>
                        {{ __('Tour Requests') }}
                    </a>
                </li>
                <li>
                    <a {!! (app()->getLocale() === 'fa' && request()->segment(2) === 'booth-building') || (app()->getLocale() !== 'fa' && request()->segment(3) === 'booth-building')  ? 'class="active"' : '' !!}  href="{{ route('dashboard.boothBuilding') }}">
                        <i class="icon-first-order"></i>
                        {{ __('Booth Making Requests') }}
                    </a>
                </li>
                <li>
                    <a {!! (app()->getLocale() === 'fa' && request()->segment(2) === 'booth-reserve') || (app()->getLocale() !== 'fa' && request()->segment(3) === 'booth-reserve')  ? 'class="active"' : '' !!}  href="{{ route('dashboard.boothReserve') }}">
                        <i class="icon-first-order"></i>
                        {{ __('Booth Reserve Requests') }}
                    </a>
                </li>
                @php
                    $user = \Auth::user();
                @endphp
                @if(!Auth::guest() && $user->role === 'administrator')
                    <li>
                        <a {!! (app()->getLocale() === 'fa' && request()->segment(2) === 'users') || (app()->getLocale() !== 'fa' && request()->segment(3) === 'users')  ? 'class="active"' : '' !!}  href="{{ route('dashboard.users') }}">
                            <i class="icon-first-order"></i>
                            {{ __('Users') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
