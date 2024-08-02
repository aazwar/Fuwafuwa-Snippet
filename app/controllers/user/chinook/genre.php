<?php

namespace Chinook;

class Genre implements \Fuwafuwa\Controller\Controller {

  function execute(\Base $f3, string $action = "") { // action is slug or id
    if ($action == 'list') {
      print (new \Theme)->render('chinook/genre-list');
    } elseif ($id = intval($action)) {
      $f3['GenreId'] = $id;
      print (new \Theme)->render('chinook/genre-view');
    } else {
      $f3->error(404);
    }
  }
}
