<?php

namespace Model\Chinook;

class Artist extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'Artist', ['keys' => 'ArtistId',]);
    }
}
