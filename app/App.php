<?php

namespace App;

use App\Http\Controllers\CargaSueltaController;
use App\Http\Controllers\ContenedorController;
use App\Http\Controllers\ExportacionController;
use App\Http\Controllers\ImportacionController;
use App\Http\Controllers\OperacionController;

class App
{
  private $id;
  private $httpMethod;
  private $controller;

  function __construct($httpMethod, $id)
  {
    $this->id = $id;
    $this->httpMethod = $httpMethod;
  }

  public function request($path)
  {
    switch ($path) {
      case 'operaciones':
        return $this->operacionHandler();
        break;

      case 'importaciones':
        return $this->importacionHandler();
        break;

      case 'exportaciones':
        return $this->exportacionHandler();
        break;

      case 'contenedores':
        return $this->contenedorHandler();
        break;

      case 'carga-suelta':
        return $this->cargaSueltaHandler();
        break;

      default:
        // Todo: algo
        break;
    }
  }

  private function operacionHandler()
  {
    $this->controller = new OperacionController();
    switch ($this->httpMethod) {
      case 'GET':
        return $this->controller->index();
        break;

      case 'POST':
        return $this->controller->store();
        break;

      case 'PUT':
        # code...
        break;

      case 'DELETE':
        # code...
        break;

      default:
        # code...
        break;
    }
  }

  private function importacionHandler()
  {
    $this->controller = new ImportacionController();
    switch ($this->httpMethod) {
      case 'GET':
        return $this->controller->index();
        break;

      case 'POST':
        return $this->controller->store();
        break;

      case 'PUT':
        # code...
        break;

      case 'DELETE':
        # code...
        break;

      default:
        # code...
        break;
    }
  }

  private function exportacionHandler()
  {
    $this->controller = new ExportacionController();
    switch ($this->httpMethod) {
      case 'GET':
        return $this->controller->index();
        break;

      case 'POST':
        return $this->controller->store();
        break;

      case 'PUT':
        # code...
        break;

      case 'DELETE':
        # code...
        break;

      default:
        # code...
        break;
    }
  }

  private function contenedorHandler()
  {
    $this->controller = new ContenedorController();
    switch ($this->httpMethod) {
      case 'GET':
        return $this->controller->show($this->id);
        break;

      case 'DELETE':
        return $this->controller->destroy($this->id);
        break;

      default:
        # code...
        break;
    }
  }

  private function cargaSueltaHandler()
  {
    $this->controller = new CargaSueltaController();
    switch ($this->httpMethod) {
      case 'GET':
        return $this->controller->show($this->id);
        break;

      case 'PUT':
        return $this->controller->update($this->id);
        break;

      default:
        # code...
        break;
    }
  }
}
