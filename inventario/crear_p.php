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
$database = "INVENTARIO";
$username = "usuario";
$password = "vital2024.";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



$field1 = $conn->real_escape_string($_POST['field1']);
$field2 = $conn->real_escape_string($_POST['field2']);
$field3 = $conn->real_escape_string($_POST['field3']);
$fechav = $conn->real_escape_string($_POST['fechav']);

$query = "INSERT INTO art (cod_barra, descripcion)
            VALUES ('{$field1}','{$field2}')";
$query2 = "INSERT INTO control_lotes (num_lote, cod_art, descr_art, fecha_venc)
            VALUES ('{$field3}','{$field1}','{$field2}','{$fechav}')";
$conn->query($query);
$conn->query($query2);
ECHO "PRODUCTO CREADO";
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
						
          
</div>      
</div>
</td><td> <h1 id="logo"><center><a >CREAR PRODUCTO </a></center></h1> </td> <td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

 </table> 	

		
		
		
		
		
					
				</header>

			<!-- Banner -->
				<section id="banner">		
						
				

						<form action="crear_p.php" method="post">
<Table>						
   <tr> 
   
   

  
   <td class="td0" > COD_ARTICULO: <input type="text" name = "field1" id="cursor"/> </td><td>&#160;&#160;</td>
   <td class="td0" > DESCRIPCION: <input type="text" name = "field2" id="cursor"/> </td><td>&#160;&#160;</td>
   <td class="td0" > LOTE: <input type="text" name = "field3" /><td>&#160;&#160;</td> </td><td>&#160;&#160;</td>
    <td class="td0" > FECHA VENC: <br> <input type="date" name = "fechav" /></td></tr>
   
   </tr>
</Table>	
    <input type="submit" value="CREAR" /> 

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