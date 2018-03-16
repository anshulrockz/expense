@extends('layouts.basic')

@section('body')
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">EXPENSE TRACKER</a>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('admin.login.submit') }}" >
					{{ csrf_field() }}
                    <div class="msg">Log in
						@if ($errors->has('email'))
							<div class="alert alert-danger">
								<strong>Oh sorry!</strong>
								{{ $errors->first('email') }}
							</div>
						@endif
						@if ($errors->has('password'))
							<div class="alert alert-danger">
								<strong>Oh sorry!</strong>
								{{ $errors->first('password') }}
							</div>
						@endif
					</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Username" required autofocus>
						</div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-pink" {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberme" >Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">LOG IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <!--<div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>-->
                        <div class="col-xs-6 align-right">
							<a href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection