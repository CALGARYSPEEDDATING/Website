<nav class="navbar navbar-expand-lg navbar-light bg-transparent ">
    <a class="navbar-brand" href="{{route('frontend.index')}}">
           {{-- <img class="navbar-brand-full" src="{{ URL::asset('frontend/images/logo/symbol-01_transparent_small.png')}}" width="60" height="60" alt="Calgary Speed Dating Logo"> --}}
           <img class="navbar-brand-full" src="{{ URL::asset('frontend/images/logo/logo_house_sm.png')}}" width="60" height="55" alt="Calgary Speed Dating Logo">

    </a>
    <h4 class="mobile-menu-header d-block d-sm-block d-md-block d-lg-none d-xl-none mt-3">Calgary Speed Dating</h4>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link {{ Request::is('events') ? 'active-tab' : '' }}" href="{{route('frontend.events.index')}}">EVENTS </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ Request::is('venue') ? 'active-tab' : '' }}" href="{{route('frontend.venue.index')}}">VENUE</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('about') ? 'active-tab' : '' }}" href="{{route('frontend.about')}}">ABOUT</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('faq') ? 'active-tab' : '' }}" href="{{route('frontend.faq')}}">FAQ &amp; POLICIES</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link {{ Request::is('contact') ? 'active-tab' : '' }}" href="{{route('frontend.contact')}}">CONTACT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('blog') ? 'active-tab' : '' }}" href="{{route('blogetc.home.index')}}">BLOG</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('speed-dating-calgary') ? 'active-tab' : '' }}" href="{{route('frontend.pastEvents')}}">PAST SINGLES EVENTS</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.testimonials')}}">TESTIMONIALS</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.blog.index')}}">BLOG</a>
            </li> --}}
        </ul>
        <ul class="navbar-nav mr-0 user-access-section">
            @auth
            <li class="nav-item ">
                <a class="nav-link {{ Request::is(['myevents', 'account','invoices']) ? 'active-tab' : '' }}" href="{{ route('frontend.user.account') }}">DASHBOARD</a>
            </li>
            @endauth

            @guest

            <li class="nav-item active">
                <a  href="{{route('frontend.auth.login')}}" class="nav-link {{ active_class(Active::checkRoute('frontend.auth.login')) }}">LOG
                    IN</a>
            </li>

            @if(config('access.registration'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('frontend.auth.register')}}">REGISTER</a>
            </li>
            @endif

            @else
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuUser" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">{{ ucwords($logged_in_user->name) }}</a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                    @endif

                    {{-- <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Active::checkRoute('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a> --}}
                    @php
                        $credit = \App\Models\Credit::where('user_id', $logged_in_user->id)->first();
                    @endphp
                    <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>



                </div>



            </li>
            @endguest

        </ul>
    </div>
</nav>
