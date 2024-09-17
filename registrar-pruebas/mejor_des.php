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
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body class="index is-preload">
            <div id="page-wrapper">
                <!-- Header -->
                <header id="header" class="alt">        
                    <div class="flex justify-between">
                        <div>
                            <div class="dropdown">  
                                <button class="dropbtn">
                                    MENÚ
                                </button>
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
                        </div>

                        <!-- <div> 
                            <h1 id="logo">
                            <center><a href="inicio.php">Estadisticas Despachador y Rechequeador </a></center></h1>
                        </div> -->

                        <div class="flex border-2 border-red-500 gap-x-2">
                            <div class="w-fit"><?= $_SESSION['name'] ?></div> 	 
                             <div>
                                <a 
                                    href="cerrar-sesion.php" 
                                    style="color:white;"
                                >
                                    <i class="fas fa-sign-out-alt"></i>Cerrar Sesión
                                </a>
                             </div>
                        </div>
                    </div> 
                </header>
        
                <section id="banner">				
                    <form action="" method="post" >
                        Inicio: <input type="datetime-local" name = "start_date" />
                        Fin: <input type="datetime-local" name = "final_date" />	
                        <br><br><br>
                        <input 
                            type="submit" 
                            value="CONSULTAR" 
                            id="consultar_desp" 
                            name="consultar_desp" 
                        />
                    </form>

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
					</table>

                    <table class="table table-striped">
						<thead>
							<tr> ESTADISTICAS POSITIVAS RECHEQUEADOR</tr>	<tr>
								<th>Nomb_Rechequeador</th>
								<th>Fallas Detectadas</th>
								<th>% Respecto Total Fallas</th>
							</tr>
						</thead>
                    </table>

                    <table class="table table-striped">
						<thead>
                            <tr> ESTADISTICAS NEGATIVAS	DESPACHADOR</tr>	<tr>
								<th>Nomb_Empleado</th>
								<th>Fallas Cometidas</th>
								<th>% Respecto Total Fallas</th>
							</tr>
						</thead>
                    </table>
                    <br>
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
            <script src="assets/js/api.js"></script>
            <script src="assets/js/mejor_des.js" type="module"></script>
        </body>
    </html>
    