<?php

namespace classes;

interface EmployeeInterface
{

    /**
     * update the status of employee
     *
     * @param $type
     * @return array
     */
    public function changeStatus($data);

}