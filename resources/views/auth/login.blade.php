<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Five Code Development | Login</title>

    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/font-awesome/css/font-awesome.css') !!}" />

    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}" />
</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
       <!-- <img src="{!! asset('images/fivecode1') !!}"> -->
       <img style="margin-top: 150px;" alt="image" class="img-circle" src="{!! asset('images/fivecode1.jpg') !!}" />
        <h3>Selamat Datang</h3>
        <p>Silakan masukkan Email dan Password.</p>
        <form class="m-t" method="POST" action="{{ route('postLogin') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="form-group">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required autofocus>


                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            {{--<p class="text-muted text-center"><small>Do not have an account?</small></p>--}}
            {{--<a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>--}}
        </form>
        <p class="m-t"> <small>Salma Ramadhiany &copy; 2018</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>
