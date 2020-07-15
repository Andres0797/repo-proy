
<!DOCTYPE html>
<html>
<head>
<metacharset="utf-8" />
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<title>Rutas Portal Dorado</title>
</head>
 <body>


  <style>

    
    body {  
    background:url("https://bogota.gov.co/sites/default/files/inline-images/4-68_0.jpg") no-repeat;
    background-size:1365px 750px;
    }
    #tablaCompleta{
      background-color: white;
    }
    .navegacion{ 
      color: white;
      -webkit-text-stroke: 1px black;
      font-size: 18px; 
      font-weight: bold; 
      font-family: verdana 
    }
    

</style>




  

<center>
<svg width="600" height="100" viewBox="0 0 500 75">
  <text x="0" y="60" style="fill: white; stroke: #000; stroke-width: 3px; font-size: 40px; font-weight: bold; font-family: verdana ">
  Contador de Usuarios
  </text>
</svg>
</center>

        <div class="navegacion">
        
          Selecciona punto a controlar 
          <select id="selecOrigenes">
            <!-- el appennd crea elementos aqui -->
          </select>
          <p>  <a href="listaPortales.php">Que Portal va a ver el Usuario</a> </p>
          <p>  <a href="reportes.php">Grafica de Reportes de Portal</a> </p> 
          <h2><p> Cantidad de Usuarios a la Espera  </p> </h2>
        </div>
       <div id="numeroUsuarios">

        <table id="tablaCompleta" class="tg">
            <thead>
              <tr>
                <th class="tg-0lax">Ruta</th>
                <th class="tg-0lax">Usuarios</th>
                <th class="tg-0lax">Reiniciar</th>
              </tr>
            </thead>
            <tbody>
            <?php
              include('../includes/tablaRutasAdmin.php');

            ?>
            </tbody>
        </table>
         

       </div>

       <div id="contadorMostrar">
         
       </div>
         &nbsp;&nbsp;&nbsp;
         

<script type="text/javascript" src="../../js/jquery-3.5.0.min.js"></script>
<script type="text/javascript" src="../../js/principal.js"></script>
</body>
</html>
