<?php

namespace Ajax\Chinook;

class Genre extends \Fuwafuwa\Controller\FFTable {

    public $db;
    function __construct() {
        parent::__construct();
        $msg = "<br><br>Demo form only, modification is not stored to preserve the data 🙇🏻‍♂️🙏🏻";
        $this->allowAdd = fn (array $data) => $msg; // default: add is allowed
        $this->allowEdit = fn (array $data) => $msg; // default: edit is allowed
        $this->allowDel = fn (array $data) => $msg; // default: delete is allowed
        $this->db = c('\Data\Chinook');
    }

    function list($f3) {
        $this->record_list('\Model\Chinook\Genre');
    }

    function elist($f3) {
        $sql = "SELECT g.*, t.Tracks FROM Genre g JOIN (SELECT GenreId, COUNT(1) as Tracks 
            FROM Track GROUP BY GenreId) t ON g.GenreId = t.GenreId";
        $csql = "SELECT COUNT(1) FROM Genre g";
        $this->record_elist($sql, $csql);
    }

    function load($f3) {
        ['GenreId' => $GenreId] = $this->data + ['GenreId' => ''];
        if (!$GenreId) return "{}";
        $Genre = m('\Model\Chinook\Genre');
        $result = $Genre->SQL('SELECT g.*, t.Tracks FROM Genre g JOIN (SELECT GenreId, COUNT(1) as Tracks 
    FROM Track GROUP BY GenreId) t ON g.GenreId = t.GenreId WHERE g.GenreId = ?', $GenreId)[0] ?? [];
        $this->jsonResponse(true, '', $result);
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\Genre');
    }
}
