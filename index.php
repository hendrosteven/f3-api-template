<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Origin, Cache-Control, X-Requested-With, Content-Type, Access-Control-Allow-Origin');
header('Access-Control-Allow-Methods: *');
header('Content-type: application/json');

require 'vendor/autoload.php';

$f3 = Base::instance();
$f3->config('config/config.ini');
$f3->config('config/routes.ini');

$f3->run();
