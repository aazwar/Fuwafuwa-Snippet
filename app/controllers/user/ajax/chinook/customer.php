<?php

namespace Ajax\Chinook;

class Customer extends \Fuwafuwa\Controller\FFTable {

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
        $this->record_list('\Model\Chinook\Customer');
    }

    function load($f3) {
        ['CustomerId' => $CustomerId] = $this->data + ['CustomerId' => ''];
        if (!$CustomerId) return "{}";
        $customer = m('\Model\Chinook\Customer');
        $result = $customer->SQL('SELECT c.*, e.FirstName as EmpFirstName, e.LastName as EmpLastName 
      FROM Customer c 
      LEFT JOIN Employee e ON c.SupportRepId = e.EmployeeId 
      WHERE CustomerId = ?', $CustomerId)[0] ?? [];
        $this->jsonResponse(true, '', $result);
    }

    // function invoices($f3) {
    //   ['CustomerId' => $CustomerId] = $this->data + ['CustomerId' => ''];
    //   if (!$CustomerId) return "{}";
    //   $customer = m('\Model\Customer');
    //   $inv = $customer->SQL('SELECT * FROM Billing WHERE CustomerId = ?', $CustomerId);
    //   $this->jsonResponse(true, '', $inv);
    // }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\Customer');
    }
}
