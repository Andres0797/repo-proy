<?php
namespace Foo\Bar;
require $_SERVER['DOCUMENT_ROOT']. '\vendor\autoload.php';

use Proyecto\Modelo\Portal as Portal;
class Bar{

    public static function leer(){
        $instancia = new self();
        $portalobj = new Portal(); 
        return $portalobj->listarTodo();
    }
}

print_r(Bar::leer());


?>

