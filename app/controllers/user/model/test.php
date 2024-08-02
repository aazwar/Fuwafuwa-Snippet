<?php

namespace Model;

class Test extends \Fuwafuwa\BaseModel {

    function __construct(\Fuwafuwa\Db $db) {
        parent::__construct($db, 'test', array('ai_field' => 'id', 'deleted_field' => 'deleted'));
    }
}
