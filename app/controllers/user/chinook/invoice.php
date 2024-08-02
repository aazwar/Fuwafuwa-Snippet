<?php

namespace Chinook;

class Invoice implements \Fuwafuwa\Controller\Controller {

  function execute(\Base $f3, string $action = "") { // action is slug or id
    if ($action == 'list') {
      print (new \Theme)->render('chinook/invoice-list');
    } elseif ($id = intval($action)) {
      $f3['InvoiceId'] = $id;
      print (new \Theme)->render('chinook/invoice-view');
    } else {
      $f3->error(404, "Invoice not found: $action");
    }
  }
}
