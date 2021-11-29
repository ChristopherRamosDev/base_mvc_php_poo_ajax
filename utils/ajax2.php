<?php
/* 
 require_once "Controller/Login.php";  */

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

function loginUser()
{

    $data = $_POST;
    /* $loginUser = new Login; */
      echo json_encode($data);
    die();  
    /* echo json_encode($loginUser->login($data['user'], $data['pass'])); */
}
