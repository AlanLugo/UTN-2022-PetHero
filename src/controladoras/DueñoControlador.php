<?php
namespace controladoras;
/**
 * 
 */
class DueñoControlador
{
    private $DueñoDAO;

    function __construct()
    {
        $this->DueñoDAO = \daos\Dueño\DueñoMysqlDAO::getInstance();
    }

/*
	===============================================================================
				Funcion index se encarga de mostrar la vista principal de la
				controladora.
	===============================================================================
*/
    public function index()
    {
        $this->listar_guardian();
    }

/*
	===============================================================================
				Funcion listar_guardian trae todos los guardianes
				en un array de objetos tipo guardian y las muestra en una vista.
	===============================================================================
*/
    public function listar_guardian()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Dueños = $this->DueñoDAO->listar();
            include("../vistas/Guardian/guardian.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }
/*
	===============================================================================
				Funcion modal_dueño_crear se encarga de mostrar el 
				include que contiene el alta.
	===============================================================================
*/	
    public function modal_dueño_crear()
	{		
		
			include("../vistas/Dueño/Modal/dueño_crear.php");	
		
	}


/*
	===============================================================================
				Funcion alta_dueño se encarga de dar de alta una dueño en
				el sistema.
	===============================================================================
    protected $id_dueño;
    protected $nombre;
    protected $dni;
    protected $direccion;
    protected $telefono;
    protected $id_cuenta;
    
*/	
	public function alta_dueño($nombre, $dni, $direccion, $telefono)
	{		
		
		try
		{
				$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();			
				$nuevo_dueño = new \modelos\Usuarios\Dueño('',$nombre, $dni, $direccion, $telefono,'');
				if(empty($nuevo_dueño->getNombre()) Or empty($nuevo_dueño->getDni()))
				{
					throw new \Exception("Campo/s vacio/s.");
					exit();		
				}
				$nuevo_dueño = $this->DueñoDAO->crear($nuevo_dueño);
				if($nuevo_dueño!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Dueño creado correctamente..');
						$Mensaje_Alerta->imprimir();
					$JS_EN_PHP->ejecutar('Procesar("tabla_dueño","dueño/listar_dueño",[]);');
				}
			
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
		finally {
  				$JS_EN_PHP->limpiar('footer_dueño_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
  		}
				
		
	}
/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de dueño		
	===============================================================================
*/	
public function lista_dueños()
{	
	try 
	{
		return $this->DueñoDAO->listar();		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}

/*
	===============================================================================
		Funcion que se encarga retornar un objeto de dueño, buscado por id		
	===============================================================================
*/	
public function leer_dueño($dueño)
{	
	try 
	{
		return $this->DueñoDAO->leer($dueño);		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

}

} 