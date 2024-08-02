<?php

namespace Chinook;

class Employee implements \Fuwafuwa\Controller\Controller {

  function execute(\Base $f3, string $action = "") { // action is slug or id
    if ($action == 'list') {
      print (new \Theme)->render('chinook/employee-list');
    } elseif ($id = intval($action)) {
      $f3['EmployeeId'] = $id;
      print (new \Theme)->render('chinook/employee-view');
    } else {
      $f3->error(404, "Employee not found: $action");
    }
  }
}
