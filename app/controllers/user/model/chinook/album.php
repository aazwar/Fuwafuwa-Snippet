<?php

namespace Model\Chinook;

class Album extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'Album', ['keys' => 'AlbumId',]);
    }
}
