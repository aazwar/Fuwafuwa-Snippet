<?php

namespace Ajax\Chinook;

class Employee extends \Fuwafuwa\Controller\FFTable {

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
        $this->record_list('\Model\Chinook\Employee');
    }

    function select_option($f3) {
        $Employee = m('\Model\Chinook\Employee');
        $EmployeeId = $this->data['EmployeeId'] ?? '';
        if ($EmployeeId) {
            $result = $Employee->SQL('SELECT EmployeeId as value, LastName || ", " || FirstName as label FROM Employee WHERE EmployeeId != ?', $EmployeeId);
        } else {
            $result = $Employee->SQL('SELECT EmployeeId as value, LastName || ", " || FirstName as label FROM Employee');
        }
        $this->jsonResponse(true, '', $result);
    }

    function elist($f3) {
        $sql = "SELECT e.*, h.FirstName as HeadFirstName, h.LastName as HeadLastName 
            FROM Employee e
            LEFT JOIN Employee h ON e.ReportsTo = h.EmployeeId ";
        $csql = "SELECT COUNT(1) FROM Employee e";
        $this->record_elist($sql, $csql);
    }

    function load($f3) {
        ['EmployeeId' => $EmployeeId] = $this->data + ['EmployeeId' => ''];
        if (!$EmployeeId) return "{}";
        $employee = m('\Model\Chinook\Employee');
        $result = $employee->SQL('SELECT * FROM Employee WHERE EmployeeId = ?', $EmployeeId)[0] ?? [];
        if ($result) {
            $result['reportTo'] = $employee->SQL('SELECT EmployeeId, FirstName, LastName FROM Employee WHERE EmployeeId = ?', $result['ReportsTo'])[0];
            $result['reportees'] = $employee->SQL('SELECT EmployeeId, FirstName, LastName FROM Employee WHERE ReportsTo = ?', $EmployeeId);
        }
        $this->jsonResponse(true, '', $result);
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Chinook\Employee');
    }
}
