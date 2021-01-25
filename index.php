<?php
//echo $_GET['url'];
use Services\Route;
require_once 'vendor/autoload.php';
spl_autoload_register(function($class){
    require_once 'src/'.$class.'.php';
});

Route::start();