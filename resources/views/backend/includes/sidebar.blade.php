<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>
            @if (!$logged_in_user->isAdmin())
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="">
                    <i class="nav-icon icon-speedometer"></i> My Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="">
                    <i class="nav-icon icon-speedometer"></i> Account
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('admin/dashboard')) }}" href="">
                    <i class="nav-icon icon-speedometer"></i> Invoices
                </a>
            </li>
            @endif


            @if ($logged_in_user->isAdmin())
            <li class="nav-title">
                    Application
                </li>

                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/event*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/event*')) }}" href="#">
                            <i class="nav-icon icon-calendar"></i> Events
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('admin.event.calendar')}}">
                               Calendar

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/event')) }}" href="{{ route('admin.event.index') }}">
                              Manage Events
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link " href="{{route('admin.message.showtemplate')}}">
                               Message Template

                            </a>
                        </li> -->
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('admin.message.showEmailTemplate')}}">
                               Email Templates

                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/email*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/email*')) }}" href="#">
                            <i class="nav-icon icon-envelope"></i> Emails
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('admin.email.by-age-gender')}}">
                               Email By Age/Gender
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('admin.email.ownSubject')}}">
                               Email With Own Subject
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link " href="{{route('admin.email.individualMail')}}">
                               Individual Email
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item nav-dropdown ">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="icon-calendar"></i>   Events
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="">
                              Calendar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">
                                Manage Event
                            </a>
                        </li>
                    </ul>
                </li> --}}


                <li class="nav-item">
                    <a class="nav-link" href="{{route("blogetc.admin.index")}}">
                        <i class="nav-icon icon-bubbles"></i> Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("admin.dynamic_pages")}}">
                        <i class="nav-icon fa fa-file"></i> Dynamic Pages
                    </a>
                </li>
            <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="#">
                        <i class="nav-icon icon-user"></i> @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>


            <li class="divider"></li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/log-viewer*')) }}" href="#">
                    <i class="nav-icon icon-list"></i> @lang('menus.backend.log-viewer.main')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer')) }}" href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('admin/log-viewer/logs*')) }}" href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
