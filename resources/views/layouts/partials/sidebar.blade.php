<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="{{ route('index') }}" class="logo">
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
            <!-- <li>
                <a href="{{ route('user.index')}}"><i data-feather="users" class="align-self-center menu-icon"></i><span>User</span></a>
            </li> -->
            <li>
                <a href="{{ route('site.index')}}"><i data-feather="globe" class="align-self-center menu-icon"></i><span>Sites</span></a>
            </li>
            <!-- <li>
                <a href="{{ route('site-user.index')}}"><i data-feather="globe" class="align-self-center menu-icon"></i><span>Site User</span></a>
            </li> -->
            <li>
                <a href="{{ route('task.index')}}"><i data-feather="check-square" class="align-self-center menu-icon"></i><span>Task</span></a>
            </li>
            <li>
                <a href="{{ route('explorer.index')}}"><i data-feather="folder" class="align-self-center menu-icon"></i><span>Explorer</span></a>
            </li>
            <li>
                <a href="{{ route('quote.index')}}"><i data-feather="box" class="align-self-center menu-icon"></i><span>Budget</span></a>
            </li>
            <li>
                <a href="{{ route('entity.index')}}"><i data-feather="user" class="align-self-center menu-icon"></i><span>Entities</span></a>
            </li>
            <li>
                <a href="{{ route('job.index')}}"><i data-feather="user" class="align-self-center menu-icon"></i><span>Jobs</span></a>
            </li>
            <li>
                <a href="{{ route('enquiry.index')}}"><i data-feather="user" class="align-self-center menu-icon"></i><span>Enquiries</span></a>
            </li>
            <li>
                <a href="{{ route('contact.index')}}"><i data-feather="phone" class="align-self-center menu-icon"></i><span>Contact</span></a>
            </li>
            <li>
                <a href="{{ route('invoice.index')}}"><i data-feather="file-text" class="align-self-center menu-icon"></i><span>Invoice</span></a>
            </li>
            <li>
                <a href="{{ route('purchaseOrder.index')}}"><i data-feather="file-text" class="align-self-center menu-icon"></i><span>Purchase Order</span></a>
            </li>
            <li>
                <a href="{{ route('message.index')}}"><i data-feather="message-square" class="align-self-center menu-icon"></i><span>Chat</span></a>
            </li>
            <li>
                <a href="javascript: void(0);"> <i data-feather="settings" class="align-self-center menu-icon"></i><span>Settings</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index')}}"><i class="ti-control-record"></i>User</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('site-user.index')}}"><i class="ti-control-record"></i>Site User</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('estimate.index')}}"><i class="ti-control-record"></i>Estimates</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tradeType.index')}}"><i class="ti-control-record"></i>Trade Types</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('note.index')}}"><i class="ti-control-record"></i>Notes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('notification.index')}}"><i class="ti-control-record"></i>Notifications</a></li>
                </ul>
            </li>
            <!-- <li>
                <a href="{{ route('notification.index')}}"><i data-feather="bell" class="align-self-center menu-icon"></i><span>Notifications</span></a>
            </li> -->
        </ul>
    </div>
</div>
<!-- end left-sidenav-->
