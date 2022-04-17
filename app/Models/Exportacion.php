<?php

namespace App\Models;

use App\Classes\Exportacion as ClassesExportacion;
use App\Config\DBConnector;
use Exception;
use PDO;

class Exportacion
{
  private $db;

  public function __construct()
  {
    $this->db = DBConnector::connect();
  }

  public function all()
  {
    try {
      $query = 'SELECT id_exportacion, id_operacion, fecha_zarpe, pais_destino FROM exportaciones';
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_CLASS);
      return $data;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Query Error");
    }
  }

  public function create(ClassesExportacion $exportacion)
  {
    try {
      $query = 'INSERT INTO welldex_operaciones.exportaciones (id_operacion, fecha_zarpe, pais_destino) VALUES (:id_operacion, :fecha_zarpe, :pais_destino);';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id_operacion' => $exportacion->getOperacionId(),
        ':fecha_zarpe' => $exportacion->getFechaZarpe(),
        ':pais_destino' => $exportacion->getPaisDestino(),
      ]);

      $id = $this->db->lastInsertId();
      return $id;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Insert Error");
    }
  }
}
