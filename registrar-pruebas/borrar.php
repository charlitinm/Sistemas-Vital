<?php


// confirmar sesion

session_start();


if (!isset($_SESSION['loggedin'])) {

    header('Location: login.html');
    exit;
}

?>



<!DOCTYPE HTML>

<html>
	<head>
		<title>REGISTRO DE PEDIDOS</title>
		<meta charset="utf-8" />
	
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" /><link rel="shortcut icon" href="images/icono.jpg" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	</head>
	<body class="index is-preload">	<header id="header" class="alt">
							<table><td>
<div class="dropdown">  <button class="dropbtn">MENÚ</button>
 <div class="dropdown-content">	

  <a href="registrar_ruta.php">Registrar Ruta</a>
    <a href="registrar_empleado.php">Registrar Empleado</a>
    <a href="consultar_pedido.php">Consultar Pedido</a>
									<a href="mejor_des.php">Estadisticas</a>
									<a href="pedidos_desp.php">Pedidos x Despachador</a>
									<a href="fallas_desp.php">Fallas x Despachador</a>
									<a href="todos_pedidos.php">Pedidos Por Fecha</a>
									<a href="inicio.php">Inicio</a>
									
 	
</div>      
</div>
</td><td><h1 id="logo"><center><a href="inicio.php">Borrar Pedido </a></center></h1></td><td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>
 </table> 
		
		
					
				</header>

			<!-- Banner -->
				<section id="banner">

					<!--
						".inner" is set up as an inline-block so it automatically expands
						in both directions to fit whatever's inside it. This means it won't
						automatically wrap lines, so be sure to use line breaks where
						appropriate (<br />).
					-->
					
<?php
$servername = "192.168.0.164";
$database = "registros";
$username = "usuario";
$password = "vital2024.";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   ?>
						<form action="borrar_ped.php" method="post">
<Table>						
   <tr> <td class="td0" >NUM_PEDIDO: <input type="text" name = "field1" class="inputb" /></td>
   
</Table>	
    <input type="submit" value="BORRAR PEDIDO" /> 

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