<?php

namespace Chinook;

class Artist implements \Fuwafuwa\Controller\Controller {

  function execute(\Base $f3, string $action = "") { // action is slug or id
    if ($action == 'list') {
      print (new \Theme)->render('chinook/artist-list');
    } elseif ($id = intval($action)) {
      $f3['ArtistId'] = $id;
      print (new \Theme)->render('chinook/artist-view');
    } else {
      $f3->error(404);
    }
  }
}
