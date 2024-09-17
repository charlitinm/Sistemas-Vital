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
									<a href="fallas_desp.php">Fallas x Despachador</a>
									<a href="mejor_des.php">Estadisticas</a>
									<a href="todos_pedidos.php">Pedidos Por Fecha</a>
									
									<a href="inicio.php">Inicio</a>
									
				
</div>      
</div>
</td><td><h1 id="logo"><center><a href="inicio.php">Pedidos Por Despachador </a></center></h1></td> <td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

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
$query="SELECT ID,RUTA FROM RUTAS ORDER BY RUTA ASC; ";
$query2="SELECT ID,NOMB_EMPLEADO FROM EMPLEADOS ORDER BY NOMB_EMPLEADO ASC; ";
$consulta=mysqli_query($conn,$query);
$consulta2=mysqli_query($conn,$query2);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   ?>
						<form action="ped_desp.php" method="post">
<Table>						

   
 NOMB_EMPLEADO: <select name = "fiel3" autocomplete="on" id="empleado" onchange="ShowSelected();">
   <?php
   while($obj2=mysqli_fetch_array($consulta2)){ ?>
   echo'<option value="'.$obj2[1].'"><?php echo  "$obj2[1]";?></option>';
  
   <?php 
   }
   ?>
  </select> 
   <tr>&#160;&#160;&#160; &#160;&#160;&#160;&#160;&#160;&#160;</tr>
    Inicio: <input type="datetime-local" name = "desp" />
  Fin: <input type="datetime-local" name = "desp2" />	
</Table>	
    <input type="submit" value="CONSULTAR" /> 

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

<input   class="input0" type="text" name="field3" id="valor_empleado" value="">
</form>


<script type="text/javascript">
$("#empleado").change(function() {
  var valor = $(this).val(); // Capturamos el valor del select
  var texto = $(this).find('option:selected').text(); // Capturamos el texto del option seleccionado

  $("#id_empleado").val(valor);
  $("#valor_empleado").val(texto);
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