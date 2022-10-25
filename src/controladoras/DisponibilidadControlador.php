<?php
namespace controladoras;
/**
 * 
 */
class DisponibilidadControlador
{
    private $DisponibilidadDAO;

    function __construct()
    {
        $this->DisponibilidadDAO = \daos\Disponibilidad\DisponibilidadMysqlDAO::getInstance();
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
	public function alta_disponibilidad($fechaInicio, $fechaFinal, $disponible)
	{		
		
		try
		{
				$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();			
				$Nueva_Disponibilidad = new \modelos\Disponibilidad\Disponibilidad('',$fechaInicio,$fechaFinal,$disponible);
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
					$JS_EN_PHP->ejecutar('Procesar("tabla_disponibilidad","disponibilidad/listar_disponibilidades",[]);');
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
        $Disponibilidad = new \modelos\Disponibilidad\Disponibilidad($id_disponibilidad,$fechaInicio,$fechaFinal,$disponible);			
        $Anterior_Disponibilidad = $this->MascotaDAO->leer($Disponibilidad);
        $Mascota = $this->MascotaDAO->actualizar($Disponibilidad);			
		if($Disponibilidad!=NULL)
		{
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Disponibilidad creada correctamente..');
			$Mensaje_Alerta->imprimir();
			$JS_EN_PHP->ejecutar('Procesar("tabla_disponibilidad","disponibilidad/listar_disponibilidades",[]);');
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
		$Disponibilidad = new \modelos\Disponibilidad\Disponibilidad($id);
		$Disponibilidad = $this->DisponibilidadDAO->borrar($Disponibilidad);				
		if($Disponibilidad!=NULL)
		{
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Disponibilidad creada correctamente..');
			$Mensaje_Alerta->imprimir();
			$JS_EN_PHP->ejecutar('Procesar("tabla_disponibilidad","disponibilidad/listar_disponibilidades",[]);');
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