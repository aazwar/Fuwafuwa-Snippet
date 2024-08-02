<?php

namespace Mail;

class Registration extends \Fuwafuwa\Controller\Mail {
    function __construct() {
        $this->template = '_email/html/registration.html';
        $this->subject = t('register.registration');
        $this->html = true;
        $this->mime = "text/html";
    }
}
