<?php

date_default_timezone_set("Asia/Karachi");

/**
 * autoload used classes
 */
spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});

use classes\DB;
use classes\UserClass;
use classes\AdminClass;
use classes\EmployeeClass;
use classes\AttendanceClass;
use classes\SettingClass;




/**
 * ********************************************************
 *          Below is Class level implementation
 * ********************************************************
 */


/**
 * count total number of employees for admin panel
 * @return int|mixed
 */
function count_employees()
{
    return (new EmployeeClass())->countEmployees();
}


/**
 * fetch all employees for admin
 * @return array
 */
function list_employees()
{
    return (new EmployeeClass())->listAll();
}


/**
 * count employee attendance
 *
 * @return int|mixed
 */
 function count_attendace()
    {
        $attendanceCount = 0;

        $q = 'SELECT count(1) as total FROM attendance ';
        $res = mysqli_query(DB::Connect(), $q);

        if (mysqli_num_rows($res) > 0) {
            $res_arr = mysqli_fetch_assoc($res);
            $attendanceCount = $res_arr['total'];
        }

        return $attendanceCount;
    }



/**
 * fetch all settings for admin
 * @return array
 */
function list_settings()
{
    return (new SettingClass())->getAll();
}


/**
 * get employee attendance for employee panel
 * @return array
 */
function list_employees_attendance()
{
    return (new AttendanceClass())->getEmployeeAttendance();
}


/**
 * get all employee of attendance for admin
 * @return array
 */
function list_All_attendance()
{
    return (new AttendanceClass())->getAllEmployeeAttendance();
}






/**
 * ********************************************************
 *          Below are some Random functions
 * ********************************************************
 */



/**
 * escape string from special characters - ready to insert in DB
 *
 * @param $str
 * @return string
 */
function dbin($str)
{
    if (is_array($str))
        $str = json_encode($str);
    return mysqli_real_escape_string(DB::Connect(), trim($str));
}

/**
 * get profile of current login user
 *
 * @return array|false|int|null
 */
function get_current_profile()
{
    $user_id = $_SESSION['id'];
    $sql = "select * from users where id = '$user_id'";
    $res = mysqli_query(DB::Connect(), $sql);
    if ($res) {
        return mysqli_fetch_assoc($res);
    } else {
        return 0;
    }
}


/**
 * prepare insert query
 *
 * @param $table
 * @param $fields
 * @return string
 */
function insert_sql($table, $fields)
{
    $sql = "insert into $table (";

    foreach ($fields as $k => $v) {
        $sql .= $k . ",";
    }

    $sql = trim($sql, ",");
    $sql .= ") values( ";

    foreach ($fields as $k => $v) {
        $sql .= "'" . dbin($v) . "',";
    }

    $sql = trim($sql, ",");
    $sql .= ")";

    return $sql;
}


/**
 * prepare update query
 *
 * @param $table
 * @param $fields
 * @param $update
 * @param $remove_empty
 * @return string
 */
function get_update_sqli($table, $fields, $update, $remove_empty = "false")
{
    $sql = "update $table set ";

    foreach ($fields as $k => $v) {
        if (($remove_empty == "true" && $v != '') || $remove_empty == "false") {
            $sql .= $k . "='" . dbin($v) . "',";
        }
        //$sql.=$k."='".dbin($v)."',";
    }

    $sql = trim($sql, ",");
    $con = "";

    foreach ($update as $k => $v) {
        $con .= "and $k='$v'";
    }

    $where = " where " . substr($con, 3);
    $sql .= " $where ";

    return $sql;

}


?>