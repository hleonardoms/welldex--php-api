<?php

namespace App\Classes;

use App\Classes\Operacion;

class Importacion extends Operacion
{
  private $operacionId;
  private $fechaArribo;
  private $paisOrigen;

  public function __construct(
    int $operacionId,
    string $fechaArribo,
    string $paisOrigen
  ) {
    $this->operacionId = $operacionId;
    $this->fechaArribo = $fechaArribo;
    $this->paisOrigen = $paisOrigen;
  }

  /**
   * Get the value of operacionId
   */
  public function getOperacionId()
  {
    return $this->operacionId;
  }

  /**
   * Set the value of operacionId
   *
   * @return  self
   */
  public function setOperacionId($operacionId)
  {
    $this->operacionId = $operacionId;

    return $this;
  }
  /**
   * Get the value of fechaArribo
   */
  public function getFechaArribo()
  {
    return $this->fechaArribo;
  }

  /**
   * Set the value of fechaArribo
   *
   * @return  self
   */
  public function setFechaArribo($fechaArribo)
  {
    $this->fechaArribo = $fechaArribo;

    return $this;
  }

  /**
   * Get the value of paisOrigen
   */
  public function getPaisOrigen()
  {
    return $this->paisOrigen;
  }

  /**
   * Set the value of paisOrigen
   *
   * @return  self
   */
  public function setPaisOrigen($paisOrigen)
  {
    $this->paisOrigen = $paisOrigen;

    return $this;
  }
}
