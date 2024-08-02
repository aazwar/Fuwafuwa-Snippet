<?php

namespace Model\Chinook;

class Employee extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'Employee', ['keys' => 'EmployeeId',]);
    }
}
