<?php
namespace modelos\Auxiliar;
class TiempoRespuesta
{
	protected $inicio;
	protected $fin;
	public function __construct()
	{
		$this->setInicio(microtime(true));		
	}

	public function getInicio()
	{
		return $this->inicio;
	}
	
	public function setInicio($inicio)
	{
		$this->inicio = $inicio;
	}

	public function getFin()
	{
		return $this->fin;
	}
	
	public function setFin($fin)
	{
		$this->fin = $fin;
	}

	public function imprimir()
	{
		$this->setFin(microtime(true));
		$tiempo_consulta = substr(($this->getFin() - $this->getInicio()),0,5);
		$retorno = "Tiempo de respuesta: " . $tiempo_consulta ." segundos.";
		return $retorno;
	}

	
} 
