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
		
	</head>
	<body class="index is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
							<table><td>
<div class="dropdown">  <button class="dropbtn">MENÚ</button>
 <div class="dropdown-content">		
								
									
									<a href="registrar_ruta.php">Registrar Ruta</a>
									<a href="registrar_empleado.php">Registrar Empleado</a>
									<a href="mejor_des.php">Estadisticas</a>
								<a href="pedidos_desp.php">Pedidos x Despachador</a>
								<a href="fallas_desp.php">Fallas x Despachador</a>
									<a href="todos_pedidos.php">Pedidos Por Fecha</a>
									
									<a href="inicio.php">Inicio</a>
									
							
					
</div>      
</div>
</td><td> <h1 id="logo"><center><a href="inicio.php">Consultar Pedido </a></center></h1> </td> <td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

 </table> 
				</header>
	
				<section id="banner">				
<form action="pedido.php" method="post">
<Table>						
   <tr> 
   <td class="td0" > Num_Pedido: <input type="text" name = "buscarpedido" /></td>
  </tr>
</Table>	
    <input type="submit" value="CONSULTAR" />
</form>
<br>
<table class="table table-striped">
  	
		<thead>
		<tr>
			<th>Num_Pedido</th>
			<th>Ruta</th>
			<th>Nomb_Empleado</th>
			<th>Cant_Unidades</th>
			<th>Fecha</th>
			<th>Entregado Por</th>
			<th>Rechequeador</th>
			<th>Errores Detectados</th>
		</tr>
		</thead>

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
}



$buscarpedido = $conn->real_escape_string($_POST['buscarpedido']);

$query = "SELECT * FROM PEDIDOS WHERE NUM_PEDIDO ='$buscarpedido'";
$query2 = "SELECT NOMB_RECHEQUEADOR, NUM_PEDIDO,
COUNT(NUM_PEDIDO) AS PEDIDOS # Obtenemos el candidato y su repetición
FROM fallas
WHERE NUM_PEDIDO = '$buscarpedido'";


$datos= mysqli_query ($conn,$query);
$datos2= mysqli_query ($conn,$query2);
?>
		
<?php while ($fila =mysqli_fetch_array($datos)){?>
<?php while ($fila2 =mysqli_fetch_array($datos2)){?>
	<td class="td0" ><?php echo $fila [0]; ?></td>
    <td class="td0" ><?php echo $fila [1]; ?></td>
    <td class="td0" ><?php echo $fila [2]; ?></td>
    <td class="td0" ><?php echo $fila [3]; ?></td>
    <td class="td0" ><?php echo $fila [4]; ?></td>
	<td class="td0" ><?php echo $fila [5]; ?></td>
    <td class="td0" ><?php echo $fila [6]; ?></td>
	<td class="td0" ><?php echo $fila2 [2]; ?></td>
<?php } ?>
<?php } ?>
</table>



<BR>	
<BR>	
<BR>	
<img class="image0" src="images/logo.png" width="200" height="200">
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

	</body>
</html>