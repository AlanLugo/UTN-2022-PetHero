<?php
namespace controladoras;
/**
 * 
 */
class MascotaControlador
{
    private $MascotaDAO;

    function __construct()
    {
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
        $this->listar_mascotas();
    }

/*
	===============================================================================
				Funcion listar_mascotas trae todos las mascotas
				en un array de objetos tipo Mascota y las muestra en una vista.
	===============================================================================
*/
    public function listar_mascotas()
    {
        try
        {
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            $Mascotas = $this->MascotaDAO->listar();
            include("../vistas/Mascota/mascota.php");
        
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
    public function modal_mascota_crear()
	{		
		
			include("../vistas/Mascota/Modal/mascota_crear.php");	
		
	}

/*
	===============================================================================
				Funcion modal_mascota_modificar se encarga de mostrar el 
				include que contiene la modificacion con sus respectivos campos.
	===============================================================================
*/	
	public function modal_mascota_modificar($id)
	{		
		try
		{
			$Mascota = new \modelos\Mascota\Mascota($id);
			$Mascota = $this->MascotaDAO->leer($Mascota);
			include("../vistas/Mascota/Modal/mascota_modificar.php");	
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
	}

/*
	===============================================================================
				Funcion que confirma la eliminacion de una mascota.		
	===============================================================================
*/

	public function eliminar_mascota_confirmacion($id)
	{
		try
		{
			$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
			$TipoCerveza = new \modelos\Mascota\Mascota($id);
			include("../vistas/Mascota/Modal/mascota_eliminar_confirmacion.php");
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
	}

/*
	===============================================================================
				Funcion alta_mascota se encarga de dar de alta una mascota en
				el sistema.
	===============================================================================
	 protected $id_mascota;
    protected $nombre;
    protected $raza;
    protected $tamaño;
    protected $observaciones;
    protected $imagen;
*/	
	public function alta_mascota($nombre, $raza, $tamaño, $observaciones, $archivo='')
	{		
		
		try
		{
				$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
				$Mascota = unserialize($_SESSION['Mascota']);			
				$Nueva_Mascota = new \modelos\Mascota\Mascota('',$nombre,$raza,$tamaño,$observaciones,'',$Mascota);
				if(empty($Nueva_Mascota->getRaza()) Or empty($Nueva_Mascota->getTamaño()))
				{
					throw new \Exception("Campo/s vacio/s.");
					exit();		
				}
				$Nueva_Mascota = $this->MascotaDAO->crear($Nueva_Mascota);
				if($Nueva_Mascota!=NULL)
				{
					$this->subir_imagen('crear',$Nueva_Mascota,$archivo);
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Mascota creada correctamente..');
					$Mensaje_Alerta->imprimir();
					$JS_EN_PHP->ejecutar('Procesar("tabla_mascota","mascota/listar_mascota_dueño",['.$Mascota->getId_Mascota().']);');
				}
			
		} catch (\Exception $e) {
				$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
  				$Mensaje_Alerta->imprimir();
		}
		finally {
    			
  				$JS_EN_PHP->limpiar('footer_mascota_crear','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
  		}
				
		
	}
/*
	===============================================================================
				Funcion que modifica los datos desde el dao apartir de un objeto
				de mascota			
	===============================================================================
*/	
public function modificar_mascota($id,$nombre,$raza,$tamaño,$observaciones,$archivo='')
{
    try
    {
        $JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
        $$Mascota = new \modelos\Mascota\Mascota($id,$nombre,$raza,$tamaño,$observaciones);			
        $Anterior_Mascota = $this->MascotaDAO->leer($Mascota);
        $Mascota->setImagen($Anterior_Mascota->getImagen());
        $Mascota = $this->MascotaDAO->actualizar($Mascota);
        if($Mascota!=NULL)
        {
            $this->subir_imagen('modificar',$Mascota,$archivo);			
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Mascota modificada correctamente.');
              $Mensaje_Alerta->imprimir();
            $JS_EN_PHP->ejecutar('Procesar("tabla_mascota","mascota/listar_mascotas",[]);');

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
            
              $JS_EN_PHP->limpiar('footer_mascota_modificar','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
      }
}
/*
	===============================================================================
				Funcion que elimina los datos desde el daos apartir de un id		
	===============================================================================
*/	
public function eliminar_mascota($id)
{
	try
	{
		$JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
		$Mascota = unserialize($_SESSION['Mascota']);
		$Mascota = new \modelos\Mascota\Mascota($id);
		$Mascota = $this->MascotaDAO->borrar($Mascota);
		if($Mascota!=NULL)
		{  				
			$this->eliminar_imagen($Mascota);
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Mascota eliminada correctamente.');
			  $Mensaje_Alerta->imprimir();  				
			$JS_EN_PHP->ejecutar('Procesar("tabla_mascota","mascota/listar_mascotas",['.$Mascota->getId_Mascota().']);');

		}
		else
		{
			throw new \Exception("Error al eliminar la mascota");
			
		}				
		
	} catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
			  $Mensaje_Alerta->imprimir();
	}
	finally {
			
			  $JS_EN_PHP->limpiar('footer_mascota_confirmacion','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
	  }
}
/*
	===============================================================================
				Funcion que se encarga de subir una imagen de mascota		
	===============================================================================
*/		
public function subir_imagen($utilidad,$obj,$archivo)
{
	try
	{
		$fecha_actual = date("Y-m-d-H-i-s");			
		$imagen_subida = false;
		if(strcmp($archivo, "undefined")==0)//Verifico que se quiera subir una imagen
		{
			return $imagen_subida; 
		}
		switch ($utilidad) {
				case 'crear':
				$id_input = 4;
				break;

				case 'modificar':
				$id_input = 5;
				break;
			
		}
		
		$ruta_directorio = 'uploads/imagenes/mascota/';
		$nombre_archivo = basename($_FILES[$id_input]['name']);
		$extension_archivo = pathinfo($nombre_archivo,PATHINFO_EXTENSION);			
		//$nombre_archivo_a_guardar = $obj->getDescripcion().'-'.$fecha_actual.'.'.$extension_archivo;
		$nombre_archivo_a_guardar = $obj->getId_Mascota().'.'.$extension_archivo;
		$ruta_archivo = $ruta_directorio.$nombre_archivo_a_guardar;
		if(isset($archivo))
		{
			$verificar_imagen = getimagesize($_FILES[$id_input]['tmp_name']);
			if($verificar_imagen==false)
			{
				throw new \Exception("El archivo no es una imagen.");
				exit();		
			}
			if(file_exists($ruta_archivo))
			{
				if(unlink($ruta_archivo)==false)
				{
					throw new \Exception("El archivo anterior no se pudo eliminar.");
					exit();		
				}
			}
			if($_FILES[$id_input]['size']>5000000)
			{
				throw new \Exception("El archivo es muy pesado.");
				exit();	
			}
			if (!in_array($extension_archivo, array('jpg','png','jpeg','gif')))
			{
				throw new \Exception("El archivo debe ser PNG, JPG, GIF o JPEG.");
				exit();	
			}
			if(move_uploaded_file($_FILES[$id_input]['tmp_name'], $ruta_directorio."/{$nombre_archivo_a_guardar}"))
			{
				$obj->setImagen('../'.$ruta_directorio.$nombre_archivo_a_guardar);
				if($this->MascotaDAO->actualizar($obj)!=NULL)
				{
					$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Imagen subida correctamente.');
					  $Mensaje_Alerta->imprimir();
					  $imagen_subida = true;
				  }
			}
			else
			{
				throw new \Exception("Ocurrio un error al subir el archivo.");
				exit();	
			}
		}
		return $imagen_subida;			
	} catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
			  $Mensaje_Alerta->imprimir();
	}
}
/*
	===============================================================================
				Funcion que se encarga de eliminar una imagen de mascota	
	===============================================================================
*/	
public function eliminar_imagen($obj)
{
	try
	{
		if($obj == NULL)
		{
			throw new \Exception("El archivo anterior no se pudo eliminar.");
			exit();		
		}
		$ruta = substr($obj->getImagen(),-13);
		if(strcmp($ruta, "no-imagen.jpg")==0)
		{
			return false;
		}
		$obj->setImagen(str_replace("../", "", $obj->getImagen()));
		if(file_exists($obj->getImagen()))
		{
			if(unlink($obj->getImagen())==false)
			{
				throw new \Exception("El archivo anterior no se pudo eliminar.");
				exit();		
			}
			else
			{
				return true;
			}
		}

	} catch (\Exception $e) {
			$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Danger',$e->getMessage());
			  $Mensaje_Alerta->imprimir();
	}
}
/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de mascota		
	===============================================================================
*/	
public function lista_mascotas()
{	
	try 
	{
		return $this->MascotaDAO->listar();		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

	
}
/*
	===============================================================================
		Funcion que se encarga retornar un arreglo con objetos de mascota		
	===============================================================================
*/	
public function lista_mascotas_duenio($id)
{	
	try 
	{
		$Dueño = new \modelos\Usuario\Dueño($id);
		$Mascotas = $this->MascotaDAO->listar_x_dueño($Dueño);
		include('../vistas/Mascota/mascota.php');
			
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
public function leer_mascota($mascota)
{	
	try 
	{
		return $this->MascotaDAO->leer($mascota);		
			
	} catch (\Exception $e) {
		$Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
		  $Mensaje_Alerta->imprimir();  			
	}	

}

} 