<?php
namespace controladoras;
/**
* 
*/
class LoginControlador
{
	private $CuentaDAO;
	private $TipoMascotaDAO;
	private $TamañoMascotaDAO;
	private $GuardianDAO;
	private $DueñoDAO;

	function __construct()
	{
		# code...
		$this->CuentaDAO = \daos\Cuenta\CuentaMysqlDAO::getInstance();
		$this->TipoMascotaDAO = \daos\Mascota\TipoMascotaMysqlDAO::getInstance();
		$this->TamañoMascotaDAO = \daos\Mascota\TamañoMascotaMysqlDAO::getInstance();
		$this->GuardianDAO = \daos\Guardian\GuardianMysqlDAO::getInstance();
		$this->DueñoDAO = \daos\Dueño\DueñoMysqlDAO::getInstance();
	}

	public function index()
    {
        $this->listar_cuenta();
    }

/*
	===============================================================================
				Funcion listar_disponibilidades trae todos las disponibilidades
				en un array de objetos tipo Disponibilidad y las muestra en una vista.
	===============================================================================
*/
    public function listar_cuenta()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Disponibilidades = $this->CuentaDAO->listar();
            include("../vistas/Cuenta/Modal/cuenta_crear.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }

	public function listar_dueño()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Disponibilidades = $this->DueñoDAO->listar();
            include("../vistas/D/Modal/cuenta_crear.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }

	public function listar_guardian()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Disponibilidades = $this->GuardianDAO->listar();
            include("../vistas/Cuenta/Modal/cuenta_crear.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }

	public function modal_cuenta_crear()
	{		

			$Tipos_Mascota = $this->TipoMascotaDAO->listar();
			$Tamaños_Mascota = $this->TamañoMascotaDAO->listar();
			include("../vistas/Cuenta/Modal/cuenta_crear.php");	
		
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
	/*
	protected $id_dueño;
    protected $nombre;
    protected $dni;
    protected $direccion;
    protected $telefono;
    protected $id_cuenta;

	protected $id_guardian;
    protected $nombre;
    protected $direccion;
    protected $cuil;
    protected $disponibilidad;
    protected $precio;
    protected $tamaño_maximo;
    protected $raza_dia;
    protected $id_cuenta;
	*/
	public function registro
	($usuario, $password, $rol, 
	$nombre_dueño, $dni_dueño, $direccion_dueño, $telefono_dueño, 
	$nombre_guardian, $direccion_guardian, $cuil_guardian, $precio_guardian, $id_tipo_mascota, $id_tamaño_mascota)
	{		
		try
		{
			$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();	
			if(empty($rol))
			{
				throw new \Exception("No hay rol seleccionado.");
				exit();
			}
			else
			{
				if($rol == "Dueño")
				{
					if(empty($usuario) Or empty($password))
					{
						throw new \Exception("Campo/s vacio/s de cuenta.");
						exit();
					}
					else
					{
							$Nueva_Cuenta = new \modelos\Usuario\Cuenta('',$usuario, $password, $rol);
							$Nueva_Cuenta = $this->crear_registro_cuenta($usuario, $password, $rol);
							$Nueva_Dueño = $this->crear_registro_dueño($nombre_dueño, $dni_dueño, $direccion_dueño, $telefono_dueño, $Nueva_Cuenta);

							if($Nueva_Dueño!=NULL)
							{
								$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Cuenta creada correctamente..');
									$Mensaje_Alerta->imprimir();
									
								$JS_EN_PHP->ejecutar('Procesar("tabla_cuenta","login/listar_cuenta",[]);');
							}
					}
				}else if($rol == "Guardian")
				{
					if(empty($usuario) Or empty($password))
					{
						throw new \Exception("Campo/s vacio/s de cuenta.");
						exit();
					}
					else
					{
							$Nueva_Cuenta = new \modelos\Usuario\Cuenta('',$usuario, $password, $rol);
							$Nuevo_Tipo_Mascota = new \modelos\Mascota\Tipo_Mascota($id_tipo_mascota,'');
							$Nuevo_Tamaño_Mascota = new \modelos\Mascota\Tamaño_Mascota($id_tamaño_mascota,'');
							$Nueva_Cuenta = $this->crear_registro_cuenta($usuario, $password, $rol);
							$Nuevo_Guardian =$this->crear_registro_guardian($nombre_guardian, $direccion_guardian, $cuil_guardian, true, $precio_guardian, $Nuevo_Tipo_Mascota, $Nuevo_Tamaño_Mascota, $Nueva_Cuenta);

							if($Nuevo_Guardian!=NULL)
							{
								$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Cuenta creada correctamente..');
									$Mensaje_Alerta->imprimir();
									
								$JS_EN_PHP->ejecutar('Procesar("tabla_cuenta","login/listar_cuenta",[]);');
							}
					}
				}
			}
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
		finally {
    			
  				$JS_EN_PHP->limpiar('footer_guardian_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
  		}
	}

/*
	===============================================================================
				Funcion listar_ trae todos las 
				en un array de objetos tipo  y las muestra en una vista.
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

	public function crear_registro_cuenta($usuario, $password, $rol)
	{
		try
		{
			$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
			$Nueva_Cuenta = new \modelos\Usuario\Cuenta('',$usuario, $password, $rol);
			if(empty($usuario) Or empty($password) Or empty($rol))
			{
					throw new \Exception("Campo/s vacio/s.");
					exit();
			}
			$Nueva_Cuenta = $this->CuentaDAO->crear($Nueva_Cuenta);
					
			return $Nueva_Cuenta;
		}catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
			$Mensaje_Alerta->imprimir();
		}
		finally {
			
			  $JS_EN_PHP->limpiar('footer_cuenta_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
	  	}
	}

	public function crear_registro_dueño($nombre_dueño, $dni_dueño, $direccion_dueño, $telefono_dueño, $id_cuenta)
	{
		try
		{
		$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
		$Nuevo_Dueño = new \modelos\Usuario\Dueño('',$nombre_dueño, $dni_dueño, $direccion_dueño, $telefono_dueño, $id_cuenta);
		if(empty($nombre_dueño) Or empty($dni_dueño) Or empty($direccion_dueño) Or empty($telefono_dueño))
			{
				throw new \Exception("Campo/s vacio/s.");
				exit();
			}
		$Nuevo_Dueño = $this->DueñoDAO->crear($Nuevo_Dueño);
				if($Nuevo_Dueño!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Dueño creado correctamente..');
					$Mensaje_Alerta->imprimir();
                        
					$JS_EN_PHP->ejecutar('Procesar("tabla_dueño","login/listar_dueño",[]);');
				}
		}catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
			$Mensaje_Alerta->imprimir();
		}
		finally {
			
			  $JS_EN_PHP->limpiar('footer_dueño_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
	  	}
	}

	public function crear_registro_guardian($nombre_guardian, $direccion_guardian, $cuil_guardian, $disponibilidad_guardian, $precio_guardian, $id_tipo_mascota, $id_tamaño_mascota, $id_cuenta)
	{
		try
		{
		$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
		
		$Nuevo_Guardian = new \modelos\Usuario\Guardian
		('',$nombre_guardian, $direccion_guardian, $cuil_guardian, $disponibilidad_guardian, $precio_guardian, $id_tipo_mascota, $id_tamaño_mascota, $id_cuenta);
		if(empty($nombre_guardian) Or empty($direccion_guardian) Or empty($cuil_guardian) Or empty($disponibilidad_guardian) Or empty($precio_guardian) Or empty($id_tipo_mascota) Or empty($id_tamaño_mascota))
			{
				throw new \Exception("Campo/s vacio/s.");
				exit();
			}
		$Nuevo_Guardian = $this->GuardianDAO->crear($Nuevo_Guardian);
				if($Nuevo_Guardian!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Guardian creado correctamente..');
					$Mensaje_Alerta->imprimir();
                        
					$JS_EN_PHP->ejecutar('Procesar("tabla_guardian","login/listar_guardian",[]);');
				}
		}catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
			$Mensaje_Alerta->imprimir();
		}
		finally {
			
			  $JS_EN_PHP->limpiar('footer_guardian_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
	  	}
	}
}


