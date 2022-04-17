<?php

namespace App\Classes;

class Contenedor
{
  private $operacionId;
  private $numeroContenedor;
  private $tipoContenedor;
  private $dimensiones;
  private $fechaDescargo;

  public function __construct(
    int $operacionId,
    string $numeroContenedor,
    string $tipoContenedor,
    string $dimensiones,
  ) {
    $this->operacionId = $operacionId;
    $this->numeroContenedor = $numeroContenedor;
    $this->tipoContenedor = $tipoContenedor;
    $this->dimensiones = $dimensiones;
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
   * Get the value of numeroContenedor
   */
  public function getNumeroContenedor()
  {
    return $this->numeroContenedor;
  }

  /**
   * Set the value of numeroContenedor
   *
   * @return  self
   */
  public function setNumeroContenedor($numeroContenedor)
  {
    $this->numeroContenedor = $numeroContenedor;

    return $this;
  }

  /**
   * Get the value of tipoContenedor
   */
  public function getTipoContenedor()
  {
    return $this->tipoContenedor;
  }

  /**
   * Set the value of tipoContenedor
   *
   * @return  self
   */
  public function setTipoContenedor($tipoContenedor)
  {
    $this->tipoContenedor = $tipoContenedor;

    return $this;
  }

  /**
   * Get the value of dimensiones
   */
  public function getDimensiones()
  {
    return $this->dimensiones;
  }

  /**
   * Set the value of dimensiones
   *
   * @return  self
   */
  public function setDimensiones($dimensiones)
  {
    $this->dimensiones = $dimensiones;

    return $this;
  }

  /**
   * Get the value of fechaDescargo
   */
  public function getFechaDescargo()
  {
    return $this->fechaDescargo;
  }

  /**
   * Set the value of fechaDescargo
   *
   * @return  self
   */
  public function setFechaDescargo($fechaDescargo)
  {
    $this->fechaDescargo = $fechaDescargo;

    return $this;
  }
}
