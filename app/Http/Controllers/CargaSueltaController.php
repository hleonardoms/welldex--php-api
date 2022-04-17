<?php

namespace App\Http\Controllers;

use App\Models\CargaSuelta;
use App\Models\Operacion;

class CargaSueltaController
{
  private $cargaSuelta;

  public function __construct()
  {
    $this->cargaSuelta = new CargaSuelta();
  }

  public function show(int $id)
  {
    $data = $this->cargaSuelta->get($id);
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
        'data' => $data[0]
      ];
    }
  }

  public function update(int $id)
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

    $this->cargaSuelta->update($id, $data['cantidad']);

    if ($data['cantidad'] === 0) {
      $operacionModel = new Operacion();
      $operacionModel->updateEstatus($data['id_operacion'], 'DESCARGO');
    }

    return [
      'status' => 200,
      'message' => 'OK',
      'data' => $data[0]
    ];
  }
}
