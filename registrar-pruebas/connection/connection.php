<?php

class Connection{

  private $host;
  private $username;
  private $password;
  private $db_name;

  public function get_data_config() {
    $this->host = '192.168.0.164';
    $this->username = 'usuario';
    $this->password = 'vital2024.';
    $this->db_name = 'registros';
  }

  public function connect(){

      $this->get_data_config();

      // Crear conexión
      $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
      
      // Verificar conexión
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      return $conn;
  }
}