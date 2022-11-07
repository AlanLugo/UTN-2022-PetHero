<?php
namespace modelos\Auxiliar;
class MensajeAlerta 
{ 
	protected $tipo;
	protected $texto;
	

	public function __construct($tipo = '', $texto = '')
	{
		$this->set_tipo($tipo);
		$this->set_texto($texto);

	}	

	public function get_tipo()
	{
		return $this->tipo;
	}
	public function get_texto()
	{
		return $this->texto;
	}
	
	public function set_tipo($tipo = '')
	{
	$this->tipo = $tipo;
	}
	public function set_texto($texto = '')
	{
	$this->texto = $texto;
	}

	public function imprimir()
	{
		
		echo '<div class="alert alert-';
		echo $this->get_tipo();
		echo '">';
  		echo $this->get_texto();
		echo '</div>';
		
	}
	

}
?> 
