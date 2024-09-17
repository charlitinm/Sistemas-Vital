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
						<a href="ajuste.php">Ajuste Entrada Existencia</a>
          
</div>      
</div>
</td><td> <h1 id="logo"><center><a >AJUSTE DE SALIDA DE INVENTARIO  </a></center></h1> </td> <td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

 </table> 	

		
		
			

<BR><center><p><B>AJUSTE DE SALIDA REALIZADO <B>	 </p></center>

		
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
$query="SELECT NUM_LOTE,COD_ART,DESCR_ART FROM CONTROL_LOTES where COD_ART='$field1' ORDER BY NUM_LOTE ASC  ; ";
$consulta=mysqli_query($conn,$query);


$query2="SELECT DESCR_ART FROM CONTROL_LOTES where COD_ART='$field1' ; ";
$consulta2=mysqli_query($conn,$query2);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}   ?>
		


<?php
$query ="select descripcion from art where cod_barra='$field1'";
$conn->query($query);
$datos= mysqli_query ($conn,$query);
$descr=mysqli_fetch_array($datos);


 

$query3= "select * from control_lotes where num_lote=$field5 and cod_art=$field1";
$conn->query($query3);
$datos2= mysqli_query ($conn,$query3);
$número_filas = mysqli_num_rows($datos2);

if ($número_filas!='0'){	
 while ($fila2 =mysqli_fetch_array($datos2)){
 
	 
$fechav	= $fila2 [3];
$datos3=$fila2 [4]; 
$datos4=$fila2 [0]; 
ECHO $datos4;
ECHO $datos3;
ECHO $field1;

	if ($field6>$datos3 and $_SESSION['name']=='supervisor' ){
		
		$query2 = "INSERT INTO ajustes (tipo, cod_barra_art, descripcion_art, cantidad, lote, fecha_venc, fecha_aju, realizado)
            VALUES ('SALIDA','{$field1}','}${descr[0]}','{$field6}','{$field5}','{$fechav}',now(),'{$_SESSION['name']}')";
		$query4 = "UPDATE art SET EXISTENCIA=existencia-$field6 WHERE COD_BARRA=$field1";
			$query5 = "UPDATE control_lotes SET exis_lote=exis_lote-$field6 WHERE num_lote=$field5";
			
		mysqli_query ($conn,$query2);
	mysqli_query ($conn,$query4);
	 mysqli_query ($conn,$query5);
		}
	else if ( $field6>$datos3 and $_SESSION['name']!='supervisor' )	{
          header ('Location: http://192.168.0.164/INVENTARIO/supervisor.php');
		  }
	     else if ($field6<=$datos3){
		
		$query2 = "INSERT INTO ajustes (tipo, cod_barra_art, descripcion_art, cantidad, lote, fecha_venc, fecha_aju, realizado)
            VALUES ('SALIDA','{$field1}','{descr[0]}','{$field6}','{$field5}','{$fechav}',now(),'{$_SESSION['name']}')";
		$query4 = "UPDATE art SET EXISTENCIA=existencia-$field6 WHERE COD_BARRA=$field1";
			$query5 = "UPDATE control_lotes SET exis_lote=exis_lote-$field6 WHERE num_lote=$field5";
			
			mysqli_query ($conn,$query2);
	mysqli_query ($conn,$query4);
	mysqli_query ($conn,$query5);
		}
		 	 
		 




 }

 }

else 
echo "$número_filas";
 if ($número_filas=='0'){

header ('Location: http://192.168.0.164/INVENTARIO/supervisor2.php');
 }
 

mysqli_close($conn);


  ?>





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