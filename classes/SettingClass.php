<?php

namespace classes;

class SettingClass extends AdminClass
{

    /**
     * constructor of class setting property of the class
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function getSpecificSetting($setting_key)
    {
        $setting_row = array();

        $sql = "select * from settings where setting_key = '$setting_key' ";
        $res = mysqli_query(DB::Connect(), $sql);

        if ($res)
        {
            $setting_row = mysqli_fetch_assoc($res);
        }

        return $setting_row;
    }


    public function getAll()
    {
        $settings = array();

        $sql = 'select * from settings';
        $res = mysqli_query(DB::Connect(), $sql);

        if ($res)
        {
            while ($row = mysqli_fetch_assoc($res)) {
                $settings[] = $row;
            }
        }

        return $settings;
    }



    public function updateSetting()
    {
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

        return json_encode(["error"=>"false", "msg" => "Settings Updated Successfully!"]);
    }


}