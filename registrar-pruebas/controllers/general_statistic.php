<?php

include '../models/general_statistic.php';

class GeneralStatisticController {

  public function mejor_despachador($start_date='', $final_date=''){
    $model = new GeneralStatisticModel();
    $data = $model->mejor_despachador($start_date,$final_date);
    return $data;
  }

  public function fallas_despachador($start_date='', $final_date=''){
    $model = new GeneralStatisticModel();
    $data = $model->fallas_despachador($start_date, $final_date);
    return $data;
  }

  public function fallas_rechequeador($start_date='', $final_date=''){
    $model = new GeneralStatisticModel();
    $data = $model->fallas_rechequeador($start_date, $final_date);
    return $data;
  }
}

//Recibimos los datos para extraer las estadisticas
if(isset($_GET['extract_statistic'])){

  // Obtener los datos del formulario
  $start_date = $_POST['start_date'];
  $final_date = $_POST['final_date'];

  $mejor_despachador = new GeneralStatisticController();

  $data_mejor_despachador = $mejor_despachador->mejor_despachador($start_date, $final_date);
  $data_fallas_despachador = $mejor_despachador->fallas_despachador($start_date,$final_date);
  $data_fallas_recheador = $mejor_despachador->fallas_rechequeador($start_date,$final_date);
  echo json_encode([$data_mejor_despachador,$data_fallas_despachador,$data_fallas_recheador]);
}
