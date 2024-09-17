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


$query = "SELECT * FROM ART WHERE COD_BARRA='$field1'";
$query2= "select * from control_lotes where  cod_art='$field1'";
$query3= "select *, SUM(exis_lote) AS EXIS_LOTE_T  from control_lotes where  cod_art='$field1'";

$conn->query($query);
$datos= mysqli_query ($conn,$query);
$conn->query($query2);
$datos2= mysqli_query ($conn,$query2);
$conn->query($query3);
$datos3= mysqli_query ($conn,$query3);
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

						
						<a href="crear.php">Crear Producto</a>
       					<a href="ajuste.php">Ajuste Entrada Existencia</a>
						<a href="ajuste_salida.php">Ajuste Salida Existencia</a>
</div>      
</div>
</td><td> <h1 id="logo"><center><a >CONTROL DE INVENTARIO </a></center></h1> </td> <td align='right'> 	 <?= $_SESSION['name'] ?> <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>	</td>

 </table> 	

		
		
		
		
		
					
				</header>

			<!-- Banner -->
				<section id="banner">		
						
				

						<form action="index.php" method="post">
<Table>						
   <tr> 
   
   

  
   <td class="td0" > COD_ARTICULO: <input type="text" name = "field1" id="cursor"/> </td>
  
   
   </tr>
</Table>	
    <input type="submit" value="CONSULTAR" /> 

<BR>	
<BR>
<BR>
<table class="table table-striped">
  	
		<thead>
		<tr>
			<th>Codigo</th>
			<th>Descripcion</th>
			<th>Existencia</th>

		</tr>
		</thead> 
<?php while ($fila =mysqli_fetch_array($datos)){?>
	<td class="td0" ><?php echo $fila [0]; ?></td>
    <td class="td0" ><?php echo $fila [1]; ?></td>
    <td class="td0" ><?php echo $fila [2]; ?></td>

<?php } ?>
</table>



<table class="table table-striped">
  	
		<thead>
		<tr>
			<th>Codigo</th>
			<th>Descripcion</th>
			<th>Lote</th>
			<th>Fecha_Venc</th>
			<th>Existencia</th>

		</tr>
		</thead> 
<?php while ($fila2 =mysqli_fetch_array($datos2)){?>
	<tr> <td class="td0" ><?php echo $fila2 [1]; ?></td>
    <td class="td0" ><?php echo $fila2 [2]; ?></td>
    <td class="td0" ><?php echo $fila2 [0]; ?></td>
	<td class="td0" ><?php echo $fila2 [3]; ?></td>
    <td class="td0" ><?php echo $fila2 [4]; ?></td>
</tr>
<?php } ?>
<br>
<?php while ($fila3 =mysqli_fetch_array($datos3)){?>
	<tr> <td class="td0" ><p></p></td>
    <td class="td0" ><p></p></td>
    <td class="td0" ><p></p></td>
	<td class="td0" ><?php echo "TOTAL EXISTENCIA"; ?></td>
    <td class="td0" ><?php echo $fila3 [5]; ?></td>
</tr>
<?php } ?>
</table>

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