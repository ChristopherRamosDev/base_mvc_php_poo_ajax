<?php
/* require_once "Controller/register.php";
require_once "Controller/Login.php"; */

if (isset($_POST['tag']) && !empty($_POST['tag'])) {
    $tag = $_POST['tag'];

    switch ($tag) {
        case 'registerUser':
            registerUser();
            break;
        case 'loginUser':
            loginUser();
            break;
            /* case 'index':
            index();
            break; */
            /*  case 'insert':
            insert();
            break; */
            // ...etc...
    }
}
function registerUser()
{

    $data = $_POST;
    /* $userRegister = new Register; */
     /* echo json_encode($data); 
    die(); */
    /*  echo json_encode($userRegister->insert($data['nombres'], $data['apellidos'], $data['email'], $data['usuario'], $data['password'])); */ 
    
}
function loginUser()
{

    $data = $_POST;
    $loginUser = new Login;
    /*  echo json_encode($data);
    die();  */ 
    echo json_encode($loginUser->login($data['user'], $data['pass']));
}
