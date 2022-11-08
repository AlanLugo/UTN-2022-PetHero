<?php
namespace controladoras;
/**
 * 
 */
class CuentaControlador
{
    private $CuentaDAO;

    function __construct()
    {
        $this->CuentaDAO = \daos\Cuenta\CuentaMysqlDAO::getInstance();
    }

/*
	===============================================================================
				Funcion index se encarga de mostrar la vista principal de la
				controladora.
	===============================================================================
*/
    public function index()
    {
        $this->listar_cuentas();
    }

/*
	===============================================================================
				Funcion listar_guaradian trae todos los guardianes
				en un array de objetos tipo guardian y las muestra en una vista.
	===============================================================================
*/
    public function listar_cuentas()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Cuentas = $this->CuentaDAO->listar();
            include("../vistas/Cuenta/cuenta.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }
/*
	===============================================================================
				Funcion modal_mascota_crear se encarga de mostrar el 
				include que contiene el alta.
	===============================================================================
*/	
    public function modal_cuenta_crear()
	{		
		
			include("../vistas/Cuenta/Modal/cuenta_crear.php");	
		
	}



/*
	===============================================================================
				Funcion alta_mascota se encarga de dar de alta una mascota en
				el sistema.
	===============================================================================
    id_cuenta int(11) NOT NULL AUTO_INCREMENT,
	usuario varchar(50) DEFAULT NULL,
	password varchar(16) DEFAULT NULL,
    
*/	
	public function alta_cuenta($usuario, $password, $rol)
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
		Funcion que se encarga retornar un arreglo con objetos de mascota		
	===============================================================================
*/	
public function lista_cuentas()
{	
	try 
	{
		return $this->CuentaDAO->listar();		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}

/*
	===============================================================================
		Funcion que se encarga retornar un objeto de cuenta, buscado por id		
	===============================================================================
*/	
public function leer_cuenta($cuenta)
{	
	try 
	{
		return $this->CuentaDAO->leer($cuenta);		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

}

} 