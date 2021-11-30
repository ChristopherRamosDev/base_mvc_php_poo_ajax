<?php

 function autoloadModel($classname){
    require_once 'Model/' . $classname . 'Model.php';
}

spl_autoload_register('autoloadModel'); 