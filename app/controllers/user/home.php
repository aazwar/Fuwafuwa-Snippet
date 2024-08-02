<?php

class Home extends \Fuwafuwa\Home {

    /**
     * handler for /login
     *
     * @param \Base $f3
     * @return void
     */
    function login(\Base $f3): void {
        $username = trim($f3['REQUEST.username'] ?? "");
        $password = $f3['REQUEST.password'] ?? "";
        if ($username) {
            $loginInfo = [];
            $authers = array_values(array_filter((array)$f3['APP.auth_class'], fn ($e) => class_exists($e)));
            if (!$authers) {
                $f3['error_msg'] = 'No authers class defined';
                echo (new \Theme)->render('login');
                exit();
            }
            foreach ($authers as $auth_class) {
                $loginInfo = m($auth_class)->login($username, $password);
                if (isset($loginInfo['authed'])) break;
            }
            if (!empty($loginInfo['authed'])) {
                foreach ($loginInfo['user'] as $key => $value) {
                    $f3["SESSION.$key"] = $value;
                }
                $f3['SESSION.app-id'] = $f3['APP.id'];
                if ($f3['REQUEST.url']) {
                    $f3->reroute($f3['REQUEST.url']);
                } else {
                    $f3->reroute('/');
                }
            } else {
                $f3['error_msg'] = $loginInfo['error_msg'] ?? t('login.login_failed');
                echo (new \Theme)->render('login');
            }
        } else {
            if (isLoggedIn()) {
                $f3->reroute('/');
            } else {
                echo (new \Theme)->render('login');
            }
        }
    }
}
