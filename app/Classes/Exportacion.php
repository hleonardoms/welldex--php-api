<?php

namespace App\Classes;

use App\Classes\Operacion;

class Exportacion extends Operacion
{
  private $operacionId;
  private $fechaZarpe;
  private $paisDestino;

  public function __construct(
    int $operacionId,
    string $fechaZarpe,
    string $paisDestino
  ) {
    $this->operacionId = $operacionId;
    $this->fechaZarpe = $fechaZarpe;
    $this->paisDestino = $paisDestino;
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
   * Get the value of fechaZarpe
   */
  public function getFechaZarpe()
  {
    return $this->fechaZarpe;
  }

  /**
   * Set the value of fechaZarpe
   *
   * @return  self
   */
  public function setFechaZarpe($fechaZarpe)
  {
    $this->fechaZarpe = $fechaZarpe;

    return $this;
  }

  /**
   * Get the value of paisDestino
   */
  public function getPaisDestino()
  {
    return $this->paisDestino;
  }

  /**
   * Set the value of paisDestino
   *
   * @return  self
   */
  public function setPaisDestino($paisDestino)
  {
    $this->paisDestino = $paisDestino;

    return $this;
  }
}
