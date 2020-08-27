<!DOCTYPE html>
<html>

<head>
    <title>Login | CafeApp</title>
    <!-- meta_tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Meta_tag_Keywords -->
    <link rel="stylesheet" href="{{ URL::asset('public/admin/style.css') }}" type="text/css" media="all">
    <link rel="stylesheet" href="{{ URL::asset('public/admin/assets/font-awesome/css/font-awesome.min.css') }}">
    <!--web_fonts-->
    <link rel="stylesheet" href="{{ URL::asset('public/admin/assets/googleapi/css.css') }}">
    <!--//web_fonts-->
    

<body style="background: url('{{ url('public/bg.jpg') }}')">
    <div id="backgroundImage">
        <div class="main">
    <div class="form">
        <div class="form-content" style="margin-top: 6%;">

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-info">
                    <span class="fa fa-html5"
                        style="text-align: center;width: 100%; color: #fff;font-size: 65px;"></span>
                </div>
                @if (session('message'))
             <div class="alert alert-success" role="alert" style="max-width: 410px;
                margin: 0 auto;
                color: #3dd200;
                background: no-repeat;
                border: none;
                margin-bottom: 5px;
                font-size: 14px;
                text-align: center;
            ">
                Password reset successfully.
             </div>
             @endif
                <div class="email-w3l">
                    <span class="i1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <input name="username" id="username"  placeholder="User Name" value="{{ old('username') }}" required class="email @error('username') is-invalid @enderror">
                </div>
                @if (\Session::has('error'))
                <span style="color: #fff; margin-top: -10px;margin-left: 8px; float: left; width: 100%;" role="alert"
                    class="colorwhite">{!! \Session::get('error') !!}</span>
                @endif
                <div class="pass-w3l">
                    <span class="i2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
                    <input class="pass" type="password" name="password" placeholder="Password"
                        autocomplete="new-password">
                </div>
                @error('password')
                <span role="alert" class="colorwhite"
                    style="color: #fff;margin-top: -18px;margin-bottom: 15px; margin-left: 15px; float: left; width: 100%;">{{ $message }}</span>
                @enderror
                <input id="password-confirm" type="password" placeholder="Confirm Password"
                    name="asaspassword_confirmation" autocomplete="new-password" style="display: none;" >
                <div class="submit-agileits">
                    <input class="login" type="submit" value="login" style="border: 1px solid;color: white;">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>

</html>