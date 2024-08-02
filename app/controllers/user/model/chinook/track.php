<?php

namespace Model\Chinook;

class Track extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'Track', ['keys' => 'TrackId',]);
    }
}
