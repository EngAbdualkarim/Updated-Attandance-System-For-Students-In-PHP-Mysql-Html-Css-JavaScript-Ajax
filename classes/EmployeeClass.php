<?php

namespace classes;

class EmployeeClass extends UserClass implements EmployeeInterface
{

    /**
     * constructor of class setting property of the class
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * list all user os type employee
     *
     * @param $type
     * @return array
     */
    public function listAll($type = 'employee')
    {
        return parent::listAll($type); // TODO: Change the autogenerated stub
    }


    public function countEmployees()
    {
        $employeesCount = 0;

        $q = 'SELECT count(1) as total FROM users where type = "employee" ';
        $res = mysqli_query(DB::Connect(), $q);

        if (mysqli_num_rows($res) > 0) {
            $res_arr = mysqli_fetch_assoc($res);
            $employeesCount = $res_arr['total'];
        }

        return $employeesCount;
    }


    public function changeStatus($data)
    {
        $status         = $data['status'];
        $employee_id    = $data['employee_id'];

        $sql =  get_update_sqli('users', ['status'=>$status], ['id'=>$employee_id]);

        $res = mysqli_query(DB::Connect(), $sql);
        if($res)
        {
            return json_encode(["error"=>"false", "msg" => "Employee Status Updated Successfully!" , "data" => $status]);
        }

        return json_encode(["error"=>"true", "msg" => "Something went wrong!" , "data" => $status]);
    }

}