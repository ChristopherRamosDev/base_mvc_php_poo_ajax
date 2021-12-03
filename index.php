<?php
session_start();
require_once 'config/db.php';
require_once 'autoloadController.php';
require_once 'autoloadModel.php';
require_once 'config/parameters.php';
require_once 'libs/controller.php';
require_once 'libs/view.php';
/*  require_once 'Controller/Register.php';  */
/* require_once 'libs/model.php'; */
require_once 'utils/ajax.php';
require_once 'libs/app.php';


$app = new App();
