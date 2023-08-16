<!doctype html>
<html dir="{{ app()->getLocale() !== 'fa' ? 'ltr' : 'rtl' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{  __('Exhibition Makers CRM') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/icons/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/mdBootstrap/dist/mds.bs.datetimepicker.style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sass/app.css') }}">
</head>
<body dir="{{ app()->getLocale() !== 'fa' ? 'ltr' : 'rtl' }}">
@include('dashboard.sidebar')
<div class="page-content">
    <header id="site-header">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <nav class="col-12">
                    <div class="nav-items">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ __('Exhibition Makers CRM') }}
                        </a>
                        <div class="user-panel">
                            @guest
                            @else
                                <ul>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                           role="button"
                                           data-bs-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end"
                                             aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}"
                                                  method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            @endguest
                            <form>
                                <select id="wbsSelectLang" name="lang">
                                    @foreach(config('app.available_locales') as $key => $locale)
                                        <option
                                            value="{{ $locale }}" {{ Request::segment(1) === $locale  ? 'selected' : '' }}>{{ $key }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <main id="site-main" class="container-fluid">
        @yield('content')
    </main>
</div>
</div>

<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/mdBootstrap/dist/mds.bs.datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
