<div class="no_fix_header">
        <header class="bg-transparent shadow pt-3 pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-transparent ">
                            <a class="navbar-brand" href="{{route('frontend.index')}}">
                                    <img class="navbar-brand-full" src="{{ URL::asset('frontend/images/logo/logo-s.jpg')}}" width="90" height="45" alt="Calgary Speed Dating Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                            <li class="nav-item {{ Request::is('events') ? 'active-tab' : '' }} ">
                                                    <a class="nav-link" href="{{route('frontend.events.index')}}">EVENTS</a>
                                                </li>
                                                    <li class="nav-item {{ Request::is('venue') ? 'active-tab' : '' }} ">
                                                        <a class="nav-link" href="{{route('frontend.venue.index')}}">VENUE</a>
                                                    </li>
                                                    <li class="nav-item {{ Request::is('about') ? 'active-tab' : '' }} ">
                                                        <a class="nav-link" href="{{route('frontend.about')}}">ABOUT</a>
                                                    </li>
                        
                                                    <li class="nav-item {{ Request::is('faq') ? 'active-tab' : '' }}" >
                                                        <a class="nav-link" href="{{route('frontend.faq')}}">FAQ &amp; POLICIES</a>
                                                    </li>
                                                    <li class="nav-item {{ Request::is('contact') ? 'active-tab' : '' }}">
                                                            <a class="nav-link" href="{{route('frontend.contact')}}">CONTACT</a>
                                                    </li>
                                    </ul>
                                    <ul class="navbar-nav mr-0">
                                            @auth
                                            <li class="nav-item ">
                                                <a class="nav-link {{ active_class(Active::checkRoute('frontend.user.dashboard')) }}" href="{{route('frontend.user.dashboard')}}">DASHBOARD</a>
                                            </li>
                                            @endauth
                                
                                            @guest
                                
                                            <li class="nav-item active">
                                                <a  href="{{route('frontend.auth.login')}}" class="nav-link {{ Request::is('login') ? 'active-tab' : '' }}">LOG
                                                    IN</a> 
                                            </li>
                                
                                            @if(config('access.registration'))
                                            <li class="nav-item {{ Request::is('register') ? 'active-tab' : '' }}">
                                                <a class="nav-link" href="{{route('frontend.auth.register')}}">REGISTER</a>
                                            </li>
                                            @endif
                                
                                            @else
                                            <li class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">{{ ucwords($logged_in_user->name) }}</a>
                                
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                                                    @can('view backend')
                                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                                                    @endcan
                                
                                                    <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a>
                                                    <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                                                </div>
                                            </li>
                                            @endguest
                                
                                        </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div>