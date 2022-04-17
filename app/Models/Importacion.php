<?php

namespace App\Models;

use App\Classes\Importacion as ClassesImportacion;
use App\Config\DBConnector;
use Exception;
use PDO;

class Importacion
{
  private $db;

  public function __construct()
  {
    $this->db = DBConnector::connect();
  }

  public function all()
  {
    try {
      $query = 'SELECT id_importacion, id_operacion, fecha_arribo, pais_origen FROM importaciones';
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_CLASS);
      return $data;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Query Error");
    }
  }

  public function create(ClassesImportacion $importacion)
  {
    try {
      $query = 'INSERT INTO welldex_operaciones.importaciones (id_operacion, fecha_arribo, pais_origen) VALUES (:id_operacion, :fecha_arribo, :pais_origen);';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id_operacion' => $importacion->getOperacionId(),
        ':fecha_arribo' => $importacion->getFechaArribo(),
        ':pais_origen' => $importacion->getPaisOrigen(),
      ]);

      $id = $this->db->lastInsertId();
      return $id;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Insert Error");
    }
  }
}
