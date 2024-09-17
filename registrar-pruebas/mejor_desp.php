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
		<link rel="stylesheet" href="assets/css/main.css" /><link rel="shortcut icon" href="images/icono.jpg" /><link rel="shortcut icon" href="images/icono.jpg" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		
	</head>
	<body class="index is-preload">
		<div id="page-wrapper">
			<!-- Header -->
				<header id="header" class="alt">
					<table>
						<td>
							<div class="dropdown"> 
								<button class="dropbtn">MENÚ</button>
 								<div class="dropdown-content">		
									<a href="registrar_ruta.php">Registrar Ruta</a>
									<a href="registrar_empleado.php">Registrar Empleado</a>
									<a href="consultar_pedido.php">Consultar Pedido</a>
									<a href="pedidos_desp.php">Pedidos x Despachador</a>
									<a href="fallas_desp.php">Fallas x Despachador</a>
									<a href="todos_pedidos.php">Pedidos Por Fecha</a>
									<a href="inicio.php">Inicio</a>
								</div>      
							</div>
						</td>
						<td> 
							<h1 id="logo"><center><a href="inicio.php">Estadisticas Despachador y Rechequeador </a></center></h1> 
						</td>
						<td align='right'>
							<?= $_SESSION['name'] ?> 
							<a 
								href="cerrar-sesion.php" 
								style="color:white;">
								<i class="fas fa-sign-out-alt"></i>Cerrar Sesión
							</a>	
						</td>
					</table> 
				</header>
				<section id="banner">				
					<form action="mejor_desp.php" method="post">
						Inicio: <input type="datetime-local" name = "desp" />
						Fin: <input type="datetime-local" name = "desp2" />	
						<br><br><br>
						<input type="submit" value="CONSULTAR" />
					</form>
					<br>
					
					<table class="table table-striped">
						<thead>
							<tr> ESTADISTICAS POSITIVAS	MEJOR DESPACHADOR</tr>	<tr>
								<th>Nomb_Empleado</th>
								<th>Cant_Pedidos</th>
								<th>% Respecto Total Pedidos</th>
								<th>Cant_Unidades</th>
								<th>% Respecto Total Unidades</th>
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

							$desp = $conn->real_escape_string($_POST['desp']);
							$desp2 = $conn->real_escape_string($_POST['desp2']);

							$query = "SELECT NOMB_EMPLEADO,
							COUNT(NOMB_EMPLEADO) AS MAYOR_VOTADO, # Obtenemos el candidato y su repetición
							SUM(UNIDADES) AS UNIDADES_T
							FROM pedidos
							WHERE fecha BETWEEN '$desp' AND '$desp2'

							GROUP BY NOMB_EMPLEADO # Agrupamos los resultados por el nombre
							ORDER BY UNIDADES_T DESC # Ordenamos los resultados por el contador de forma descendiente
							";
				
							$query4 = "SELECT NUM_PEDIDO,
							COUNT(NUM_PEDIDO) AS TODOS_PED, # Obtenemos el candidato y su repetición
							SUM(UNIDADES) AS UNIDADES_T
							FROM pedidos
							WHERE fecha BETWEEN '$desp' AND '$desp2'";
							
							$datos= mysqli_query ($conn,$query);
							$datos4= mysqli_query ($conn,$query4);
						?>

						<?php while ($fila4 = mysqli_fetch_array($datos4)){?>
						<?php  $totalp = $fila4 [1]; ?>
						<?php  $totalu = $fila4 [2]; ?>
						<?php } ?>		
					
						<?php while ($fila =mysqli_fetch_array($datos)){?>
							<tr>
								<td class="td0" ><?php echo $fila [0]; ?></td>
								<td class="td0" ><?php echo $fila [1]; ?></td>
								<td class="td0" ><?php $porcp=($fila [1]/$totalp)*100; ?><?php echo $resulp = bcdiv($porcp, '1', 2);?></td>
								<td class="td0" ><?php echo $fila [2]; ?></td> 
								<td class="td0" ><?php $porcu=($fila [2]/$totalu)*100; ?><?php echo $resulp = bcdiv($porcu, '1', 2);?></td>
							</tr>
						<?php } ?>
					</table>

					<table class="table table-striped">
						<thead>
							<tr> ESTADISTICAS POSITIVAS RECHEQUEADOR</tr>	<tr>
								<th>Nomb_Rechequeador</th>
								<th>Fallas Detectadas</th>
								<th>% Respecto Total Fallas</th>
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

							$desp = $conn->real_escape_string($_POST['desp']);
							$desp2 = $conn->real_escape_string($_POST['desp2']);

							$query5 = "SELECT NOMB_RECHEQUEADOR,
							COUNT(NOMB_RECHEQUEADOR) AS MAYOR_RECH # Obtenemos el candidato y su repetición

							FROM fallas
							WHERE fecha BETWEEN '$desp' AND '$desp2'

							GROUP BY NOMB_RECHEQUEADOR # Agrupamos los resultados por el nombre";
								
							$query6 = "SELECT NUM_PEDIDO,
							COUNT(NUM_PEDIDO) AS TODOS_PED # Obtenemos el candidato y su repetición

							FROM fallas
							WHERE fecha BETWEEN '$desp' AND '$desp2'";

							$datos5= mysqli_query ($conn,$query5);
							$datos6= mysqli_query ($conn,$query6);
						?>
					
						<?php while ($fila6 =mysqli_fetch_array($datos6)){?>
						<?php  $totalp= $fila6 [1]; ?>
						<?php } ?>		
						<?php while ($fila5 =mysqli_fetch_array($datos5)){?>
							<tr>
								<td class="td0" ><?php echo $fila5 [0]; ?></td>
								<td class="td0" ><?php echo $fila5[1]; ?></td>
								<td class="td0" ><?php $porcr=($fila5 [1]/$totalp)*100; ?><?php echo $resulr = bcdiv($porcr, '1', 2);?></td>
							</tr>
						<?php } ?>
					</table>

					<table class="table table-striped">
						<thead>
							<tr> ESTADISTICAS NEGATIVAS	DESPACHADOR</tr>	<tr>
								<th>Nomb_Empleado</th>
								<th>Fallas Cometidas</th>
								<th>% Respecto Total Fallas</th>
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

							$desp = $conn->real_escape_string($_POST['desp']);
							$desp2 = $conn->real_escape_string($_POST['desp2']);

							$query2 = "SELECT NOMB_EMPLEADO,
							COUNT(NOMB_EMPLEADO) AS MAYOR_VOTADO # Obtenemos el candidato y su repetición
							FROM fallas
							WHERE fecha BETWEEN '$desp' AND '$desp2'

							GROUP BY NOMB_EMPLEADO # Agrupamos los resultados por el nombre
							ORDER BY MAYOR_VOTADO DESC # Ordenamos los resultados por el contador de forma descendiente";


							$query3 = "SELECT NUM_PEDIDO,
							COUNT(NUM_PEDIDO) AS TOTAL_PED # Obtenemos el candidato y su repetición
							FROM fallas
							WHERE fecha BETWEEN '$desp' AND '$desp2'";	

							$datos2= mysqli_query ($conn,$query2);
							$datos3= mysqli_query ($conn,$query3);
						?>

						<?php while ($fila3 =mysqli_fetch_array($datos3)){?>
						<?php $total= $fila3 [1]; ?>
						<?php } ?>	
						<?php while ($fila2 =mysqli_fetch_array($datos2)){?>

						<tr>
							<td class="td0" ><?php echo $fila2 [0]; ?></td>
							<td class="td0" ><?php echo $fila2 [1]; ?></td>
							<td class="td0" ><?php $porc=($fila2 [1]/$total)*100; ?><?php echo $resul = bcdiv($porc, '1', 2);?></td>
						</tr>
					<?php } ?>
					</table>
					<BR>	
					<BR>	
					<BR>
					<img class="image0" src="images/logo.png" width="200" height="200">	
					<BR><BR>	
					<BR><BR>	
					<BR><BR>	
					<BR><BR>	
					<BR><BR>	
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