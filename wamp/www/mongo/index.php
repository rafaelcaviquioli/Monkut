<?php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Sao_Paulo');
require_once 'vendor/autoload.php';

$request = $_REQUEST;
session_start();

try {
    $frontController = new FrontController($request);

    $frontController->process();
} catch (Exception $e) {
    print_r($e->getMessage());
}
