<?php

namespace Model\Chinook;

class Media extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'MediaType', ['keys' => 'MediaTypeId',]);
    }
}
