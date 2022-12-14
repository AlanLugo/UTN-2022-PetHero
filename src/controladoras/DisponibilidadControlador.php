<?php
namespace controladoras;
/**
 * 
 */
class DisponibilidadControlador
{
    private $DisponibilidadDAO;
	private $TipoMascotaDAO;
	private $TamañoMascotaDAO;

    function __construct()
    {
        $this->DisponibilidadDAO = \daos\Disponibilidad\DisponibilidadMysqlDAO::getInstance();
		$this->TipoMascotaDAO = \daos\Mascota\TipoMascotaMysqlDAO::getInstance();
		$this->TamañoMascotaDA0 = \daos\Mascota\TamañoMascotaMysqlDAO::getInstance();
    }

/*
	===============================================================================
				Funcion index se encarga de mostrar la vista principal de la
				controladora.
	===============================================================================
*/
    public function index()
    {
        $this->listar_disponibilidades();
    }

/*
	===============================================================================
				Funcion listar_disponibilidades trae todos las disponibilidades
				en un array de objetos tipo Disponibilidad y las muestra en una vista.
	===============================================================================
*/
    public function listar_disponibilidades()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Disponibilidades = $this->DisponibilidadDAO->listar();
            include("../vistas/Disponibilidad/disponibilidad.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }
/*
	===============================================================================
				Funcion modal_disponibilidad_crear se encarga de mostrar el 
				include que contiene el alta.
	===============================================================================
*/	
    public function modal_disponibilidad_crear()
	{		
		
			include("../vistas/Disponibilidad/Modal/disponibilidad_crear.php");	
		
	}

/*
	===============================================================================
				Funcion modal_disponibilidad_modificar se encarga de mostrar el 
				include que contiene la modificacion con sus respectivos campos.
	===============================================================================
*/	
	public function modal_disponibilidad_modificar($id)
	{		
		try
		{
			$Disponibilidad = new \modelos\Disponibilidad\Disponibilidad($id);
			$Disponibilidad = $this->DisponibilidadDAO->leer($Disponibilidad);
			include("../vistas/Disponibilidad/Modal/disponibilidad_modificar.php");	
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
	}

/*
	===============================================================================
				Funcion que confirma la eliminacion de una disponibilidad.		
	===============================================================================
*/

	public function eliminar_disponibilidad_confirmacion($id)
	{
		try
		{
			$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
			$Disponibilidad = new \modelos\Disponibilidad\Disponibilidad($id);
			include("../vistas/Disponibilidad/Modal/disponibilidad_eliminar_confirmacion.php");
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
	}

/*
	===============================================================================
				Funcion alta_disponibilidad se encarga de dar de alta una disponibilidad en
				el sistema.
	===============================================================================
	
*/	
	public function alta_disponibilidad($fechaInicio, $fechaFinal)
	{		
		
		try
		{
				$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();					
				$Guardian = unserialize($_SESSION['Guardian']);		
				$Nueva_Disponibilidad = new \modelos\Disponibilidad\Disponibilidad('',$fechaInicio,$fechaFinal,true,$Guardian);
				if(empty($Nueva_Disponibilidad->getFechaInicio()) Or empty($Nueva_Disponibilidad->getFechaFinal()))
				{
					throw new \Exception("Campo/s vacio/s.");
					exit();		
				}
				$Nueva_Disponibilidad = $this->DisponibilidadDAO->crear($Nueva_Disponibilidad);
                if($Nueva_Disponibilidad!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Disponibilidad creada correctamente..');
						$Mensaje_Alerta->imprimir();
					$JS_EN_PHP->ejecutar('Procesar("tabla_disponibilidad","disponibilidad/listar_disponibilidad_guardian",['.$Guardian->getId_Guardian().']);');
				}
                
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
		finally {
    			
  				$JS_EN_PHP->limpiar('footer_disponibilidad_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
  		}
				
		
	}
/*
	===============================================================================
				Funcion que modifica los datos desde el dao apartir de un objeto
				de disponibilidad			
	===============================================================================
*/	
public function modificar_disponibilidad($id_disponibilidad,$fechaInicio,$fechaFinal,$disponible)
{
    try
    {
        $JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
		$Guardian = unserialize($_SESSION['Guardian']);
        $Disponibilidad = new \modelos\Disponibilidad\Disponibilidad($id_disponibilidad,$fechaInicio,$fechaFinal,$disponible,$Guardian);			
		$Disponibilidad = $this->DisponibilidadDAO->actualizar($Disponibilidad);	
		if($Disponibilidad!=NULL)
		{
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Disponibilidad creada correctamente..');
			$Mensaje_Alerta->imprimir();
			$JS_EN_PHP->ejecutar('Procesar("tabla_disponibilidad","disponibilidad/listar_disponibilidad_guardian",['.$Guardian->getId_Guardian().']);');
				
		}
		else
		{
			throw new \Exception("Error al modificar el articulo");		
		}
    } catch (\Exception $e) {
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
              $Mensaje_Alerta->imprimir();
    }
    finally {
            
              $JS_EN_PHP->limpiar('footer_disponibilidad_modificar','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
      }
}
/*
	===============================================================================
				Funcion que elimina los datos desde el daos apartir de un id		
	===============================================================================
*/	
public function eliminar_disponibilidad($id)
{
	try
	{
		$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
		$Guardian = unserialize($_SESSION['Guardian']);
		$Disponibilidad = new \modelos\Disponibilidad\Disponibilidad($id);
		$Disponibilidad = $this->DisponibilidadDAO->borrar($Disponibilidad);				
		if($Disponibilidad!=NULL)
		{
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Disponibilidad creada correctamente..');
			$Mensaje_Alerta->imprimir();
			$JS_EN_PHP->ejecutar('Procesar("tabla_disponibilidad","disponibilidad/listar_disponibilidad_guardian",['.$Guardian->getId_Guardian().']);');
			
		}
		else
		{
			throw new \Exception("Error al modificar el articulo");
				
		}
	} catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
			  $Mensaje_Alerta->imprimir();
	}
	finally {
			
			  $JS_EN_PHP->limpiar('footer_disponibilidad_confirmacion','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
	  }
}

/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de disponibilidad		
	===============================================================================
*/	
public function lista_disponibilidades()
{	
	try 
	{
		return $this->DisponibilidadDAO->listar();		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}

/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de disponibilidad		
	===============================================================================
*/	
public function listar_disponibilidad_guardian_raza_tamanio($id_tipo_mascota, $id_tamaño_mascota)
{	
	try 
	{	
		$Seleccion_Tipo_Mascota = new \modelos\Mascota\Tipo_Mascota($id_tipo_mascota,'');
		$Seleccion_Tamaño_Mascota = new \modelos\Mascota\Tamaño_Mascota($id_tamaño_mascota,'');
		$Guardian = new \modelos\Usuario\Guardian('','','','','','',$Seleccion_Tipo_Mascota,$Seleccion_Tamaño_Mascota);
		$Disponibilidades = $this->DisponibilidadDAO->listar_disponibilidad_guardian_raza_tamanio($Guardian);
		include('../vistas/Reserva/disponibilidad_reserva.php');		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}
/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de disponibilidad		
	===============================================================================
*/	
public function listar_disponibilidad_guardian($id)
{	
	try 
	{
		$Guardian = new \modelos\Usuario\Guardian($id);
		$Disponibilidades = $this->DisponibilidadDAO->listar_x_guardian($Guardian);
		include('../vistas/Disponibilidad/disponibilidad.php');
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}

/*
	===============================================================================
		Funcion que se encarga retornar un objeto de disponibilidad, buscado por id		
	===============================================================================
*/	
public function leer_disponibilidad($disponibilidad)
{	
	try 
	{
		return $this->DisponibilidadDAO->leer($disponibilidad);		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

}

} 