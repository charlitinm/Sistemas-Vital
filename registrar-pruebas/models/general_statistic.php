<?php 

include '../connection/connection.php';

class GeneralStatisticModel extends Connection{
  private $conn;

  public function __construct(){
      $this->conn = $this->connect();
  }

  public function mejor_despachador($start_date, $final_date){

    $sql = "SELECT NOMB_EMPLEADO,
    COUNT(NOMB_EMPLEADO) AS MAYOR_VOTADO, # Obtenemos el candidato y su repetición
    SUM(UNIDADES) AS UNIDADES_T
    FROM pedidos
    WHERE fecha BETWEEN '$start_date' AND '$final_date'
    GROUP BY NOMB_EMPLEADO # Agrupamos los resultados por el nombre
    ORDER BY UNIDADES_T DESC # Ordenamos los resultados por el contador de forma descendiente
    ";

    $result = $this->conn->query($sql);
    
    // Devolver los resultados como un array JSON
    $pedidos = array();
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $pedidos[] = $row;
        }
    }

    // Cerrar conexión
    //$this->conn->close();

    return ["estadisticas_despachador" => $pedidos];
  }

  public function fallas_despachador($start_date, $final_date){

    $sql = "SELECT NOMB_EMPLEADO,
    COUNT(NOMB_EMPLEADO) AS MAYOR_VOTADO # Obtenemos el candidato y su repetición
    FROM fallas
    WHERE fecha BETWEEN '$start_date' AND '$final_date'
    GROUP BY NOMB_EMPLEADO # Agrupamos los resultados por el nombre
    ORDER BY MAYOR_VOTADO DESC # Ordenamos los resultados por el contador de forma descendiente";


    // $query2 = "SELECT NUM_PEDIDO,
    // COUNT(NUM_PEDIDO) AS TOTAL_PED # Obtenemos el candidato y su repetición
    // FROM fallas
    // WHERE fecha BETWEEN '$start_date' AND '$final_date'";

    $result = $this->conn->query($sql);
    
    // Devolver los resultados como un array JSON
    $fallas = array();
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $fallas[] = $row;
        }
    }

    // Cerrar conexión
    //$this->conn->close();

    return ["fallas_despachador" => $fallas];
  }

  public function fallas_rechequeador($start_date, $final_date){

    $sql = "SELECT NOMB_RECHEQUEADOR,
    COUNT(NOMB_RECHEQUEADOR) AS MAYOR_RECH # Obtenemos el candidato y su repetición
    FROM fallas
    WHERE fecha BETWEEN '$start_date' AND '$final_date'
    GROUP BY NOMB_RECHEQUEADOR # Agrupamos los resultados por el nombre";


    // $query2 = "SELECT NUM_PEDIDO,
    // COUNT(NUM_PEDIDO) AS TOTAL_PED # Obtenemos el candidato y su repetición
    // FROM fallas
    // WHERE fecha BETWEEN '$start_date' AND '$final_date'";

    $result = $this->conn->query($sql);
    
    // Devolver los resultados como un array JSON
    $fallas = array();
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $fallas[] = $row;
        }
    }

    // Cerrar conexión
    //$this->conn->close();

    return ["fallas_rechequeador" => $fallas];
  }

}