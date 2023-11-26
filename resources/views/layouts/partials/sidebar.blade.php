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
                <a href="{{ route('task.index')}}"><i data-feather="check-square" class="align-self-center menu-icon"></i><span>Task</span></a>
            </li>
            <li>
                <a href="{{ route('enquiry.index')}}"><i data-feather="book" class="align-self-center menu-icon"></i><span>Enquiries</span></a>
            </li>
            <li>
                <a href="javascript: void(0);"> <i data-feather="grid" class="align-self-center menu-icon"></i><span>Jobs</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('job.index')}}"><i class="ti-check-box"></i>Jobs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('quote.index')}}"><i class="mdi mdi-cash-multiple"></i>Budget</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('invoice.index')}}"><i class="dripicons-article"></i>Invoice</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('purchaseOrder.index')}}"><i class="dripicons-wallet"></i>Purchase Order</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('entity.index')}}"><i data-feather="users" class="align-self-center menu-icon"></i><span>Entities</span></a>
            </li>
            <li>
                <a href="{{ route('contact.index')}}"><i data-feather="phone" class="align-self-center menu-icon"></i><span>Contact</span></a>
            </li>
            <li>
                <a href="{{ route('site.index')}}"><i data-feather="globe" class="align-self-center menu-icon"></i><span>Sites</span></a>
            </li>
            <li>
                <a href="{{ route('explorer.index')}}"><i data-feather="folder" class="align-self-center menu-icon"></i><span>Explorer</span></a>
            </li>
            <li>
                <a href="{{ route('message.index')}}"><i data-feather="message-square" class="align-self-center menu-icon"></i><span>Chat</span></a>
            </li>
            <li>
                <a href="javascript: void(0);"> <i data-feather="settings" class="align-self-center menu-icon"></i><span>Settings</span><span class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index')}}"><i class="ti-user"></i>User</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('site-user.index')}}"><i class="ti-layout-menu-v"></i>Site User</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('estimate.index')}}"><i class="ti-ticket"></i>Estimates</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tradeType.index')}}"><i class="ti-tag"></i>Trade Types</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('note.index')}}"><i class="ti-file"></i>Notes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('notification.index')}}"><i class="ti-comment-alt"></i>Notifications</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end left-sidenav-->