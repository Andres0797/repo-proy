<?php
namespace Proyecto\Test;

require $_SERVER['DOCUMENT_ROOT']. '\vendor\autoload.php';

use Proyecto\Modelo\Administrador as Administrador;
use Proyecto\Modelo\AdminDAO;
class Bar{

    public static function leer(){
        $instancia = new self();
        $portalobj = new Administrador(); 
        return $portalobj->getUsuario("pepito1","megustalachangua");
    }
}

print_r(Bar::leer()->obtenerTodo());  


?>

