 <?php


// confirmar sesion

session_start();


if (!isset($_SESSION['loggedin'])) {

    header('Location: login.html');
    exit;
}

?>



<?php
$servername = "192.168.0.164";
$database = "inventario";
$username = "usuario";
$password = "vital2024.";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



?>





<!DOCTYPE HTML>

<html>
	<head>
		<script type="text/javascript">
function handler(event) {
    var response = event.response;
    var headers = response.headers;

    // Set the cache-control header
    headers['cache-control'] = {value: 'public, max-age=63072000'};

    // Return response to viewers
    return response;
}
</script>
			<title>CONTROL DE INVENTARIO</title>

		<meta charset="utf-8" />
	
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" /><link rel="shortcut icon" href="images/icono.jpg" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	</head>
	<body class="index is-preload" onload="document.getElementById('cursor').focus()">	<header id="header" class="alt">
		<div id="page-wrapper">

			<!-- Header -->
		<!--<img class="image0" src="images/LOGO.png" width="100" height="100">	   -->
			
						
		



<table><td>
<div class="dropdown">  <button class="dropbtn">MENÚ</button>
 <div class="dropdown-content">

						<a href="inicio.php">Consultar Producto</a>
						<a href="crear.php">Crear Producto</a>
						<a href="ajuste_salida.php">Ajuste Salida Existencia</a>
          
</div>      
</div>
</td><td> <h1 id="logo"><center><a >AJUSTE DE ENTRADA DE INVENTARIO  </a></center></h1> </td> <td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

 </table> 	

		
		
		
		
		
					
				</header>

			<!-- Banner -->
				<section id="banner">		
						
					
<?php
$servername = "192.168.0.164";
$database = "inventario";
$username = "usuario";
$password = "vital2024.";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$query="SELECT ID,tipo FROM tipo_ajuste ORDER BY tipo ASC limit 2; ";

$consulta=mysqli_query($conn,$query);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   ?>
						<form action="ajuste_exis.php" method="post">
<Table>						
   <tr> 
   
   

   <td class="td0" > MOTIVO:<br> 
  
   <select name = "fiel1" autocomplete="on" id="ruta" onchange="ShowSelected();">
   <?php
   while($obj=mysqli_fetch_array($consulta)){ ?>
   echo'<option value="'.$obj[1].'"><?php echo  "$obj[1]";?></option>';
   
   <?php 
   }
   ?>
  </select> 
   </td><td>&#160;&#160;</td>
   <td class="td0" >COD_ART: <input type="text" name = "field2" class="inputb" id="cursor" /><td>&#160;&#160;</td></td>
   <td class="td0" > CANTIDAD: <input type="text" name = "field3" /> <td>&#160;&#160;</td></td>
   <td class="td0" > LOTE: <input type="text" name = "field4" /><td>&#160;&#160;</td> </td>
    <td class="td0" > FECHA VENC: <br> <input type="date" name = "fechav" /></td></tr>
</Table>	
    <input type="submit" value="AJUSTAR" /> 

<BR>	
<BR>
<BR>
<img class="image0" src="images/LOGO.png" width="200" height="200">	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<BR>	<BR>	
<input  class="input0"  type="text" name="field1" id="valor_ruta" value="">

</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
  </script>
<script type="text/javascript">
$("#ruta").change(function() {
  var valor = $(this).val(); // Capturamos el valor del select
  var texto = $(this).find('option:selected').text(); // Capturamos el texto del option seleccionado

  $("#id_ruta").val(valor);
  $("#valor_ruta").val(texto);
});
</script>




				</section>

		
				

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	</body>
</html>