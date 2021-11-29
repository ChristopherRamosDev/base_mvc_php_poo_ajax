

<?php

require_once "Controller/register.php";
require_once "Model/RegistroModel.php";
class ajaxUsuarios
{
    public function __construct()
    {
    }
    public function render()
    {
        $data = $_POST;
        $userRegister = new Register;
        /* foreach($data as $d){
            $dataNonbbres = $d['nombres'];
        }
        echo json_encode($dataNonbbres); */
        $nombres = $data['usuario'];
        $ape = $data['password'];
        /* echo json_encode($nombres,$ape);  
         die();  */
        $insert = $userRegister->insert($nombres, $ape);
        echo json_encode($insert);
    }
    public function saludar()
    {
        $data = $_POST;
        $userRegister = new Register;
        $nombres = $data['usuario'];
        $ape = $data['password'];
        /* echo json_encode($nombres,$ape);  
         die();  */
        $insert = $userRegister->saludar($nombres, $ape);
        echo json_encode($insert);
    }
}
