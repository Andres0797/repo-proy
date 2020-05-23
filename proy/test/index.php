<?php
use Proyecto\Modelo\Contador as Contador;

require_once('../modelo/Contador.php');

$objeto = new Contador(500,"H54");


var_dump($objeto->insertarContadorBD());
