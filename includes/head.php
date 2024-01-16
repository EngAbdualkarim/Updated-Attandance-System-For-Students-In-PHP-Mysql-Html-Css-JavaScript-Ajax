<?php
//$ppath = trim(getcwd(),'admin');
//session_save_path($ppath."session_data");
//ini_set('session.gc_probability', 1);
@session_start();
if(!isset($_SESSION['id']) || $_SESSION['id']=="")
{
    unset($_SESSION['login']);
    unset($_SESSION['id']);
    unset($_SESSION['type']);
    // header("location: login.php");
    ?> <script>window.location='../admin/index.php'</script> <?php
    exit();
}

include_once 'page-loader.php';
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
</head>
<body class="hold-transition sidebar-mini">