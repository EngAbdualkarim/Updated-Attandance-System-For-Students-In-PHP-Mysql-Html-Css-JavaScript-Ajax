<?php

namespace classes;

include_once "SettingClass.php";
use classes\SettingClass;

class AttendanceClass extends EmployeeClass
{

    /**
     * properties if the class
     * @var mixed
     */
    private $dated, $currentTime;
    public $id, $type, $status;


    /**
     * constructor of class setting property of the class
     */
    public function __construct()
    {
        parent::__construct();


        date_default_timezone_set("Asia/Karachi");

        $this->id       = parent::getId();
        $this->type     = parent::getType();
        $this->status   = parent::getStatus();

        $this->dated            = date("Y-m-d");
        $this->currentTime      = date("H:i:s", strtotime(time())); // 24hrs time format

        $this->currentTime      = date("H:i:s", time()); // 24hrs time format
        
    }



    /**
     * employee checkin
     *
     * @return false|string|void
     */
    public function employeeCheckin()
    {
        // check if already checkin

        
        $sql_check = "select * from attendance where  dated ='$this->dated' and user_id='$this->id'";

        $res = mysqli_query(DB::Connect(), $sql_check);

        if (mysqli_num_rows($res) > 0)
        {

            return json_encode(["error"=>"true", "msg" => "You are already checkin for today!"]);

        }else{ // checkin

            $setting_checkin_start  = (new SettingClass())->getSpecificSetting('work_starts');
            $setting_late_time      = (new SettingClass())->getSpecificSetting('late_flag');
            $setting_checkout_least     = (new SettingClass())->getSpecificSetting('checkout_least');

            $data = [

                "user_id"   => $this->id,
                "dated"     => $this->dated,

                "checkin_flag"  =>  ( $this->currentTime <= $setting_checkin_start['setting_value'])
                                        ? "present"
                                        : ( ($this->currentTime >= $setting_late_time['setting_value']) ? "late" : "absent" ),

                "checkin_at" => time() // saving value in unix-time

            ];

            $sql = insert_sql("attendance",$data);
            $res = mysqli_query(DB::Connect(), $sql);

            if($res)
            {
                return json_encode(["error"=>"false", "msg" => "Attendance Saved Successfully!"]);
            }
        }
    }


    /**
     * employee checkout
     *
     * @return false|string|void
     */
    public function employeeCheckOut()
    {
        $setting_checkout_least  = (new SettingClass())->getSpecificSetting('checkout_least');

        $sql_check = "select * from attendance where dated='$this->dated' and checkout_at > 0 and user_id='$this->id'";
        $res = mysqli_query(DB::Connect(), $sql_check);
        if (mysqli_num_rows($res) > 0)
        {
            return json_encode(["error"=>"true", "msg" => "CheckOut already exists!"]);
        }

        $checkout_flag = ($this->currentTime <= $setting_checkout_least['setting_value']) ? "early" : "";
        $sql = "update attendance SET checkout_at=".time();
        if($checkout_flag!="")
        {
            $sql .= ", checkout_flag='$checkout_flag' ";
        }

        $sql .= ", working_hours = ".$this->dailyWorkingHours();
        $sql .= " where user_id='$this->id' and dated='$this->dated' ";

        $res = mysqli_query(DB::Connect(), $sql);

        if($res)
        {
            return json_encode(["error"=>"false", "msg" => "CheckOut Successfully!"]);
        }
    }


    /**
     * starting lunch break - going out for break
     *
     * @return false|string|void
     */
    public function breakOut()
    {
        $sql_check = "select * from attendance where dated ='$this->dated' and break_start > 0 and user_id='$this->id'";
        $res = mysqli_query(DB::Connect(), $sql_check);

        if (mysqli_num_rows($res) > 0)
        {
            return json_encode(["error"=>"true", "msg" => "You are already on lunch break!"]);

        }else{

            $sql = "update attendance SET break_start=".time();
            $res = mysqli_query(DB::Connect(), $sql);

            if($res)
            {
                return json_encode(["error"=>"false", "msg" => "Your lunch break started for 60min!"]);
            }
        }
    }


    /**
     * ending lunch break - coming back-in from lunch break
     *
     * @return false|string|void
     */
    public function breakIn()
    {
        $sql = "select * from attendance where dated='$this->dated' and break_end > 0 and user_id='$this->id'";

        $res = mysqli_query(DB::Connect(), $sql);
        if (mysqli_num_rows($res) > 0) {

            return json_encode(["error"=>"true", "msg" => "Your break is already ended!"]);
        }

        $sql = "update attendance SET break_end=".time()." where user_id='$this->id' and dated='$this->dated' ";
        $res = mysqli_query(DB::Connect(), $sql);

        if($res)
        {
            return json_encode(["error"=>"false", "msg" => "You break ended!"]);
        }
    }

    /**
     * list attendance for employee
     *
     * @return array
     */
    public function getEmployeeAttendance()
    {
        $sql = "select * from attendance where user_id='$this->id'";

        $list = array();

        $res = mysqli_query(DB::Connect(), $sql);
        if ($res)
        {
            while ($row = mysqli_fetch_assoc($res)) {
                $list[] = $row;
            }
        }

        return $list;
    }


    /**
     * list attendance for admin
     *
     * @return array
     */
    public function getAllEmployeeAttendance()
    {
        $sql = "select * from attendance";


        $list = array();

        $res = mysqli_query(DB::Connect(), $sql);
        if ($res)
        {
            while ($row = mysqli_fetch_assoc($res)) {
                $list[] = $row;
            }
        }

        return $list;
    }


    /**
     * calculate daily working hours
     *
     * @return float
     */
    private function dailyWorkingHours()
    {
        $sql = "select * from attendance where dated ='$this->dated' and user_id='$this->id'";
        $res = mysqli_query(DB::Connect(), $sql);
        $row = mysqli_fetch_assoc($res);

        $checkin_out_diff = 0;
        if($row['checkin_at'] > 0)
        {
            $checkin_out_diff = time() - $row['checkin_at'];
        }

        $break_time = 0;
        if($row['break_end'] > 0 && $row['break_start'] > 0)
        {
            $break_time = $row['break_end'] - $row['break_start'];
        }

        // daily working hours without break
        // (double) used for type-casting of working hours
        return round(floor($checkin_out_diff - $break_time)/3600, 5);

    }

}