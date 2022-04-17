<?php

namespace App\Http\Controllers;

use App\Classes\CargaSuelta;
use App\Classes\Contenedor as ClassesContenedor;
use App\Classes\Operacion as ClassesOperacion;
use App\Models\CargaSuelta as ModelsCargaSuelta;
use App\Models\Contenedor as ModelsContenedor;
use App\Models\Operacion;

class OperacionController
{
  private $operacion;

  public function __construct()
  {
    $this->operacion = new Operacion();
  }

  public function index()
  {
    $data = $this->operacion->all();
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
      empty($data['referencia']) ||
      empty($data['pedimento']) ||
      empty($data['cliente']) ||
      empty($data['aduana']) ||
      empty($data['patente']) ||
      empty($data['tipo_mercancia']) ||
      empty($data['tipo_operacion'])
    ) {
      return [
        'status' => 400,
        'data' => [
          'message' => 'No se registraron todos los campos para generar una operación.'
        ]
      ];
    }

    if ($data['tipo_mercancia'] === 'CONTENEDOR' && empty($data['contenedores'])) {
      return [
        'status' => 400,
        'data' => [
          'message' => 'No se asignaron contenedores a la operación.'
        ]
      ];
    }

    foreach ($data['contenedores'] as $contenedor) {
      if (
        empty($contenedor['numero_contenedor']) ||
        empty($contenedor['tipo_contenedor']) ||
        empty($contenedor['dimensiones'])
      ) {
        return [
          'status' => 400,
          'data' => [
            'message' => 'No se asignaron todos los datos de los contenedores.'
          ]
        ];
      }
    }

    $operacion = new ClassesOperacion(
      $data['referencia'],
      $data['pedimento'],
      $data['cliente'],
      $data['aduana'],
      $data['patente'],
      $data['tipo_mercancia'],
      $data['tipo_operacion'],
      'ALTA',
      date('Y-m-d H:i:s')
    );

    $operacionId = $this->operacion->create($operacion);

    if ($operacion->getTipoMercancia() === 'CONTENEDOR') {
      $contenedores = [];
      foreach ($data['contenedores'] as $contenedor) {
        array_push($contenedores, new ClassesContenedor(
          $operacionId,
          $contenedor['numero_contenedor'],
          $contenedor['tipo_contenedor'],
          $contenedor['dimensiones'],
        ));
      }

      $contenedorModel = new ModelsContenedor();
      foreach ($contenedores as $contenedor) {
        $contenedorModel->create($contenedor);
      }
    }

    if ($operacion->getTipoMercancia() === 'CARGA_SUELTA') {
      if (
        empty($data['descripcion']) ||
        empty($data['cantidad'])
      ) {
        return [
          'status' => 400,
          'data' => [
            'message' => 'No se registraron todos los campos para generar una operación.'
          ]
        ];
      }

      $cargaSuelta = new CargaSuelta(
        $operacionId,
        $data['descripcion'],
        $data['cantidad']
      );

      $cargaSueltaModel = new ModelsCargaSuelta();
      $cargaSueltaModel->create($cargaSuelta);
    }

    return [
      'status' => 201,
      'data' => [
        'message' => 'Operación creada con éxito.'
      ]
    ];
  }
}
