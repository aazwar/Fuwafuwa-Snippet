<?php

namespace Ajax;

class Snippet extends \Fuwafuwa\Controller\FFTable {
    function list($f3) {
        $this->record_list('\Model\Snippet');
    }

    function edit($f3) {
        $this->ajaxEdit('\Model\Snippet');
    }

    function tag($f3) {
        $q = $this->data['q'];
        $result = $this->FSQLC("SELECT distinct tag FROM snippet ORDER BY tag");
        print json_encode($result);
    }
}
