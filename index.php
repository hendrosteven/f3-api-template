<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Origin, Cache-Control, X-Requested-With, Content-Type, Access-Control-Allow-Origin');
header('Access-Control-Allow-Methods: *');
header('Content-type: application/json');

require 'vendor/autoload.php';

//f3 bootstrap
$f3 = Base::instance();
$f3->config('config/config.ini');
$f3->config('config/routes.ini');

//validator config
use Valitron\Validator as V;
V::langDir('vendor/vlucas/valitron/lang');
V::lang('id');

//timezone
date_default_timezone_set($f3->get('timezone'));

$f3->run();
