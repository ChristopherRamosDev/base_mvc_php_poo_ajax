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
    public function insert(string $nombres, string $apellidos, string $email, string $usuario, string $clave)
    {
        $user = new RegistroModel();
        $save = $user->insert($nombres, $apellidos, $email, $usuario, $clave);
        return  $save;
    }
    public function verifyUser(string $usuario)
    {
        $user = new RegistroModel();
        $save = $user->existsUser($usuario);
        return  $save;
    }
}
