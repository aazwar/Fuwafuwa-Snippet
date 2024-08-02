<?php

namespace Chinook;

class Customer implements \Fuwafuwa\Controller\Controller {

  function execute(\Base $f3, string $action = "") { // action is slug or id
    if ($action == 'list') {
      print (new \Theme)->render('chinook/customer-list');
    } elseif ($id = intval($action)) {
      $f3['CustomerId'] = $id;
      print (new \Theme)->render('chinook/customer-view');
    } else {
      $f3->error(404);
    }
  }
}
