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



$field1 = $conn->real_escape_string($_POST['field1']);
$field5 = $conn->real_escape_string($_POST['field5']);
$field6 = $conn->real_escape_string($_POST['field6']);

$fechav = $conn->real_escape_string($_POST['fechav']);
$query ="select * from art where cod_barra='$field1'";
$conn->query($query);
$datos= mysqli_query ($conn,$query);

 while ($fila =mysqli_fetch_array($datos)){
$datos1=$fila [1]; 

 } if ($datos1!=''){ 

$query3= "select * from control_lotes where num_lote=$field5 and cod_art=$field1";
$conn->query($query3);
$datos2= mysqli_query ($conn,$query3);
$número_filas = mysqli_num_rows($datos2);


if ($número_filas!='0'){	
 while ($fila2 =mysqli_fetch_array($datos2)){
 
	 
	 
$datos3=$fila2 [4]; 
$datos4=$fila2 [0]; 


	
	$query2 = "INSERT INTO ajustes (tipo, cod_barra_art, descripcion_art, cantidad, lote, fecha_venc, fecha_aju, realizado)
            VALUES ('ENTRADA','{$field1}','$datos1','{$field6}','{$field5}','{$fechav}',now(),'{$_SESSION['name']}')";
	$query4 = "UPDATE art SET EXISTENCIA=existencia+$field6 WHERE COD_BARRA=$field1";
	$query5 = "UPDATE control_lotes SET exis_lote=exis_lote+$field6 WHERE num_lote=$field5";
	
	 mysqli_query ($conn,$query2);
	 mysqli_query ($conn,$query4);
	 mysqli_query ($conn,$query5);
 }

 }

else 

 if ($número_filas=='0'){

	$query8 = "INSERT INTO ajustes (tipo, cod_barra_art, descripcion_art, cantidad, lote, fecha_venc, fecha_aju, realizado)
            VALUES ('ENTRADA','{$field1}','$datos1','{$field6}','{$field5}','{$fechav}',now(),'{$_SESSION['name']}')";
	$query7 = "UPDATE art SET existencia=existencia+$field6 WHERE COD_BARRA=$field1";
$query6 = "INSERT INTO control_lotes (num_lote, cod_art, descr_art, fecha_venc, exis_lote)
            VALUES ('{$field5}','{$field1}','$datos1','{$fechav}','{$field6}')";
			
			mysqli_query ($conn,$query6);
	mysqli_query ($conn,$query7);
	mysqli_query ($conn,$query8);


 }
 
 }
else header ('Location: http://192.168.0.164/INVENTARIO/supervisor3.php');
mysqli_close($conn);
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
</td><td> <h1 id="logo"><center><center><a >AJUSTE DE ENTRADA DE INVENTARIO  </a></center></h1> </td> <td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

 </table> 	

		

<BR><center><p><B>AJUSTE DE ENTRADA REALIZADO <B>	 </p></center>

		
<center><a href="inicio.php">	<input type="submit" value="INICIO" />	</a></center>
					
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