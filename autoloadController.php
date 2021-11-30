<?php

function autoloadController($classname){
    require_once 'Controller/' . $classname . '.php';
}

spl_autoload_register('autoloadController'); 