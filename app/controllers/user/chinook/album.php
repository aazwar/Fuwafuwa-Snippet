<?php

namespace Chinook;

class Album implements \Fuwafuwa\Controller\Controller {

  function execute(\Base $f3, string $action = "") { // action is slug or id
    if ($action == 'list') {
      print (new \Theme)->render('chinook/album-list');
    } elseif ($id = intval($action)) {
      $f3['AlbumId'] = $id;
      print (new \Theme)->render('chinook/album-view');
    } else {
      $f3->error(404);
    }
  }
}
