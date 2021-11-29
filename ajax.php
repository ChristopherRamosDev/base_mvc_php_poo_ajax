<?php


if (isset($_POST['tag']) && !empty($_POST['tag'])) {
    $tag = $_POST['tag'];
   echo json_encode($tag);
    
        /* case 'index':
            index();
            break; */
       /*  case 'insert':
            insert();
            break; */
            // ...etc...
    }
