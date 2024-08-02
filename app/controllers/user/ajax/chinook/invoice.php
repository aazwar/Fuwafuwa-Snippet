<?php

namespace Ajax\Chinook;

class Invoice extends \Fuwafuwa\Controller\FFTable {

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
        $this->record_list('\Model\Chinook\Invoice');
    }

    function elist($f3) {
        $sql = "SELECT InvoiceId, i.CustomerId, InvoiceDate, BillingCity, Total, FirstName, LastName FROM Invoice i
            JOIN Customer c ON i.CustomerId = c.CustomerId ";
        $csql = "SELECT COUNT(1) FROM Invoice i";
        $this->record_elist($sql, $csql);
    }

    function load($f3) {
        ['InvoiceId' => $InvoiceId] = $this->data + ['InvoiceId' => ''];
        if (!$InvoiceId) return "{}";
        $invoice = m('\Model\Chinook\Invoice');
        $result = $invoice->SQL('SELECT * FROM Invoice WHERE InvoiceId = ?', $InvoiceId)[0] ?? [];
        if ($result) {
            $result['Customer'] = $invoice->SQL('SELECT * FROM Customer WHERE CustomerId = ?', $result['CustomerId'])[0];
        }
        $this->jsonResponse(true, '', $result);
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\Invoice');
    }
}
