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
					<h1 id="logo"><a href="inicio.php">Pedidos Por Fecha </a></h1>
											<table><td>
<div class="dropdown">  <button class="dropbtn">MENÚ</button>
 <div class="dropdown-content">			
									
								<a href="registrar_ruta.php">Registrar Ruta</a>
									<a href="registrar_empleado.php">Registrar Empleado</a>
									<a href="consultar_pedido.php">Consultar Pedido</a>
									<a href="mejor_des.php">Estadisticas</a>
									<a href="pedidos_desp.php">Pedidos x Despachador</a>
									<a href="fallas_desp.php">Fallas x Despachador</a>
									<a href="inicio.php">Inicio</a>
									
				
				
</div>      
</div>
</td><td><h1 id="logo"><center><a href="inicio.php">Pedidos Por Fecha y Ruta  </a><center></h1><td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

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
$consulta=mysqli_query($conn,$query);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	
}  
			



 ?>
 


 
 
 
 
 
 
 
 
						<form action="todos_ped.php" method="post">
<Table>		
<center>
<tr>
<td><h1 id="logo">Pedidos Por Fecha </h1></td><td><h1 id="logo">Pedidos Por Ruta </h1></td> </tr>
<tr>				
<td>
  
    Inicio: <input type="datetime-local" name = "todosp" />
  Fin: <input type="datetime-local" name = "todosp2" />	
  
  </td>
   <td class="td0" > RUTA:
  
   <select name = "fiel2" autocomplete="on" id="ruta" onchange="ShowSelected();">
   <?php
   while($obj=mysqli_fetch_array($consulta)){ ?>
   echo'<option value="'.$obj[1].'"><?php echo  "$obj[1]";?></option>';
   <?php }  ?>
   </td></tr>
 
  </center>
</Table>	
<center>  <br>  <input type="submit" value="CONSULTAR" /> </center>
<BR>	
<BR>


<table class="table table-striped">
  	
		<thead>
		<tr>
			<th>Num_Pedido</th>
			<th>Ruta</th>
			<th>Nomb_Empleado</th>
			<th>Unidades</th>
			<th>Fecha</th>
			<th>Rechequeador</th>
			<th>Errores Detectados</th>
		</tr>
		</thead>


<?php
$todosp = $conn->real_escape_string($_POST['todosp']);
$todosp2 = $conn->real_escape_string($_POST['todosp2']);
$field2 = $conn->real_escape_string($_POST['field2']);

/*$query = "SELECT * from pedidos  
where fecha BETWEEN '$todosp' AND '$todosp2'";*/




if ($field2=="TODAS"){
$query="SELECT * from pedidos  
where fecha BETWEEN '$todosp' AND '$todosp2'";
$query2 = "SELECT NUM_PEDIDO,
COUNT(NUM_PEDIDO) AS TODOS_PEDIDOS, # Obtenemos el candidato y su repetición
SUM(UNIDADES) AS UNIDADES_T
FROM pedidos
WHERE fecha BETWEEN '$todosp' AND '$todosp2'";
}
else{
$query="SELECT * from pedidos  
where ruta='$field2' and fecha BETWEEN '$todosp' AND '$todosp2'";
$query2 = "SELECT NUM_PEDIDO,
COUNT(NUM_PEDIDO) AS TODOS_PEDIDOS, # Obtenemos el candidato y su repetición
SUM(UNIDADES) AS UNIDADES_T
FROM pedidos
WHERE ruta='$field2' and fecha BETWEEN '$todosp' AND '$todosp2'";	
}
$datos= mysqli_query ($conn,$query);
$datos2= mysqli_query ($conn,$query2);
//$datos4= mysqli_query ($conn,$query4);
   ?>
 <?php while ($fila =mysqli_fetch_array($datos)){?>
 <?php 
 $pedido=$fila [0];
 $query3 = "SELECT NOMB_RECHEQUEADOR, NUM_PEDIDO,
COUNT(NUM_PEDIDO) AS PEDIDOS # Obtenemos el candidato y su repetición
FROM fallas
WHERE NUM_PEDIDO = '$pedido'";   
$datos3= mysqli_query ($conn,$query3);?>
<?php while ($fila3 =mysqli_fetch_array($datos3)){?>
 
 
	<tr>
	<td class="td0" ><?php echo $fila [0]; ?></td>
    <td class="td0" ><?php echo $fila [1]; ?></td>
    <td class="td0" ><?php echo $fila [2]; ?></td> 
	<td class="td0" ><?php echo $fila [3]; ?></td>
	<td class="td0" ><?php echo $fila [4]; ?></td>
	<td class="td0" ><?php echo $fila3 [0]; ?></td>
	<td class="td0" ><?php echo $fila3 [2]; ?></td>
	</tr>
<?php }  ?>
<?php }  ?>
<?php while ($fila2 =mysqli_fetch_array($datos2)){?>

<td class="td0" ><?php echo 'TOTAL DE PEDIDOS' ?></td>
<td class="td0" ><?php echo $fila2 [1]; ?></td>
<td class="td0" ><?php echo 'TOTAL DE UNIDADES' ?></td>
<td class="td0" ><?php echo $fila2 [2]; ?></td>
<?php }  ?>
</table>
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


<input  class="input0"  type="text" name="field2" id="valor_ruta" value="">

  </form>
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

	</body>
</html>