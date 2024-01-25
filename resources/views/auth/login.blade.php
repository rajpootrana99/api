@extends('auth.layout.app')

@section('tab')
<div class="card-body p-0 auth-header-box">
    <div class="text-center p-3">
        <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">
            Let's Get Started Maintenance App
        </h4>
        <p class="text-muted mb-0">
            Sign in to continue to Maintenance App.
        </p>
    </div>
</div>
<div class="card-body p-0">
    <ul class="nav-border nav nav-pills" role="tablist">
        <li class="nav-item">
            <a class="nav-link active font-weight-semibold" data-toggle="tab" href="#LogIn_Tab" role="tab">Log In</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
            <form class="form-horizontal auth-form" method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-2">
                    <label for="name">Email</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                    </div>
                </div>
                <!--end form-group-->

                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                    </div>
                </div>
                <!--end form-group-->

                <div class="form-group row my-3">
                    <div class="col-sm-6">
                        <div class="custom-control custom-switch switch-success">
                            <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                            <label class="custom-control-label text-muted" for="customSwitchSuccess">Remember me</label>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end form-group-->

                <div class="form-group mb-0 row">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                    </div>
                    <!--end col-->
                </div>
                <!--end form-group-->
            </form>
            <!--end form-->
            <div class="m-3 text-center text-muted">
                <p class="mb-0">Register as Employee? <a href="{{ route('registerEmployee') }}" class="text-primary ml-2">Register</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
