<?php
function mb_ucfirst($str, $encoding = 'UTF-8'){
    return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding). mb_strtolower(mb_substr($str, 1, mb_strlen($str), $encoding), $encoding);
}

spl_autoload_register(function ($class){
     $class = str_replace('\\',  DIRECTORY_SEPARATOR, $class);
     $classPath = 'vendor'.DIRECTORY_SEPARATOR.$class.'.php';
     if (file_exists($classPath)){
         include_once $classPath;
         return true;
     }
     return false;
});

Route::init();