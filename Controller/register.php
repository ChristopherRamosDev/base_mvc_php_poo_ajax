<?php

require_once 'Model/RegistroModel.php';
class register /* extends Controller  */
{

    function __construct()
    {
        /*  parent::__construct();  
          require_once 'View/register.php';    */
    }
    public function render()
    {
        require_once 'View/register.php';
    }
    function saludar($usu,$clave)
    {
        return "hola " . $usu . " " .$clave ;
    }
    public function insert(string $first,string $pass)
    {

        /* $first = $_POST['nombres'];
        $second = $_POST['apellidos'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['password']; */

        $user = new RegistroModel();
        /* $user->setfirstName($first); */
            /*         $user->setlastName($second);
        $user->setemail($email);
        $user->setUsuario($usuario);
        $user->setClave($clave) */;
        $save = $user->insert($first,$pass);
        /* var_dump($save); */
        return  $save;

        /* header('Location' .base_url.  'Login'); */
    }
}
