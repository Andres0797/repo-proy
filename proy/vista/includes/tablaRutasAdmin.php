<?php
use Proyecto\Modelo\Ruta as Ruta;

require_once('../../controlador/mysql.php');
require '../../modelo/Ruta.php'; 

$objetoRuta = new Ruta(); 

$listaEstaciones = $objetoRuta->listarEstacionesPorPortal(1);

for ($i=0; $i < sizeof($listaEstaciones); $i++) { 
	
	echo '
	<tr>
	              <td class="tg-0lax">'.$listaEstaciones[$i][1].'</td>
	              <td class="tg-0lax" tg-contador="'.$listaEstaciones[$i][1].'"></td>
	              <td class="tg-0lax">
	                <input type="button" class="botonsitos" id="miBoton" tg-ruta="'.$listaEstaciones[$i][1].'" value="Reiniciar Contador"
	                  style="BORDER: rgb(15,15,15) 1px solid; FONT-SIZE: 15pt;color: white; FONT-FAMILY: Verdana; 
	         BACKGROUND-COLOR: #ad0202"></td>
	</tr>
	




	';
	
}




?>