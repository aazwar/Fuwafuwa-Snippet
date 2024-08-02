<?php

namespace Util;

class Chinook {

  static function mediaOption(): string {
    return (new \Util\Html)->selectOption('MediaType', '', 'MediaTypeId', 'Name');
  }
}
