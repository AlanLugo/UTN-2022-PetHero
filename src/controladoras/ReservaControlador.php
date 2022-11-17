<?php
namespace controladoras;
/**
 * 
 */
class ReservaControlador
{
    private $ReservaDAO;

    function __construct()
    {
        $this->ReservaDAO = \daos\Reserva\ReservaMysqlDAO::getInstance();
		$this->DisponibilidadDAO = \daos\Disponibilidad\DisponibilidadMysqlDAO::getInstance();
		$this->GuardianDAO = \daos\Guardian\GuardianMysqlDAO::getInstance();
		$this->MascotaDAO = \daos\Mascota\MascotaMysqlDAO::getInstance();
    }

/*
	===============================================================================
				Funcion index se encarga de mostrar la vista principal de la
				controladora.
	===============================================================================
*/
    public function index()
    {
        $this->listar_reservas();
    }

/*
	===============================================================================
				Funcion listar_reservas trae todos las Reserva
				en un array de objetos tipo reserva y las muestra en una vista.
	===============================================================================
*/
    public function listar_reservas()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Reserva = $this->ReservaDAO->listar();
            include("../vistas/Reserva/reserva.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }
	/*
	===============================================================================
				Funcion listar_reservas_x_guardian trae todos las Reserva
				en un array de objetos tipo reserva y las muestra en una vista.
	===============================================================================
	*/
    public function listar_reservas_x_guardian()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
			$Guardian = unserialize($_SESSION['Guardian']);
            $Reservas = $this->ReservaDAO->listar_x_guardian($Guardian);
            include("../vistas/Reserva/reserva_guardian.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }

	
/*
	===============================================================================
				Funcion modal_reserva_crear se encarga de mostrar el 
				include que contiene el alta.
	===============================================================================
*/	
    public function modal_reserva_crear($id)
	{		
			$Dueño = unserialize($_SESSION['Dueño']);
			$Disponibilidad_id = new \modelos\Disponibilidad\Disponibilidad($id);
			$Disponibilidad = $this->DisponibilidadDAO->buscar_x_id_disponibilidad($Disponibilidad_id);
			$Mascotas = $this->MascotaDAO->listar_x_dueño_tamaño_raza($Dueño->getId_Dueño(), $Disponibilidad->getId_Guardian()->get_tamaño_maximo(), $Disponibilidad->getId_Guardian()->get_raza_dia());
			include("../vistas/Reserva/Modal/reserva_crear.php");	
		
	}

/*
	===============================================================================
				Funcion modal_reserva_modificar se encarga de mostrar el 
				include que contiene la modificacion con sus respectivos campos.
	===============================================================================
*/	
	public function modal_reserva_modificar($id)
	{		
		try
		{
			$Reserva = new \modelos\Reserva\Reserva($id);
			$Reserva = $this->ReservaDAO->leer($Reserva);
			include("../vistas/Reserva/Modal/reserva_modificar.php");	
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
	}

/*
	===============================================================================
				Funcion que confirma la eliminacion de una reserva.		
	===============================================================================
*/

	public function eliminar_reserva_confirmacion($id)
	{
		try
		{
			$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
			$Reserva = new \modelos\Reserva\Reserva($id);
			include("../vistas/Reserva/Modal/reserva_eliminar_confirmacion.php");
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
	}

/*
	===============================================================================
				Funcion alta_reserva se encarga de dar de alta una reserva en
				el sistema.
	===============================================================================
	
*/	
	public function alta_reserva($fecha_inicio,$fecha_final,$estado,$id_mascota,$id_dueño,$id_guardian)
	{		
		
		try
		{
				$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();					
				$Dueño = unserialize($_SESSION['Dueño']);		
				$Nueva_reserva = new \modelos\Reserva\Reserva('',$fecha_inicio,$fecha_final,true,$Dueño);
				if(empty($Nueva_reserva->getFecha_Inicio()) Or empty($Nueva_reserva->getFecha_Final()))
				{
					throw new \Exception("Campo/s vacio/s.");
					exit();		
				}
				$Nueva_reserva = $this->ReservaDAO->crear($Nueva_reserva);
                if($Nueva_reserva!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','reserva creada correctamente..');
						$Mensaje_Alerta->imprimir();
					$JS_EN_PHP->ejecutar('Procesar("tabla_reserva","reserva/listar_reserva_guardian",['.$Dueño->getId_Dueño().']);');
				}
                
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
		finally {
    			
  				$JS_EN_PHP->limpiar('footer_reserva_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
  		}
				
		
	}
/*
	===============================================================================
				Funcion que modifica los datos desde el dao apartir de un objeto
				de reserva			
	===============================================================================
*/	
public function modificar_reserva($id_reserva,$fechaInicio,$fechaFinal,$estado,$id_mascota,$id_dueño,$id_guardian)
{
    try
    {
        $JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
		$Guardian = unserialize($_SESSION['Guardian']);
        $reserva = new \modelos\Reserva\Reserva($id_reserva,$fechaInicio,$fechaFinal,$estado,$id_mascota,$id_dueño,$id_guardian);			
		$reserva = $this->ReservaDAO->actualizar($reserva);	
		if($reserva!=NULL)
		{
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','reserva creada correctamente..');
			$Mensaje_Alerta->imprimir();
			$JS_EN_PHP->ejecutar('Procesar("tabla_reserva","reserva/listar_reserva_guardian",['.$Guardian->getId_Guardian().']);');
				
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
            
              $JS_EN_PHP->limpiar('footer_reserva_modificar','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
      }
}
/*
	===============================================================================
				Funcion que elimina los datos desde el daos apartir de un id		
	===============================================================================
*/	
public function eliminar_reserva($id)
{
	try
	{
		$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
		$Dueño = unserialize($_SESSION['Dueño']);
		$reserva = new \modelos\Reserva\Reserva($id);
		$reserva = $this->ReservaDAO->borrar($reserva);				
		if($reserva!=NULL)
		{
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','reserva creada correctamente..');
			$Mensaje_Alerta->imprimir();
			$JS_EN_PHP->ejecutar('Procesar("tabla_reserva","reserva/listar_reserva_Dueño",['.$Dueño->getId_Dueño().']);');
			
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
			
			  $JS_EN_PHP->limpiar('footer_reserva_confirmacion','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
	  }
}

/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de reserva		
	===============================================================================
*/	
public function lista_Reserva()
{	
	try 
	{
		return $this->ReservaDAO->listar();		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}
/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de reserva		
	===============================================================================
*/	
public function listar_reserva_Dueño($obj)
{	
	try 
	{
		$Dueño = new \modelos\Usuario\Dueño($obj);
		$Reserva = $this->ReservaDAO->listar_x_dueño($Dueño);
		include('../vistas/reserva/reserva.php');
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}


/*
	===============================================================================
		Funcion que se encarga retornar un objeto de reserva, buscado por id		
	===============================================================================
*/	
public function leer_reserva($reserva)
{	
	try 
	{
		return $this->ReservaDAO->leer($reserva);		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

}



} 