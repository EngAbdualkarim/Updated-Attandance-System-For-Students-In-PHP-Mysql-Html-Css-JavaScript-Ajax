<?php

namespace classes;

class DB
{

    /**
     * return success connection with database
     *
     * @return false|\mysqli
     */
    public static function Connect()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db     = "dev_challenge";

        // method 1
        //$conn   = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn->error);
        //return $conn;

        // method 2
        return mysqli_connect($dbhost, $dbuser, $dbpass, $db);
    }

}