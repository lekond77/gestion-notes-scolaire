<?php

spl_autoload_register(function($fqcn){
     $path = str_replace(['App', '\\'], ['src','/'], $fqcn).'.php';  // N'est  pas sensible à la case

    if (!file_exists($path)){
        throw new \LogicException("file `$path` not found");
    }
    require_once($path);
    });
    