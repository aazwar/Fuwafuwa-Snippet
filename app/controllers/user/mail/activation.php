<?php

namespace Mail;

class Activation extends \Fuwafuwa\Controller\Mail {
    function __construct() {
        $this->template = '_email/html/activation.html';
        $this->subject = t('register.account_active');
        $this->html = true;
        $this->mime = "text/html";
    }
}
