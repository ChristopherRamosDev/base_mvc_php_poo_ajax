<?php

class View
{
    function __construct()
    {
        /* echo "<p>Vista base </p>"; */
        
    }
    function render($renderView)
    {
         require_once 'View/' . $renderView . '.php';
        
        
    }
}
