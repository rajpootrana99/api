<!-- Left Sidenav -->
<div class="left-sidenav">
            <!-- LOGO -->
            <div class="brand">
                <a href="index.html" class="logo">
                    <span>
                        <img
                            src="{{ asset('assets/images/logo-sm.png')}}"
                            alt="logo-small"
                            class="logo-sm"
                        />
                    </span>
                    <span>
                        <img
                            src="{{ asset('assets/images/logo.png')}}"
                            alt="logo-large"
                            class="logo-lg logo-light"
                        />
                        <img
                            src="{{ asset('assets/images/logo-dark.png')}}"
                            alt="logo-large"
                            class="logo-lg logo-dark"
                        />
                    </span>
                </a>
            </div>
            <!--end logo-->
            <div class="menu-content h-100" data-simplebar>
                <ul class="metismenu left-sidenav-menu">
                    <li class="menu-label mt-0">Main</li>
                    <li>
                        <a href="{{ route('index') }}">
                            <i
                                data-feather="home"
                                class="align-self-center menu-icon"
                            ></i
                            ><span>Dashboard</span
                            ></a>
                    </li>

                    <li>
                        <a href="{{ route('user.index')}}"
                            ><i
                                data-feather="grid"
                                class="align-self-center menu-icon"
                            ></i
                            ><span>User</span
                            ></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- end left-sidenav-->