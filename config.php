<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'model/CacheModel.php';
session_start();
header('Content-Type: text/html; charset=ISO-8895-1');


if ($_SERVER['HTTP_HOST'] == 'localhost') {
    error_reporting(E_ALL);
    define('DB_HOST', 'localhost');
    define('DB_USER', 'host');
    define('DB_PASS', '123456');
    define('DB_NAME', 'app');
    define('AMBIENTE', 'development');
    define('URL_BASE', 'http://localhost/SimuladorCache/');
}


spl_autoload_register(function($class) {
    $pastas = array('controller', 'lib', 'lib/core', 'model');

    foreach ($pastas as $value) {
        $file = $value . '/' . $class . '.php';
        if (file_exists($file)) {
            include_once $file;
        }
    }
});
