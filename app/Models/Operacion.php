<?php

namespace App\Models;

use App\Classes\Operacion as ClassesOperacion;
use App\Config\DBConnector;
use Exception;
use PDO;

class Operacion
{
  private $db;

  public function __construct()
  {
    $this->db = DBConnector::connect();
  }

  public function all()
  {
    try {
      $query = 'SELECT id_operacion, referencia, pedimento, cliente, aduana, patente, tipo_mercancia, tipo_operacion, estatus, created_at, updated_at, deleted_at FROM operaciones ORDER BY id_operacion DESC';
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $data = $stmt->fetchAll(PDO::FETCH_CLASS);
      return $data;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Query Error");
    }
  }

  public function get(int $id)
  {
    try {
      $query = 'SELECT id_operacion, referencia, pedimento, cliente, aduana, patente, tipo_mercancia, tipo_operacion, estatus, created_at, updated_at, deleted_at FROM operaciones WHERE id_operacion = :id_operacion';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id_operacion' => $id
      ]);
      $data = $stmt->fetchAll(PDO::FETCH_CLASS);
      return $data;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Query Error");
    }
  }

  public function create(ClassesOperacion $operacion)
  {
    try {
      $query = 'INSERT INTO welldex_operaciones.operaciones (
          referencia,
          pedimento,
          cliente,
          aduana,
          patente,
          tipo_mercancia,
          tipo_operacion,
          estatus,
          created_at
        ) VALUES (
          :referencia,
          :pedimento,
          :cliente,
          :aduana,
          :patente,
          :tipo_mercancia,
          :tipo_operacion,
          :estatus,
          :created_at
      );';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':referencia' => $operacion->getReferencia(),
        ':pedimento' => $operacion->getPedimento(),
        ':cliente' => $operacion->getCliente(),
        ':aduana' => $operacion->getAduana(),
        ':patente' => $operacion->getPatente(),
        ':tipo_mercancia' => $operacion->getTipoMercancia(),
        ':tipo_operacion' => $operacion->getTipoOperacion(),
        ':estatus' => $operacion->getEstatus(),
        ':created_at' => date('Y-m-d H:i:s')
      ]);

      $id = $this->db->lastInsertId();
      return $id;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Insert Error");
    }
  }

  public function update(int $operacionId, ClassesOperacion $operacion)
  {
    try {
      $query = 'UPDATE operaciones SET referencia = :referencia, pedimento = :pedimento, cliente = :cliente, aduana = :aduana, patente = :patente, tipo_mercancia = :tipo_mercancia, tipo_operacion = :tipo_operacion, estatus = :estatus, created_at = :created_at, updated_at = :updated_at, deleted_at = :deleted_at WHERE id_operacion = :id_operacion;';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':referencia' => $operacion->getReferencia(),
        ':pedimento' => $operacion->getPedimento(),
        ':cliente' => $operacion->getCliente(),
        ':aduana' => $operacion->getAduana(),
        ':patente' => $operacion->getPatente(),
        ':tipo_mercancia' => $operacion->getTipoMercancia(),
        ':tipo_operacion' => $operacion->getTipoOperacion(),
        ':estatus' => $operacion->getEstatus(),
        ':created_at' => $operacion->getCreatedAt(),
        ':updated_at' => $operacion->getUpdatedAt(),
        ':deleted_at' => $operacion->getDeletedAt(),
        ':id_operacion' => $operacionId,
      ]);
      return $operacionId;
    } catch (\Throwable $th) {
      throw new Exception("Operacion UPDATE Error");
    }
  }

  public function updateEstatus(int $operacionId, string $estatus)
  {
    try {
      $query = 'UPDATE operaciones SET estatus = :estatus WHERE id_operacion = :id_operacion;';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':estatus' => $estatus,
        ':id_operacion' => $operacionId,
      ]);
      return $operacionId;
    } catch (\Throwable $th) {
      throw new Exception("Operacion UPDATE Error");
    }
  }
}
