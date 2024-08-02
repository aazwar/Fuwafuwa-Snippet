<?php

namespace Ajax;

class Snippet extends \Fuwafuwa\Controller\FFTable {

    function list($f3) {
        $this->record_list('\Model\Snippet');
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Snippet');
    }
}
