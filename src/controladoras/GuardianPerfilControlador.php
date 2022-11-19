<?php
namespace controladoras;
/**
 * 
 */
class GuardianPerfilControlador
{
    private $GuardianDAO;
    private $TipoMascotaDAO;
    private $TamañoMascotaDAO;

    function __construct()
    {
        $this->GuardianDAO = \daos\Guardian\GuardianMysqlDAO::getInstance();
        $this->TipoMascotaDAO = \daos\Mascota\TipoMascotaMysqlDAO::getInstance();
        $this->TamañoMascotaDAO = \daos\Mascota\TamañoMascotaMysqlDAO::getInstance();
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
				Funcion listar_guardianes trae todos las mascotas
				en un array de objetos tipo Guardian y las muestra en una vista.
	===============================================================================
    */
    public function listar_guardian()
    {
        try
        {
            $Tipos_Mascota = $this->TipoMascotaDAO->listar();
            $Tamaños_Mascota = $this->TamañoMascotaDAO->listar();

            $Guardian = unserialize($_SESSION['Guardian']);
            $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
            include("../vistas/Guardian/guardian_modificar_perfil.php");
        
        }catch (\Exception $e){
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
            $Mensaje_Alerta->imprimir();
        }
    }

    public function modificar_perfil_guardian($id_guardian,$id_tipo_mascota,$id_tamaño_mascota,$precio_estimado)
{
    try
    {
        $Guardian = unserialize($_SESSION['Guardian']);
		$Tipo_Mascota = new \modelos\Mascota\Tipo_Mascota($id_tipo_mascota,'');
		$Tamaño_Mascota = new \modelos\Mascota\Tamaño_Mascota($id_tamaño_mascota,'');
        $JS_EN_PHP = new \modelos\Auxiliar\JS_EN_PHP();
        $Guardian = new \modelos\Usuario\Guardian($id_guardian,$Guardian->getNombre(),$Guardian->getDireccion(),$Guardian->getCuil(),$Guardian->getDisponibilidad(),$precio_estimado,$Tipo_Mascota,$Tamaño_Mascota,$Guardian->getId_Cuenta());			
        $Guardian = $this->GuardianDAO->actualizar($Guardian);
        if($Guardian!=NULL)
        {		
            $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('Success','Guardian modificada correctamente.');
              $Mensaje_Alerta->imprimir();
            $JS_EN_PHP->ejecutar('Procesar("tabla_guardian","guardian/listar_guardian",['.$Guardian->getId_Guardian().']);');

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
            
              $JS_EN_PHP->limpiar('footer_guardian_modificar','<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>');
      }
}
    

}