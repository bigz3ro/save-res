<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    @yield('css')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @include('includes.message')
            <form action="{{ route('auth.postLogin') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if($errors->has('email'))
                        <p style="color:red">{{$errors->first('email')}}</p>
                    @endif
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if($errors->has('password'))
                        <p style="color:red">{{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        {{-- <a href="{{ route('forgotPassword') }}">I forgot my password</a><br> --}}
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                        Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            {{-- <a href="register.html" class="text-center">Register a new membership</a> --}}
        </div>
    </div>
</body>
</html>