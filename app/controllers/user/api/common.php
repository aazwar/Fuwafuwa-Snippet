<?php

namespace Api;

class Common extends \Fuwafuwa\Controller\Api {

    use \Fuwafuwa\Traits\Content;

    /**
     * Register member.
     *
     * @return void
     */
    function register(\Base $f3): void {
        $this->sendJson(c('\Fuwafuwa\Service\Member')->register($this->data));
    }

    /**
     * Member activation.
     *
     * @return void
     */
    function activation(\Base $f3): void {
        $this->sendJson(c('\Fuwafuwa\Service\Member')->activate($this->data));
    }
}
