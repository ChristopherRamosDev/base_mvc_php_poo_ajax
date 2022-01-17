<?php

require_once 'Controller/Errores.php';
class App
{
    function __construct()
    {

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        /* $url = rtrim($url, '/'); */

        $url = explode('/', $url);
        /* var_dump($url);
        die(); */
        /* var_dump($url[0]); */
        //cuando ingresamos sin definir controlador
        if (empty($url[0])) {
            $archivoController = 'Controller/Login.php';
            require_once $archivoController;
            $controller = new Login;
            /*con esto quiero decir que loadModel cargara el modelo de la url[0]*/
            /* var_dump($controller); */
            $controller->render();
            /* var_dump($ola); */

            return false;
        }
        $archivoController = 'Controller/' . $url[0] . '.php';
        /* $archivoControllersss = 'Controllers/' . $url[0] . '.php/'; */
        /* var_dump($archivoController); */
        if (file_exists($archivoController)) {
            require_once $archivoController;


            //inicializa el controlador
            $controller = new $url[0];
            /* var_dump($controller);
            die(); */
            /* var_dump($url[1]); */

            if (isset($url[1])) {

                if (method_exists($controller, $url[1])) {

                    if (isset($url[2])) {
                        if (isset($url[3])) {
                            $controller = new Errores;
                            $controller->render();
                        } else {
                            //el método tiene parámetros
                            //sacamos e # de parametros
                            $nparam = sizeof($url) - 2;
                            //crear un arreglo con los parametros
                            $params = [];
                            //iterar
                            for ($i = 0; $i < $nparam; $i++) {
                                array_push($params, $url[$i + 2]);
                            }
                            //pasarlos al metodo   
                            $controller->{$url[1]}($params);
                        }
                    } else {
                        $controller->{$url[1]}();
                    }
                } else {

                    $controller = new Errores;
                    $controller->render();
                }
            } else {
                /* $controller = new Errores; */
                $controller->render();
            }
        } else {

            $controller = new Errores;
            $controller->render();
        }
    }
}
