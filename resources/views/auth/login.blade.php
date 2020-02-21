
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="{{asset("css/style.css")}}">

</head>
<body style="background: white; background-size: auto;">

<div class="container" style="max-width: 360px !important;">
    <div class="info">
    </div>
</div>
<div class="form" style="padding-top: 0px;height: 410px;">
    <div class="" style="width: 100%;margin-bottom: 20px"><img style="width: 100%;" src="{{ asset("/images/logo_light.png") }}"/></div>
    <form class="login-form form-horizontal" style="width: 100%" role="form" method="POST" action="{{ route('login') }}" >
        {{ csrf_field() }}
        @if($errors->has('name') || $errors->has('password'))
            <div class="error-message"> خطأ في إسم المستخدم أو كلمة المرور.!</div>
        @endif
        <label>إسم المستخدم</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="أدخل إسم المستخدم" class="{{ $errors->has('name') ? ' has-error' : '' }}" required autofocus autocomplete="off"/>

        <label for="">كلمة المرور</label>
        <input id="password" type="password" name="password" placeholder="ادخل كلمة المرور" class="{{ $errors->has('name') ? ' has-error' : '' }}"  required autocomplete="off"/>

        <button type="submit" >تسجيل دخول</button>
        <div class="form-group">
            <div class="remember-me">


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

