<?php

namespace Mail;

class ForgotPassword extends \Fuwafuwa\Controller\Mail {
    function __construct() {
        $this->template = '_email/html/forgot-password.html';
        $this->subject = t('login.forgot_password');
        $this->html = true;
        $this->mime = "text/html";
    }
}
