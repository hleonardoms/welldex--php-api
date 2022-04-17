<?php

namespace App\Http\Controllers;

use App\Classes\Importacion as ClassesImportacion;
use App\Classes\Operacion as ClassesOperacion;
use App\Models\Importacion;
use App\Models\Operacion;

class ImportacionController
{
  private $importacion;

  public function __construct()
  {
    $this->importacion = new Importacion();
  }

  public function index()
  {
    $data = $this->importacion->all();
    if (empty($data)) {
      return [
        'status' => 404,
        'data' => [
          'message' => 'No se encontraron datos.'
        ]
      ];
    } else {
      return [
        'status' => 200,
        'data' => $data
      ];
    }
  }

  public function store()
  {
    $request = file_get_contents('php://input');

    if (empty($request)) {
      return [
        'status' => 400,
        'data' => [
          'message' => 'No se puede generar la operación sin datos.'
        ]
      ];
    }

    $data = json_decode($request, true);

    if (
      empty($data['id_operacion']) ||
      empty($data['fecha_arribo']) ||
      empty($data['pais_origen'])
    ) {
      return [
        'status' => 400,
        'data' => [
          'message' => 'No se registraron todos los campos para generar una operación.'
        ]
      ];
    }

    $importacion = new ClassesImportacion(
      $data['id_operacion'],
      $data['fecha_arribo'],
      $data['pais_origen']
    );

    $importacionId = $this->importacion->create($importacion);

    $operacionModel = new Operacion();
    $operacionData = $operacionModel->get($data['id_operacion']);
    $operacionData = (array) $operacionData[0];
    $operacionObj = new ClassesOperacion(
      $operacionData['referencia'],
      $operacionData['pedimento'],
      $operacionData['cliente'],
      $operacionData['aduana'],
      $operacionData['patente'],
      $operacionData['tipo_mercancia'],
      $operacionData['tipo_operacion'],
      $operacionData['estatus'],
      $operacionData['created_at']
    );

    $operacionObj->setEstatus('ETA');
    $operacionObj->setUpdatedAt(date('Y-m-d H:i:s'));

    $operacionModel->update($data['id_operacion'], $operacionObj);

    return [
      'status' => 201,
      'data' => [
        'message' => 'Created',
        'data' => [
          'id_importacion' => (int) $importacionId,
          'id_operacion' => (int) $importacion->getOperacionId(),
          'fecha_arribo' => $importacion->getFechaArribo(),
          'pais_origen' => $importacion->getPaisOrigen()
        ]
      ]
    ];
  }
}
