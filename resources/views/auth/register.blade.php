@extends('auth.layout.app')

@section('tab')

<!-- Tab panes -->
<div class="card-body p-0 auth-header-box">
    <div class="text-center p-3">
        <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">
            Let's Get Started Maintenance App
        </h4>
        <p class="text-muted mb-0">
            Sign Up to continue to Maintenance App.
        </p>
    </div>
</div>
<div class="card-body p-0">
    <form class="form-horizontal auth-form" method="post" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div class="tab-content">
            <div class="tab-pane active p-3" id="personal_information_tab" role="tabpanel">
                <div class="form-group mb-2">
                    <label for="name">Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter your name">
                    </div>
                </div>
                <span class="text-danger error-text">{{ $errors->first('name') }}</span>

                <div class="form-group mb-2">
                    <label for="name">Email</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email">
                    </div>
                </div>
                <span class="text-danger error-text">{{ $errors->first('email') }}</span>

                <div class="form-group mb-2">
                    <label for="phone">Phone</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter your phone number">
                    </div>
                </div>
                <span class="text-danger error-text">{{ $errors->first('phone') }}</span>

                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Enter your password">
                    </div>
                </div>
                <span class="text-danger error-text">{{ $errors->first('password') }}</span>
                
                <div class="form-group mb-2">
                    <label for="role">Registered As</label>
                    <div class="input-group">
                        <select class="form-control" name="role" id="role">
                            <option value="" disabled selected>Select your role</option>
                            <option value="6">Manager</option>
                            <option value="7">Accounts</option>
                        </select>
                    </div>
                </div>
                <!--end form-group-->
                <span class="text-danger error-text">{{ $errors->first('role') }}</span>

                <div class="form-group row my-3">
                    <div class="col-sm-12">
                        <div class="custom-control custom-switch switch-success">
                            <input type="checkbox" class="custom-control-input" id="customSwitchSuccess2" name="license-term">
                            <label class="custom-control-label text-muted" for="customSwitchSuccess2">You agree to the Maintenance <a href="#" class="text-primary">Terms of Use</a></label>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <span class="text-danger error-text">{{ $errors->first('license-term') }}</span>

                <div class="form-group mb-0 row">
                    <div class="col-12">
                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register <i class="fas fa-sign-in-alt ml-1"></i></button>
                    </div>
                    <!--end col-->
                </div>
                <!--end form-group-->
                <div class="m-3 text-center text-muted">
                    <p class="mb-0">Have an account ? <a href="{{ route('login') }}" class="text-primary ml-2">Log In</a></p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection