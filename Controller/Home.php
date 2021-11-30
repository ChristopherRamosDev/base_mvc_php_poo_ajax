<?php

class Home  extends Controller
{
    function __construct()
    {
        parent::__construct();
        require_once 'View/Home.php';
    }
    public function render()
    {
        require_once 'View/Home.php';
    }
}
