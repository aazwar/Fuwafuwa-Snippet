<?php

namespace Data;

class Generator extends \Fuwafuwa\Generator {
  function __construct() {
    $this->db = c('\Data\Chinook');
  }
}
