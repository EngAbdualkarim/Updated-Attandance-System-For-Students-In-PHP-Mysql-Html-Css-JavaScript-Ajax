<!-- opening head & body tags in head.php -->
<?php include_once "../includes/head.php"; ?>


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
                        <h1 class="m-0">Attendance List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Attendance List</li>
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
                            <th>Date</th>
                            <th>checkin_at</th>
                            <th>checkout_at</th>
                            <th>break In</th>
                            <th>break out</th>
                            <th>Working Hours</th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php  foreach(list_employees_attendance() as $key =>$value){ ?>
                          <tr>
                              <td>
                                  <?php echo $value['dated'] ?>
                              </td>
                               <td>
                                  <?php echo date('H:i:s',$value['checkin_at']) ?>
                              </td>
                               <td>
                                  <?php echo $value['checkout_at'] != null ?  date('H:i:s',$value['checkout_at']) : '' ?>
                              </td>
                               <td>
                                  <?php  echo $value['break_start'] != null ?  date('H:i:s',$value['break_start']) :'' ?>
                              </td>
                               <td>
                                  <?php  echo $value['break_end'] != null ? date('H:i:s',$value['break_end']) : '' ?>
                              </td>
                              <td><?php echo $value['working_hours'] ?> {hrs}</td>

                          </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                </form>
               
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


</body>
</html>
<!-- ./closing body & head -->