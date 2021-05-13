<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lpb Diy | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/assist/ionicons-2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/assist/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/adminlte/plugins/sweetalert2/sweetalert2.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>LPB </b>DIY</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">辛辣天塞</p>

            <form action="/admin/auth/login/do_login" method="post">
                <div class="input-group mb-3">
                    <input name="email" type="email" class="form-control" placeholder="电子邮件" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input name="password" type="password" class="form-control" placeholder="密码" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">

                    <input type="text" name="captcha" class="form-control mb-1" placeholder="请输入验证码">
                    <img src="/admin/auth/login/captcha" style="height: calc(2.25rem + 2px);border:1px solid black;" onClick="this.src='/admin/auth/login/captcha?'+Math.random()">
                </div>

                @include('layout.errors')

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input name="remember" type="checkbox" id="remember">
                            <label for="remember">
                                记住我
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">登陆</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/dist/js/adminlte.min.js"></script>
<script src="/adminlte/plugins/sweetalert2/sweetalert2.js"></script>
<script>
    //显示登录页时，需要刷新整个页面，不然登陆页会显示到iframe中
    if (window !== top){
        top.location.href = location.href;
    }

    if ('{{session()->get('errors')}}' === 'true') {
        Swal.fire({title: 'Emm...', text: '{{session()->get('errors')}}', icon: 'error', timer: 3000});
    }
</script>
</body>
</html>
