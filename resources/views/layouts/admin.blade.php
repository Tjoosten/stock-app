<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/94dda7fdbf.js" crossorigin="anonymous" defer></script>

        <!-- Fonts -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}"/>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <img src="{{ config('core.navbar-logo') }}" width="35" height="35" class="mr-3 rounded d-inline-block align-top" alt="{{ config('app.name', 'Laravel') }}">
                <a class="navbar-brand mr-auto mr-lg-0" href="#">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-user-circle mr-1 fa-fw"></i> {{ $currentUser->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-sliders-h mr-1 fa-fw text-secondary"></i> Instellingen
                                </a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-power-off fa-fw mr-1 text-danger"></i> Afmelden
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf {{-- Form field protection --}}
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="nav-scroller bg-white shadow-sm">
                <nav class="nav nav-underline">
                    <a class="nav-link {{ active('home') }}" href="{{ route('home') }}">
                        <i class="fas fa-home mr-1 fa-fw text-muted"></i> Dashboard
                    </a>
                </nav>
            </div>

            <main role="main">
                @yield('content')
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <span class="footer-text">&copy; 2019 - {{ date('Y') }} <span class="ml-1">{{ config('app.name') }}</span></span>

                    <div class="float-right">
                        <a class="text-decoration-none footer-link" id="toTop" href="#">
                            Naar boven
                        </a>

                        <span class="dot align-middle"></span>

                        <a href="" target="_blank" class="footer-link text-decoration-none">
                            Privacy
                        </a>

                        <span class="dot align-middle"></span>

                        <a href="" target="_blank" class="footer-link text-decoration-none">
                            Terms
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
