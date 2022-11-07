<?php
namespace controladoras;
/**
 * 
 */
class GuardianControlador
{
    private $GuardianDAO;

    function __construct()
    {
        $this->GuardianDAO = \daos\Guardian\GuardianMysqlDAO::getInstance();
    }

/*
	===============================================================================
				Funcion index se encarga de mostrar la vista principal de la
				controladora.
	===============================================================================
*/
    public function index()
    {
        $this->listar_guaradian();
    }

/*
	===============================================================================
				Funcion listar_guaradian trae todos los guardianes
				en un array de objetos tipo guardian y las muestra en una vista.
	===============================================================================
*/
    public function listar_guaradian()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Guardianes = $this->GuardianDAO->listar();
            include("../vistas/Guardian/guardian.php");
        
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
    public function modal_guardian_crear()
	{		
		
			include("../vistas/Guardian/Modal/guardian_crear.php");	
		
	}



/*
	===============================================================================
				Funcion alta_mascota se encarga de dar de alta una mascota en
				el sistema.
	===============================================================================
    $id_guardian;
    protected $nombre;
    protected $direccion;
    protected $cuil;
    protected $disponibilidad;
    protected $precio;
    protected $tamaño_maximo;
    protected $raza_dia;
    protected $id_cuenta;
    
*/	
	public function alta_guardian($nombre, $direccion, $cuil, $disponibilidad, $precio,$tamaño_maximo,$raza_dia)
	{		
		
		try
		{
				$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();			
				$Nuevo_Guardian = new \modelos\Usuarios\Guardian('',$nombre, $direccion, $cuil, $disponibilidad, $precio,$tamaño_maximo,$raza_dia,'');
				if(empty($Nuevo_Guardian->getNombre()) Or empty($Nuevo_Guardian->getCuil()))
				{
					throw new \Exception("Campo/s vacio/s.");
					exit();		
				}
				$Nuevo_Guardian = $this->GuardianDAO->crear($Nuevo_Guardian);
				if($Nuevo_Guardian!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Guardian creado correctamente..');
						$Mensaje_Alerta->imprimir();
                        
					$JS_EN_PHP->ejecutar('Procesar("tabla_guardian","Guardian/listar_guardian",[]);');
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
		Funcion que se encarga retornar un arreglo con objetos de mascota		
	===============================================================================
*/	
public function lista_guardianes()
{	
	try 
	{
		return $this->GuardianDAO->listar();		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}

/*
	===============================================================================
		Funcion que se encarga retornar un objeto de mascota, buscado por id		
	===============================================================================
*/	
public function leer_guardian($guardian)
{	
	try 
	{
		return $this->GuardianDAO->leer($guardian);		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

}

} 