<?php

@session_start();
include_once "functions.php";
use classes\DB;
use classes\AttendanceClass;

if(isset($_REQUEST['cmd'])) {


    switch ($_REQUEST['cmd'])
    {

        // employee register request
        case "register":
            $data = $_POST;

            unset($data['cmd']);
            unset($data['terms']);
            unset($data['confirm_password']);

            $email = $data['email'];
            $pass = $data['pass'];

            $sql_check = "select * from users where email='$email'";
            $res_check    = mysqli_query(DB::Connect(), $sql_check);
            if (mysqli_num_rows($res_check) > 0) {

                echo json_encode(["error"=>"true", "msg" => "Email address is already exists!"]);
            }else{

                $sql = insert_sql("users",$data);
                $res = mysqli_query(DB::Connect(), $sql);


                if($res)
                {
                    echo json_encode(["error"=>"false", "msg" => "User Successfully Created!"]);
                    //process_email("signup",mysqli_insert_id($db));
                }else
                {
                    echo json_encode(["error"=>"true", "msg" => "Error While Creating User!"]);

                }
            }

            //print_r(DB::Connect());

            break;



        // login request
        case "login":

            $email  = dbin($_POST['email']);
            $pass   = dbin($_POST['pass']);
            $sql    = "select * from users where email='$email' and pass='$pass'";
            $res    = mysqli_query(DB::Connect(), $sql);

            if (mysqli_num_rows($res) > 0) {

                $dd = mysqli_fetch_assoc($res);
                if ($dd['type'] == 'employee') {

                    if ($dd['status'] == 'pending') {
                        echo json_encode(["error"=>"true", "msg" => "You are not approved by the Admin!"]);
                        die();
                    }

                }

                $_SESSION['id']     = $dd['id'];
                $_SESSION['type']   = $dd['type'];
                $_SESSION['login']  = "ok";

                $link = 'employee/attendance_list.php';
                if($dd['type'] == 'admin')
                {
                    $link = 'admin/dashboard.php';
                }

                echo json_encode(["error"=>"false", "msg" => "successfully login!", 'panel' => $link]);

            } else {
                echo json_encode(["error"=>"true", "msg" => "Invalid login info! Try Again!"]);
            }
            break;


        // logout request
        case "logout":
            unset($_SESSION['id']);
            unset($_SESSION['login']);
            unset($_SESSION['type']);

            //header("location:index.php");
            break;


        // forgot password request
        case "forgot-pass":
            if(filter_var($_REQUEST['email'],FILTER_VALIDATE_EMAIL))
            {
                $email = $_REQUEST['email'];
                $sql = "select id from users where email='$email'";
                $res = mysqli_query(DB::Connect(), $sql);
                if($res)
                {
                    if(mysqli_num_rows($res)>0)
                    {
                        $data = mysqli_fetch_assoc($res);

                        $to         = $_POST['email'];
                        $subject    = "Forgot Password";
                        $headers    = "From: admin@test.com";
                        $txt        = "Reset email password request received";

                        //mail($to, $subject, $txt, $headers);

                        echo json_encode(["error"=>"false", "msg" => "Email sent!"]);

                    }else
                    {
                        echo json_encode(["error"=>"true", "msg" => "There is no record found against your email!"]);
                    }
                }else
                {
                    echo json_encode(["error"=>"true", "msg" => "Error while requesting data!"]);
                }
            }else
            {
                echo json_encode(["error"=>"true", "msg" => "Not a valid user id!"]);
            }
            break;


        case "change-status":
            $status         = $_GET['status'];
            $employee_id    = $_GET['employee_id'];

            $sql =  get_update_sqli('users', ['status'=>$status], ['id'=>$employee_id]);


            $res = mysqli_query(DB::Connect(), $sql);
            if($res)
            {

                echo json_encode(["error"=>"false", "msg" => "Employee Status Updated Successfully!" , "data" => $status]);


            }

            break;


        /**
         * mark attendance handling
         */
        case "attendance-save":

            // checkout handling
            if ($_POST['check-in'] == 'check-in') {


                echo (new AttendanceClass())->employeeCheckin();


            }else{ // checkout handling

                echo (new AttendanceClass())->employeeCheckOut();
            }

            break;



        /**
         * lunch break handling
         */
        case "lunch-break":

            if ($_POST['break-start'] == 'break-start') {

                echo (new AttendanceClass())->breakOut();

            }else{ // break-ends

                echo (new AttendanceClass())->breakIn();
            }

            break;





        case "setting-update":


            unset($_POST['cmd']);

            foreach($_POST as $key=>$val)
            {
                $pair = [
                    "setting_key" => $key,
                    "setting_value" => $val
                ];
                $sql = "update settings SET setting_value='".$pair['setting_value']."' where setting_key='".$pair['setting_key']."'";

                $res = mysqli_query(DB::Connect(), $sql);

            }

            echo json_encode(["error"=>"false", "msg" => "Settings Updated Successfully!"]);

            break;


        default:
            echo json_encode(["error"=>"true", "msg" => "Request not matched!"]);



    }


}

?>