{{--@extends('layouts.app')--}}
{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Login</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                {{--@if ($errors->has('name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--Forgot Your Password?--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>تعليمي دوت كوم</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="{{asset("css/style.css")}}">
{{--    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}">--}}


</head>
<body style="background-image: url('{{asset("/images/educational_image2.jpg")}}'); background-size: contain;">

<div class="container">
    <div class="info">
        <h1>تعليمي دوت كوم</h1>
    </div>
</div>
<div class="form">
    <div class="thumbnail"><img src="{{ asset("/images/logo_light2.png") }}"/></div>
    <form class="login-form form-horizontal" role="form" method="POST" action="{{ route('login') }}" >
        {{ csrf_field() }}
        @if($errors->has('name') || $errors->has('password'))
            <div class="error-message"> خطأ في إسم المستخدم أو كلمة المرور.!</div>
        @endif
        <label>إسم المستخدم</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="أدخل إسم المستخدم" class="{{ $errors->has('name') ? ' has-error' : '' }}" required autofocus autocomplete="off"/>

        <label for="">كلمة المرور</label>
        <input id="password" type="password" name="password" placeholder="ادخل كلمة المرور" class="{{ $errors->has('name') ? ' has-error' : '' }}"  required autocomplete="off"/>

        <button type="submit" >تسجيل دخول</button>
        {{--<p class="message">Not registered? <a href="#">Create an account</a></p>--}}
        <div class="form-group">
            <div class="remember-me">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="    width: 20px;    margin: 5px 0px;"> تذكرني
                    </label>
                </div>
                <a class="btn btn-link" href="{{ route('password.request') }}" style="font-size: 10px;">
                    هل نسيت كلمة المرور?
                </a>
            </div>
         
        </div>


    </form>
</div>
<video id="video" autoplay="autoplay" loop="loop" poster="polina.jpg">
    <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4"/>
</video>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="{{ asset("js/index.js") }}"></script>

</body>
</html>

