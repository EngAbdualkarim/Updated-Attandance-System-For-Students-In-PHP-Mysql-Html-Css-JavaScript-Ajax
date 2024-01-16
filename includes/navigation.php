<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Fullscreen">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" role="button" title="Sign out" id="logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
        <input type="hidden" name="cmd" value="cmd=logout" class="logout-cmd">
    </ul>
</nav>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>


<script>

   

        $("#logout").click(function(){
           
            // Metronic.startPageLoading();
            $('.page-loading').show();
            var data = $('.logout-cmd').val();

            $.post("../ajax.php",data,function(res){
                // Metronic.stopPageLoading();
                $('.page-loading').hide();
                window.location='../index.php';
            });

            return false;
        });


</script>
<!-- /.navbar -->