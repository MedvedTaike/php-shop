<?php

function __autoload($class_name){
    $arrayPaths = array(
        '/components/',
        '/models/',
    );
    foreach($arrayPaths as $path){
        $path = ROOT.$path.$class_name.'.php';
        if(file_exists($path)){
            include_once($path);
        }
    }
    
}