<?php
header('Content-type: text/html; charset=utf-8');
session_start();
require "vendor/autoload.php";
error_reporting(-1);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Moscow');
$app = (new \Aqua\Aqua)->init();
$config = \Aqua\Base\Config\Manager::get('db');
$app->setConfig($config);

