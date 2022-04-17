<?php

namespace App\Http\Controllers;

use App\Models\Contenedor;
use App\Models\Operacion;

class ContenedorController
{
  private $contenedor;

  public function __construct()
  {
    $this->contenedor = new Contenedor();
  }

  public function show(int $id)
  {
    $data = $this->contenedor->get($id);
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

  public function destroy(int $id)
  {
    $contenedor = $this->contenedor->getContenedor($id);
    $contenedor = (array)$contenedor[0];
    $operacionId = $contenedor['id_operacion'];

    $data = $this->contenedor->remove($id);
    $data = $this->contenedor->get($operacionId);
    if ($data) {
      $contenedoresDescargados = 0;
      foreach ($data as $element) {
        $element = (array) $element;
        if (!empty($element['fecha_descargo'])) {
          $contenedoresDescargados++;
        }
      }
      if ($contenedoresDescargados === sizeof($data)) {
        $operacionModel = new Operacion();
        $operacionModel->updateEstatus($operacionId, 'DESCARGO');
      }
    }

    return [
      'status' => 200,
      'message' => 'OK',
      'data' => $data
    ];
  }
}
