<?php

namespace Ajax\Chinook;

class InvoiceLine extends \Fuwafuwa\Controller\FFTable {

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
        $this->record_list('\Model\Chinook\InvoiceLine');
    }

    function elist($f3) {
        $sql = "SELECT i.*, t.name FROM InvoiceLine i JOIN Track t ON i.TrackId = t.TrackId ";
        $csql = "SELECT COUNT(1) FROM InvoiceLine i";
        $this->record_elist($sql, $csql);
    }

    function load($f3) {
        ['InvoiceLineId' => $InvoiceLineId] = $this->data + ['InvoiceLineId' => ''];
        if (!$InvoiceLineId) return "{}";
        $invoice = m('\Model\Chinook\InvoiceLine');
        $result = $invoice->SQL('SELECT * FROM InvoiceLine WHERE InvoiceLineId = ?', $InvoiceLineId)[0] ?? [];
        if ($result) {
            $result['Customer'] = $invoice->SQL('SELECT * FROM Customer WHERE CustomerId = ?', $result['CustomerId'])[0];
        }
        $this->jsonResponse(true, '', $result);
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\InvoiceLine');
    }
}
