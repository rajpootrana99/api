<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="index.html" class="logo">
            <span>
                <h4>Maintenance App</h4>
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li class="menu-label mt-0">Main</li>
            <li>
                <a href="{{ route('index') }}">
                    <i data-feather="home" class="align-self-center menu-icon"></i><span>Dashboard</span></a>
            </li>
            <li>
                <a href="{{ route('user.index')}}"><i data-feather="users" class="align-self-center menu-icon"></i><span>User</span></a>
            </li>
            <li>
                <a href="{{ route('site.index')}}"><i data-feather="globe" class="align-self-center menu-icon"></i><span>Sites</span></a>
            </li>
            <li>
                <a href="{{ route('site-user.index')}}"><i data-feather="globe" class="align-self-center menu-icon"></i><span>Site User</span></a>
            </li>
            <li>
                <a href="{{ route('task.index')}}"><i data-feather="check-square" class="align-self-center menu-icon"></i><span>Task</span></a>
            </li>
            <li>
                <a href="{{ route('entity.index')}}"><i data-feather="user" class="align-self-center menu-icon"></i><span>Entities</span></a>
            </li>
            <li>
                <a href="{{ route('contact.index')}}"><i data-feather="phone" class="align-self-center menu-icon"></i><span>Contact</span></a>
            </li>
            <li>
                <a href="{{ route('message.index')}}"><i data-feather="message-square" class="align-self-center menu-icon"></i><span>Chat</span></a>
            </li>
            <li>
                <a href="{{ route('notification.index')}}"><i data-feather="bell" class="align-self-center menu-icon"></i><span>Notifications</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- end left-sidenav-->