
    @extends('frontend.layouts.app')

    @section('content')
    
    <div class="container-fluid h-100">
            <div class="row h-100">
                <aside class="col-12 col-md-2 p-0 bg-dark">
                    <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
                        <div class="collapse navbar-collapse">
                            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                                <li class="nav-item ">
                                    <a class="nav-link pl-0 text-nowrap {{ Request::is('account') ? 'active-dash' : '' }}" href="{{ route('frontend.user.account')}}"><i class="far fa-tachometer-alt"></i><span > Profile</span></a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link pl-0 {{ Request::is('myevents') ? 'active-dash' : '' }}" href="{{route('frontend.user.myevents')}}"><i class="far fa-calendar-alt fa-fw"></i> <span class="d-none d-md-inline">My Events/Matches</span></a>
                                </li>
                                <!-- <li class="nav-item">
                                <a class="nav-link pl-0 {{ Request::is('account') ? 'active-dash' : '' }}" href="{{route('frontend.user.account')}}"><i class="far fa-user-circle fa-fw"></i> <span class="d-none d-md-inline">Account</span></a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link pl-0 {{ Request::is('invoices') ? 'active-dash' : '' }}" href="{{route('frontend.user.invoices')}}"><i class="far fa-file-invoice fa-fw"></i> <span class="d-none d-md-inline">Invoices</span></a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link pl-0 {{ Request::is('creditShow') ? 'active-dash' : '' }}" href="{{route('frontend.user.creditShow')}}"><i class="fas fa-dollar-sign fa-fw"></i> <span class="d-none d-md-inline">Credit</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link pl-0 {{ Request::is('sendCreditView') ? 'active-dash' : '' }}" href="{{route('frontend.user.sendCreditView')}}"><i class="fas fa-dollar-sign fa-fw"></i> <span class="d-none d-md-inline question-mark">Send Credit To Friend ?<span class="tooltiptext">Your friend must already have a profile with calgary speed dating. Send credit to the email they used to create their account.</span></span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </aside>
                <main class="col bg-faded py-3">
                @yield('side-content')
                </main>
            </div>
        </div>

        @endsection