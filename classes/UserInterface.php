<?php

namespace classes;

interface UserInterface
{


    /**
     * to fetch single record
     *
     * @param $id
     * @return array
     */
    public function get($id);


    /**
     * fetch all records as per given type
     *
     * @param $type
     * @return array
     */
    public function listAll($type = null);

}