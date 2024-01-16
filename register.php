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
    <title>Developer Challenge | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<?php include_once 'includes/page-loader.php'; ?>
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>Get </b>Membership</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form class="register-form">

                <input type="hidden" name="cmd" value="register" />

                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Full name" required >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="pass" class="form-control" placeholder="Password" required >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Retype password" required >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required >
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="index.php" class="text-center">I already have a membership</a>

        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>


<script>

    $(document).ready(function(){

        $(".register-form").submit(function(){

            $('.page-loading').show();
            var data = $(this).serialize();

            $.post("ajax.php",data,function(res){

                $('.page-loading').hide();
                var obj = JSON.parse(res);
                if(obj.error == "false")
                {
                    $(".success_span").text("You have successfully Sign up, you can login after approval.");
                    $(".alert-danger").hide();
                    $(".alert-success").show();
                    $(".register-form")[0].reset();

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
