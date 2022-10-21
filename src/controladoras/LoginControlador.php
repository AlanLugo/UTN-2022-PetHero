<?php
namespace controladoras;
/**
* 
*/
class LoginControlador
{
	private $CuentaDAO;
	private $GuardianDAO;
	private $DueñoDAO;

	function __construct()
	{
		# code...
		$this->CuentaDAO = \daos\Cuenta\CuentaMysqlDAO::getInstance();
		$this->GuardianDAO = \daos\Guardian\GuardianMysqlDAO::getInstance();
		$this->DueñoDAO = \daos\Dueño\DueñoMysqlDAO::getInstance();
	}

	public function ingresar($usuario, $contraseña)
	{
		$Mensaje = new \modelos\Auxiliar\MensajeAlerta();
		try {
			$Cuenta = new \modelos\Usuario\Cuenta('',$usuario,$contraseña);

			if(empty($Cuenta->getUsuario()) || empty($Cuenta->getPassword()))
			{
				throw new \Exception ('Campos vacios.');
			}

			$Cuenta = $this->CuentaDAO->ingresar($Cuenta);			
			if(empty($Cuenta))
			{
				throw new \Exception ('Usuario y/o Contraseña incorrectos.');
			}	
			else
			{	
				if(strcmp($Cuenta->getRol(), "Guardian")==0)
				{
					$Guardian = $this->GuardianDAO->getGuardian_byID_Cuenta($Cuenta);
					$_SESSION['Guardian'] = serialize($Guardian);
				}
				else if(strcmp($Dueño->getRol(), "Dueño")==0)
				{
					$Dueño = $this->DueñoDAO->getDueño_byID_Cuenta($Cuenta);
					$_SESSION['Dueño'] = serialize($Dueño);
				}
				
				$_SESSION['Logueado'] = 1;
				?><script type="text/javascript">				
				Procesar('contenido','procesarindex/inicio',[]);
				</script><?php
			}	
			
		} catch (\Exception $e) {

			$Mensaje->set_tipo('danger');
			$Mensaje->set_texto($e->getMessage());
			$Mensaje->imprimir();
		}
		

	}

	/*
	===============================================================================
				Funcion listar_sucursales trae todos las sucursales
				en un array de objetos tipo Sucursal y las muestra en una vista.
	===============================================================================
*/	
	public function lista_clientes()
	{	
		try 
		{
			return $this->ClienteDAO->listar();		
				
		} catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
  			$Mensaje_Alerta->imprimir();  			
		}	

		
	}
/*
	===============================================================================
				Funcion listar_sucursales trae todos las sucursales
				en un array de objetos tipo Sucursal y las muestra en una vista.
	===============================================================================
*/	
	public function leer_x_apellido_nombre($obj)
	{	
		try 
		{
			return $this->ClienteDAO->leer_x_apellido_nombre($obj);		
				
		} catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
  			$Mensaje_Alerta->imprimir();  			
		}	

		
	}		
}


