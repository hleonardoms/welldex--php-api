<?php

namespace App\Classes;

class Operacion
{
  private $referencia;
  private $pedimento;
  private $cliente;
  private $aduana;
  private $patente;
  private $tipoMercancia;
  private $tipoOperacion;
  private $estatus;
  private $createdAt;
  private $updatedAt;
  private $deletedAt;


  public function __construct(
    string $referencia,
    string $pedimento,
    string $cliente,
    string $aduana,
    string $patente,
    string $tipoMercancia,
    string $tipoOperacion,
    string $estatus,
    string $createdAt,
  ) {
    $this->referencia = $referencia;
    $this->pedimento = $pedimento;
    $this->cliente = $cliente;
    $this->aduana = $aduana;
    $this->patente = $patente;
    $this->tipoMercancia = $tipoMercancia;
    $this->tipoOperacion = $tipoOperacion;
    $this->estatus = $estatus;
    $this->createdAt = $createdAt;
  }


  /**
   * Get the value of referencia
   */
  public function getReferencia()
  {
    return $this->referencia;
  }

  /**
   * Set the value of referencia
   *
   * @return  self
   */
  public function setReferencia($referencia)
  {
    $this->referencia = $referencia;

    return $this;
  }

  /**
   * Get the value of pedimento
   */
  public function getPedimento()
  {
    return $this->pedimento;
  }

  /**
   * Set the value of pedimento
   *
   * @return  self
   */
  public function setPedimento($pedimento)
  {
    $this->pedimento = $pedimento;

    return $this;
  }

  /**
   * Get the value of cliente
   */
  public function getCliente()
  {
    return $this->cliente;
  }

  /**
   * Set the value of cliente
   *
   * @return  self
   */
  public function setCliente($cliente)
  {
    $this->cliente = $cliente;

    return $this;
  }

  /**
   * Get the value of aduana
   */
  public function getAduana()
  {
    return $this->aduana;
  }

  /**
   * Set the value of aduana
   *
   * @return  self
   */
  public function setAduana($aduana)
  {
    $this->aduana = $aduana;

    return $this;
  }

  /**
   * Get the value of patente
   */
  public function getPatente()
  {
    return $this->patente;
  }

  /**
   * Set the value of patente
   *
   * @return  self
   */
  public function setPatente($patente)
  {
    $this->patente = $patente;

    return $this;
  }

  /**
   * Get the value of tipoMercancia
   */
  public function getTipoMercancia()
  {
    return $this->tipoMercancia;
  }

  /**
   * Set the value of tipoMercancia
   *
   * @return  self
   */
  public function setTipoMercancia($tipoMercancia)
  {
    $this->tipoMercancia = $tipoMercancia;

    return $this;
  }

  /**
   * Get the value of tipoOperacion
   */
  public function getTipoOperacion()
  {
    return $this->tipoOperacion;
  }

  /**
   * Set the value of tipoOperacion
   *
   * @return  self
   */
  public function setTipoOperacion($tipoOperacion)
  {
    $this->tipoOperacion = $tipoOperacion;

    return $this;
  }

  /**
   * Get the value of estatus
   */
  public function getEstatus()
  {
    return $this->estatus;
  }

  /**
   * Set the value of estatus
   *
   * @return  self
   */
  public function setEstatus($estatus)
  {
    $this->estatus = $estatus;

    return $this;
  }

  /**
   * Get the value of createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set the value of createdAt
   *
   * @return  self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  /**
   * Get the value of updatedAt
   */
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * Set the value of updatedAt
   *
   * @return  self
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  /**
   * Get the value of deletedAt
   */
  public function getDeletedAt()
  {
    return $this->deletedAt;
  }

  /**
   * Set the value of deletedAt
   *
   * @return  self
   */
  public function setDeletedAt($deletedAt)
  {
    $this->deletedAt = $deletedAt;

    return $this;
  }
}
