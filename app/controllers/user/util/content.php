<?php

namespace Util;

class Content {

    static function categoryOption(): string {
        return (new \Util\Html)->selectOption('\Fuwafuwa\Model\Category', '0', 'id', 'name');
    }

    static function parentCategoryOption(): string {
        return (new \Util\Html)->selectOption('\Fuwafuwa\Model\Category', '0', 'id', 'name', ['(parent is NULL OR parent = "0")']);
    }
}
