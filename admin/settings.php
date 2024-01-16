<!-- opening head & body tags in head.php -->
<?php include_once "../includes/head.php"; ?>
<?php include_once "../functions.php"; ?>

<div class="wrapper">

    <!-- Navbar -->
    <?php include_once "../includes/navigation.php"; ?>

    <!-- Main Sidebar Container -->
    <?php include_once "../includes/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Content Header Breadcrumbs -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <form id="setting-update">
                    <input type="hidden" name="cmd" value="setting-update">
                    <table class="table table-hover dt-responsive" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Settings</th>
                            <th>Value (24hrs time)</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach (list_settings() as $key => $value): ?>
                            <tr>
                                <td><?php echo ucfirst(str_replace("_", " ", $value['setting_key'])); ?></td>
                                <td><input type="text" name="<?php echo $value['setting_key']; ?>" value="<?php echo $value['setting_value']; ?>" class="form-control"></td>

                            </tr>
                        <?php endforeach ?>


                        </tbody>
                    </table>
                </form>
                <button onclick="setting_update()" class="btn btn-primary text-end" style="margin-left: 93%">Update</button>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
    <?php include_once "../includes/footer.php"; ?>



</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include_once "../includes/scripts.php"; ?>
<!-- <script src="../plugins/datatables/jquery.dataTables.min.js"></script> -->
<!-- additional script goes here -->
<script type="text/javascript">


    function setting_update()
    {
        var data = $("#setting-update").serialize();
        $.post("../ajax.php",data,function(res){
            // Metronic.stopPageLoading();
            $('.page-loading').hide();
            var obj = JSON.parse(res);
            if(obj.error == "false")
            {
                $(".success_span").text(obj.msg);

                $(".alert-success").show();
                //window.location = "index.php";
            }else
            {
                $(".error_span").text(obj.msg);

                $(".alert-danger").show();
            }
        });
    }



</script>

</body>
</html>
<!-- ./closing body & head -->