<?php

namespace Model\Chinook;

class Invoice extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'Invoice', ['keys' => 'InvoiceId',]);
    }
}
