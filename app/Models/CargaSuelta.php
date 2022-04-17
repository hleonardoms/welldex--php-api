<?php

namespace App\Models;

use App\Classes\CargaSuelta as ClassesCargaSuelta;
use App\Config\DBConnector;
use Exception;
use PDO;

class CargaSuelta
{
  private $db;

  public function __construct()
  {
    $this->db = DBConnector::connect();
  }

  public function all()
  {
    // $data = DBConnector::query('SELECT * FROM operaciones');
    $data = [];
    return $data;
  }

  public function get(int $operacionId)
  {
    try {
      $query = 'SELECT id_carga_suelta, id_operacion, descripcion, cantidad FROM cargas_sueltas WHERE id_operacion = :id_operacion ORDER BY id_carga_suelta DESC';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id_operacion' => $operacionId
      ]);
      $data = $stmt->fetchAll(PDO::FETCH_CLASS);
      return $data;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Query Error");
    }
  }

  public function create(ClassesCargaSuelta $cargaSuelta)
  {
    try {
      $query = 'INSERT INTO welldex_operaciones.cargas_sueltas (
        id_operacion,
        descripcion,
        cantidad
      ) VALUES (
        :id_operacion,
        :descripcion,
        :cantidad
      );';

      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id_operacion' => $cargaSuelta->getOperacionId(),
        ':descripcion' => $cargaSuelta->getDescripcion(),
        ':cantidad' => $cargaSuelta->getCantidad(),
      ]);

      $id = $this->db->lastInsertId();
      return $id;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Insert Error");
    }
  }

  public function update(int $id, int $cantidad)
  {
    try {
      $query = 'UPDATE cargas_sueltas SET cantidad = :cantidad WHERE id_carga_suelta = :id_carga_suelta;';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':cantidad' => $cantidad,
        ':id_carga_suelta' => $id,
      ]);
      return $id;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Insert Error");
    }
  }
}
