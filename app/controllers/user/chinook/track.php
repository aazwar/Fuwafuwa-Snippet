<?php

namespace Chinook;

class Track implements \Fuwafuwa\Controller\Controller {

  function execute(\Base $f3, string $action = "") { // action is slug or id
    if ($action == 'list') {
      print (new \Theme)->render('chinook/track-list');
    } elseif ($id = intval($action)) {
      $f3['TrackId'] = $id;
      print (new \Theme)->render('chinook/track-view');
    } else {
      $f3->error(404, "Track not found: $action");
    }
  }
}
