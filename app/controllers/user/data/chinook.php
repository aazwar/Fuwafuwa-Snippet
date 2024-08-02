<?php

namespace Data {

    class Chinook extends \DB\SQL {

        function __construct() {
            $f3 = \Base::instance();
            return parent::__construct('sqlite:app/db/chinook.db');
        }
    }
}
