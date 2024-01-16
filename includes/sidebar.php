<?php include_once "../functions.php"; ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../admin/dashboard.php" class="brand-link">
        <!--<img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
        <span class="brand-text font-weight-light">Developer Challenge</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Administration</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <?php /*include_once "includes/form-inline-sidebar.php"; */?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->


                <?php $user = get_current_profile(); 
                 if ($user['type'] == 'admin') {?>

                     <li class="nav-item">
                         <a href="../admin/dashboard.php" class="nav-link">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="../admin/employees.php" class="nav-link">
                             <i class="nav-icon far fa-user"></i>
                             <p>
                                 Employees
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="../admin/settings.php" class="nav-link">
                             <i class="nav-icon fa fa-cog"></i>
                             <p>
                                 Settings
                             </p>
                         </a>
                     </li>
                       <li class="nav-item">
                         <a href="../admin/attendance.php" class="nav-link">
                             <i class="nav-icon fas fa-calendar"></i>
                             <p>
                                 Attendance
                             </p>
                         </a>
                     </li>

                <?php } ?>






                 <?php $user = get_current_profile(); 
                 if ($user['type'] == 'employee') {?>

                    <li class="nav-item">
                         <a href="../employee/attendance_list.php" class="nav-link">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                Dashboard
                             </p>
                         </a>
                     </li>

                     <li class="nav-item">
                         <a href="../employee/attendance.php" class="nav-link">
                             <i class="nav-icon far fa-user"></i>
                             <p>
                                 Attendance
                             </p>
                         </a>
                     </li>

                     
                       <!-- <li class="nav-item">
                         <a href="../admin/attendance.php" class="nav-link">
                             <i class="nav-icon fas fa-calendar"></i>
                             <p>
                                 Attendance
                             </p>
                         </a>
                     </li> -->

                <?php } ?>
                
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>