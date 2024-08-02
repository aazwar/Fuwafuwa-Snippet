<?php
require_once('vendor/autoload.php');
require_once('app/controllers/system/fuwafuwa/util.php');

@$f3 = Base::instance();
$f3->config('app/configs/config.ini', true);
if ($f3['SESSION.user_lang']) {
    $f3['APP.lang'] = $f3['SESSION.user_lang'];
}
$f3['LANGUAGE'] = strtolower($f3['APP.lang']);
if (isset($f3['APP.theme'])) {
    $f3['UI'] = 'app/views/user/|themes/' . $f3['APP.theme'] . '/views/|app/views/system/';
}
$dice = new \Dice\Dice;
$dice = $dice->addRules('app/configs/dice.json');
$f3['CONTAINER'] = fn (string $class, array $params = []): object => $dice->create($class, $params);
$config = (new \Fuwafuwa\Service\Config)->load_pref();
$old_config = ['APP' => $f3['APP']];
$config = array_replace_recursive($old_config, $config);
$f3->mset($config);

\Template\Tags\Section::init('fragment');
\Template\Tags\Inject::init('inject');
\Fuwafuwa\Widget::init();

$f3->run();
