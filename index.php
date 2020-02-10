<?php

use application\core\Router;

require_once 'application/core/Router.php';

// вывод ошибок на экран
ini_set('display_errors', 1);

// отчет о всех ошибках
error_reporting(E_ALL);

// автозагрузка не загруженных классов
spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});


session_start();

Router::start();



