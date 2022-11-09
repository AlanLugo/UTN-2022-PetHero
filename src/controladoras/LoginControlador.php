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
				$_SESSION['Cuenta'] = serialize($Cuenta);
				if(strcmp($Cuenta->getRol(), "Guardian")==0)
				{
					$Guardian = $this->GuardianDAO->getGuardian_byID_Cuenta($Cuenta);
					$_SESSION['Guardian'] = serialize($Guardian);					
				}
				else if(strcmp($Cuenta->getRol(), "Dueño")==0)
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

	public function registro($usuario, $password, $rol)
	{		
		
		try
		{
				$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();			
				$Nueva_Cuenta = new \modelos\Usuario\Cuenta('',$usuario, $password, $rol);
				if(empty($Nueva_Cuenta->getUsuario()) Or empty($Nueva_Cuenta->getPassword()) Or empty($Nueva_Cuenta->getRol()))
				{
					throw new \Exception("Campo/s vacio/s.");
					exit();		
				}
				$Nueva_Cuenta = $this->CuentaDAO->crear($Nueva_Cuenta);
				if($Nueva_Cuenta!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Cuenta creada correctamente..');
						$Mensaje_Alerta->imprimir();
                        
					$JS_EN_PHP->ejecutar('Procesar("tabla_cuenta","cuenta/listar_cuenta",[]);');
				}
			
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
		finally {
    			
  				$JS_EN_PHP->limpiar('footer_cuenta_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
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


