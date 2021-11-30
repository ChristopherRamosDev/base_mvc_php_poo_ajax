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
    function saludar($usu, $clave)
    {
        return "hola " . $usu . " " . $clave;
    }
    public function insert(string $nombres, string $apellidos, string $email, string $usuario, string $clave)
    {
        $user = new RegistroModel();
        $save = $user->insert($nombres, $apellidos, $email, $usuario, $clave);
        return  $save;
    }
}
