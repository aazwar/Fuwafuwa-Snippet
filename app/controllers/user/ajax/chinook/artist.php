<?php

namespace Ajax\Chinook;

class Artist extends \Fuwafuwa\Controller\FFTable {

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
        $this->record_list('\Model\Chinook\Artist');
    }

    function elist($f3) {
        $sql = "SELECT ar.*, al.Albums FROM Artist ar 
            JOIN (SELECT ArtistId, COUNT(1) as Albums FROM Album GROUP BY ArtistId) al ON al.ArtistId = ar.ArtistId";
        $csql = "SELECT COUNT(1) FROM Artist ar";
        $this->record_elist($sql, $csql);
    }

    function load($f3) {
        ['ArtistId' => $ArtistId] = $this->data + ['ArtistId' => ''];
        if (!$ArtistId) return "{}";
        $artist = m('\Model\Chinook\Artist');
        $result = $artist->SQL('SELECT ar.*, al.Albums FROM Artist ar 
    JOIN (SELECT ArtistId, COUNT(1) as Albums FROM Album GROUP BY ArtistId) al ON al.ArtistId = ar.ArtistId 
    WHERE ar.ArtistId = ?', $ArtistId)[0] ?? [];
        $this->jsonResponse(true, '', $result);
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\Artist');
    }
}
