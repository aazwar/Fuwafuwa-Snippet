<?php

namespace Ajax\Chinook;

class Track extends \Fuwafuwa\Controller\FFTable {

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
        $this->record_list('\Model\Chinook\Track');
    }

    function elist($f3) {
        $sql = "SELECT t.*, a.Title as AlbumName, m.Name as MediaTypeName, g.name as GenreName FROM Track t 
            JOIN Album a ON t.AlbumId = a.AlbumId
            JOIN MediaType m ON m.MediaTypeId = t.MediaTypeId
            JOIN Genre g ON g.GenreId = t.GenreId";
        $csql = "SELECT COUNT(1) FROM Track t";
        $this->record_elist($sql, $csql);
    }

    function load($f3) {
        ['TrackId' => $TrackId] = $this->data + ['TrackId' => ''];
        if (!$TrackId) return "{}";
        $Track = m('\Model\Chinook\Track');
        $result = $Track->SQL('SELECT t.*, a.Title as AlbumName, m.Name as MediaTypeName, g.name as GenreName FROM Track t 
    JOIN Album a ON t.AlbumId = a.AlbumId
    JOIN MediaType m ON m.MediaTypeId = t.MediaTypeId
    JOIN Genre g ON g.GenreId = t.GenreId
    WHERE TrackId = ?', $TrackId)[0] ?? [];
        $this->jsonResponse(true, '', $result);
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\Track');
    }
}
