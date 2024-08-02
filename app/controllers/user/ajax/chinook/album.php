<?php

namespace Ajax\Chinook;

class Album extends \Fuwafuwa\Controller\FFTable {

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
        $this->record_list('\Model\Chinook\Album');
    }

    function select_option($f3) {
        $Album = m('\Model\Chinook\Album');
        $AlbumId = $this->data['AlbumId'] ?? '';
        if ($AlbumId) {
            $ArtistId = $Album->FSQL1('SELECT ArtistId FROM Album WHERE AlbumId = ?', $AlbumId);
            $result = $Album->SQL('SELECT AlbumId as value, Title as label FROM Album WHERE ArtistId = ?', $ArtistId);
            $this->jsonResponse(true, '', $result);
        } else {
            $this->jsonResponse(true, '', []);
        }
    }

    function elist($f3) {
        $sql = "SELECT al.*, ar.Name as ArtistName FROM Album al 
            JOIN Artist ar ON al.ArtistId = ar.ArtistId";
        $csql = "SELECT COUNT(1) FROM Album al";
        $this->record_elist($sql, $csql);
    }

    function load($f3) {
        ['AlbumId' => $AlbumId] = $this->data + ['AlbumId' => ''];
        if (!$AlbumId) return "{}";
        $Album = m('\Model\Chinook\Album');
        $result = $Album->SQL('SELECT al.*, ar.Name as ArtistName FROM Album al 
    JOIN Artist ar ON ar.ArtistId = al.ArtistId    
    WHERE al.AlbumId = ?', $AlbumId)[0] ?? [];
        $this->jsonResponse(true, '', $result);
    }

    function lookup($f3) {
        $Album = m('\Model\Chinook\Album');
        $query = $this->data['query'];
        $filter = $query ? "Title LIKE " . escapeSQLString("%$query%") : "";
        print json_encode($Album->codeValue("AlbumId", "Title", false, $filter));
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\Album');
    }
}
