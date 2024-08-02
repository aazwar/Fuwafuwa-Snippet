<?php

namespace Model\Chinook;

class Customer extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'Customer', ['ai_field' => 'CustomerId',]);
        $this->validation = [
            'rules' => [
                'FirstName' => 'required',
                'LastName' => 'required',
                'Address' => 'required',
                'Email' => 'required|email',
            ]
        ];
    }
}
