<?php

namespace Model\Chinook;

class Genre extends \Fuwafuwa\BaseModel {

    function __construct(\Data\Chinook $db) {
        parent::__construct($db, 'Genre', ['keys' => 'GenreId',]);
    }
}
