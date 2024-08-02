<?php

namespace Mail;

class ResetPassword extends \Fuwafuwa\Controller\Mail {
    function __construct() {
        $this->template = '_email/html/password-changed.html';
        $this->subject = t('login.forgot_password');
        $this->html = true;
        $this->mime = "text/html";
    }
}
