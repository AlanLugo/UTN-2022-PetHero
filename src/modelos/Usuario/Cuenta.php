<?php
namespace modelos\Usuario;
class Cuenta
{
	protected $id_cuenta;
	protected $usuario;
	protected $password;
	protected $rol;

	public function __construct($id_cuenta = '', $usuario = '', $password = '', $rol = '')
	{

		$this->setId_Cuenta($id_cuenta);
		$this->setUsuario($usuario);
		$this->setPassword($password);
		$this->setRol($rol);
	
	}

	public function getId_Cuenta()
	{
		return $this->id_cuenta;
	}

	public function getUsuario()
	{
		return $this->usuario;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getRol()
	{
		return $this->rol;
	}
	

	public function setId_Cuenta($id_cuenta)
	{
		$this->id_cuenta = $id_cuenta;
	}

	public function setUsuario($usuario)
	{
		$this->usuario = $usuario;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function setRol($rol)
	{
		$this->rol = $rol;
	}
	
} 
