<?php
session_start();
include_once 'functions.php';
include_once 'includes/page-loader.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Developer Challenge | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<?php include_once 'includes/page-loader.php'; ?>
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Dashboard </b>Login</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form class="login-form">

                <input type="hidden" name="cmd" value="login" />

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="pass" class="form-control" placeholder="Password" autocomplete="off" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember_me" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.php">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="register.php" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>

    $(document).ready(function(){

        $(".login-form").submit(function(e){

            $('.page-loading').show();
            e.preventDefault();

            var data = $(this).serialize();
            $.post("ajax.php",data,function(res){
                $('.page-loading').hide();

                var obj = JSON.parse(res);
                if(obj.error == "false")
                {
                    $(".success_span").text(obj.msg);
                    $(".alert-danger").hide();
                    $(".alert-success").show();
                    window.location = obj.panel;
                }else
                {
                    $(".error_span").text(obj.msg);
                    $(".alert-success").hide();
                    $(".alert-danger").show();
                }
            });
            return false;
        });

        setInterval(function (){
            $(".alert").hide();
        }, 10000);


    });
</script>

</body>
</html>
