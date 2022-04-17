<?php

namespace App\Models;

use App\Classes\Contenedor as ClassesContenedor;
use App\Config\DBConnector;
use Exception;
use PDO;

class Contenedor
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
      $query = 'SELECT id_contenedor, id_operacion, numero_contenedor, tipo_contenedor, dimensiones, fecha_descargo FROM contenedores WHERE id_operacion = :id_operacion ORDER BY id_contenedor DESC';
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

  public function getContenedor(int $contenedorId)
  {
    try {
      $query = 'SELECT id_contenedor, id_operacion, numero_contenedor, tipo_contenedor, dimensiones, fecha_descargo FROM contenedores WHERE id_contenedor = :id_contenedor LIMIT 1';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id_contenedor' => $contenedorId
      ]);
      $data = $stmt->fetchAll(PDO::FETCH_CLASS);
      return $data;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Query Error");
    }
  }

  public function create(ClassesContenedor $contenedor)
  {
    try {
      $query = 'INSERT INTO welldex_operaciones.contenedores (
        id_operacion,
        numero_contenedor,
        tipo_contenedor,
        dimensiones
      ) VALUES (
        :id_operacion,
        :numero_contenedor,
        :tipo_contenedor,
        :dimensiones
      );';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':id_operacion' => $contenedor->getOperacionId(),
        ':numero_contenedor' => $contenedor->getNumeroContenedor(),
        ':tipo_contenedor' => $contenedor->getTipoContenedor(),
        ':dimensiones' => $contenedor->getDimensiones()
      ]);

      $id = $this->db->lastInsertId();
      return $id;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Insert Error");
    }
  }

  public function remove(int $contenedorId)
  {
    try {
      $query = 'UPDATE contenedores SET fecha_descargo = :fecha_descargo WHERE id_contenedor = :id_contenedor;';
      $stmt = $this->db->prepare($query);
      $stmt->execute([
        ':fecha_descargo' => date('Y-m-d H:i:s'),
        ':id_contenedor' => $contenedorId,
      ]);
      return $contenedorId;
    } catch (\Throwable $th) {
      throw new Exception("Operacion Insert Error");
    }
  }
}
