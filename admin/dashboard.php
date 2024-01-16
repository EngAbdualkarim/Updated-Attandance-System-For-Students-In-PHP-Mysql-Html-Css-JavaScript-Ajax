<!-- opening head & body tags in head.php -->
<?php

include_once "../includes/head.php";

/**
 * Redirect to employee panel
 */
if(isset($_SESSION['type']))
{
    if($_SESSION['type'] != 'admin')
    {
        ?> <script>window.location='../employee/dashboard.php'</script> <?php
    }
}
?>

<!-- inside body -->
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
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo count_employees(); ?></h3>

                                <p>Total Employees</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo count_attendace(); ?></h3>

                                <p>Marked Attendace</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                   
                   
                    <!-- ./col -->
                </div>

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


<!-- additional script goes here -->


</body>
</html>
<!-- ./closing body & head -->