<?php

$logo = DB::table('imagetable')->where('table_name', 'logo')->first();
?>

<!-- BEGIN: Header-->
<nav
    class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header expanded">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto brand-logo-wrapper">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img class="brand-logo" alt="modern admin logo" src="{{ asset($logo->img_path) }}">
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <!-- <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i><span class="badge badge-pill badge-danger badge-up badge-glow">5</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
                                <span class="notification-tag badge badge-danger float-right m-0">5 New</span>
                            </li>
                            <li class="scrollable-container media-list w-100">
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan mr-0"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">You have new order!</h6>
                                            <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                            <small>
                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time></small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1 mr-0"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading red darken-1">99% Server load</h6>
                                            <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p>
                                            <small>
                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time></small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3 mr-0"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                            <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p>
                                            <small>
                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan mr-0"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Complete the task</h6>
                                            <small>
                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal mr-0"></i></div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Generate monthly report</h6>
                                            <small>
                                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li> -->
                    @if (auth()->check())
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <span class="mr-1 user-name text-bold-700">{{ auth()->user()->name }}</span>
                                <span class="avatar avatar-online">
                                    {{-- @if (auth()->check())
                                    @if (empty(auth()->user()->profile->pic))
                                        <img src="{{asset('imgs/noimage.png')}}" alt="avatar">
                                     @else
                                        <img src="{{asset('storage/uploads/users/'.auth()->user()->profile->pic)}}"
                                             alt="user-img">
                                     @endif
                                @endif --}}
                                    <img src="{{ asset('assets/imgs/profile.png') }}" alt="avatar">
                                    <i></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ url('admin/account/settings') }}">
                                    <i class="ft-user"></i> Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('logout') }}"><i class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
