<?php

class Controller
{
    public $view;

    function __construct()
    {
        /* echo "ola desde controller"; */
         $this->view = new View(); 
    }
}