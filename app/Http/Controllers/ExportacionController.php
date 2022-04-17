<?php

namespace App\Http\Controllers;

use App\Classes\Exportacion as ClassesExportacion;
use App\Classes\Operacion as ClassesOperacion;
use App\Models\Exportacion;
use App\Models\Operacion;

class ExportacionController
{
  private $exportacion;

  public function __construct()
  {
    $this->exportacion = new Exportacion();
  }

  public function index()
  {
    $data = $this->exportacion->all();
    if (empty($data)) {
      return [
        'status' => 404,
        'data' => [
          'message' => 'Not Found'
        ]
      ];
    } else {
      return [
        'status' => 200,
        'message' => 'OK',
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
          'message' => 'Bad Request'
        ]
      ];
    }

    $data = json_decode($request, true);

    if (
      empty($data['id_operacion']) ||
      empty($data['fecha_zarpe']) ||
      empty($data['pais_destino'])
    ) {
      return [
        'status' => 400,
        'data' => [
          'message' => 'Bad Request'
        ]
      ];
    }

    $exportacion = new ClassesExportacion(
      $data['id_operacion'],
      $data['fecha_zarpe'],
      $data['pais_destino']
    );

    $exportacionId = $this->exportacion->create($exportacion);

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

    $operacionObj->setEstatus('ETD');
    $operacionObj->setUpdatedAt(date('Y-m-d H:i:s'));

    $operacionModel->update($data['id_operacion'], $operacionObj);

    return [
      'status' => 201,
      'data' => [
        'message' => 'Created',
        'data' => [
          'id_importacion' => (int) $exportacionId,
          'id_operacion' => (int) $exportacion->getOperacionId(),
          'fecha_zarpe' => $exportacion->getFechaZarpe(),
          'pais_destino' => $exportacion->getPaisDestino()
        ]
      ]
    ];
  }
}
