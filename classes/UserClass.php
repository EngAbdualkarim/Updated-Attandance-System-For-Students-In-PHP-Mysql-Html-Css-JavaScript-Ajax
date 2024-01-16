<?php

namespace classes;

class UserClass implements UserInterface
{
    /**
     * properties if the class
     * @var mixed
     */
    public $id, $type, $status;


    /**
     * constructor of class setting property of the class
     */
    public function __construct()
    {
        $this->id   = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $this->type = isset($_SESSION['type']) ? $_SESSION['type'] : null;
        $this->status = isset($_SESSION['status']) ? $_SESSION['status'] : null;

        date_default_timezone_set("Asia/Karachi");
    }


    /**
     * access user id from session (for logged-in user)
     *
     * @return mixed|null
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * access user type from session (for logged-in user)
     *
     * @return mixed|null
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * access user status from session (for logged-in user)
     *
     * @return mixed|null
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * fetch single record from users as per given id
     *
     * @param $id
     * @return array
     */
    public function get($id)
    {
        $user = array();
        $sql = "SELECT * FROM users WHERE id = $id";
        $res = mysqli_query(DB::Connect(), $sql);

        if($res)
        {
            if (mysqli_num_rows($res) > 0) {
                $user = mysqli_fetch_assoc($res);
            }
        }

        return $user;
    }


    /**
     * fetch all users if no type mentions inclusing admin
     * else fetch as per given type
     *
     * @param $type
     * @return array
     */
    public function listAll($type = null)
    {
        $sql = "SELECT * FROM users ";

        // if $type is not null get users accordingly
        if ($type != null)
        {
            $sql .= " WHERE type = '$type' ";
        }

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


}