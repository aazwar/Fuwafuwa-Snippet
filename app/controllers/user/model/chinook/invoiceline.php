<?php

namespace Model\Chinook;

class InvoiceLine extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'InvoiceLine', ['keys' => 'InvoiceLineId',]);
    }
}
