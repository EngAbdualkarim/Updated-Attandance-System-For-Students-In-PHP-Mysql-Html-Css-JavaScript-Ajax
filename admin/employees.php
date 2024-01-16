<!-- opening head & body tags in head.php -->
<?php include_once "../includes/head.php"; ?>
<?php include_once "../functions.php"; ?>

<!-- inside body -->
<link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>

<style>
    .select{
        color: white;
        width: 85px;
        border-radius: 10px;
    }
</style>
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
                        <h1 class="m-0">Employees List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employees List</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->



        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <table id="employeetable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Change Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (list_employees() > 0){ ?>
                        <?php foreach (list_employees() as $key => $value): ?>
                            <tr>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td>
                                    <?php
                                    $color = $value['status'] == 'pending' ? 'red': 'green'
                                    ?>
                                    <form class="employee-update">
                                        <select class="select" onchange="change_status(this)" employee-id="<?php echo $value['id']; ?>" style="background-color: <?php echo $color; ?>;">
                                            <option value="pending" <?php echo $value['status'] == 'pending' ? 'Selected' :''; ?> >In Active</option>
                                            <option  value="approved" <?php echo $value['status'] == 'approved' ? 'Selected' :''; ?> >Active</option>
                                        </select>
                                        <form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php } ?>

                    </tbody>
                </table>
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
<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
<!-- <script src="../plugins/datatables/jquery.dataTables.min.js"></script> -->
<!-- additional script goes here -->

<script type="text/javascript">
    let table = new DataTable('#employeetable');




    function change_status(el)
    {
        // Metronic.startPageLoading();
        $('.page-loading').show();
        let data = "status="+$(el).val()+"&cmd=change-status";
        let employee_id = $(el).attr("employee-id");


        $.get("../ajax.php?employee_id="+employee_id,data,function(res){
            // Metronic.stopPageLoading();
            $('.page-loading').hide();
            var obj = JSON.parse(res);
            console.dir(obj)
            if(obj.error == "false")
            {
                let color = obj.data == 'approved' ? $(".select").css("background-color" , "#008000") : $(".select").css("background-color" , "#ff0000");

                $(".success_span").text(obj.msg);
                $(".alert-success").show();
            }else{
                $(".error_span").text(obj.msg);
                $(".alert-danger").show();
            }

        });

        return false;

    }


</script>
</body>
</html>
<!-- ./closing body & head -->