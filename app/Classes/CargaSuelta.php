<?php

namespace App\Classes;

class CargaSuelta
{
  private $operacionId;
  private $descripcion;
  private $cantidad;

  public function __construct(
    int $operacionId,
    string $descripcion,
    string $cantidad,
  ) {
    $this->operacionId = $operacionId;
    $this->descripcion = $descripcion;
    $this->cantidad = $cantidad;
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
   * Get the value of descripcion
   */
  public function getDescripcion()
  {
    return $this->descripcion;
  }

  /**
   * Set the value of descripcion
   *
   * @return  self
   */
  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;

    return $this;
  }

  /**
   * Get the value of cantidad
   */
  public function getCantidad()
  {
    return $this->cantidad;
  }

  /**
   * Set the value of cantidad
   *
   * @return  self
   */
  public function setCantidad($cantidad)
  {
    $this->cantidad = $cantidad;

    return $this;
  }
}
