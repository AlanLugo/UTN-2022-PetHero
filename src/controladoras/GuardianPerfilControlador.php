<?php
namespace controladoras;
/**
 * 
 */
class GuardianPerfilControlador
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
        $Guardian = unserialize($_SESSION['Guardian']);
        $TiempoRespuesta = new \modelos\Auxiliar\TiempoRespuesta();
        include("../vistas/Guardian/guardian_modificar_perfil.php");
    
    }catch (\Exception $e){
        $Mensaje_Alerta = new \modelos\Auxiliar\MensajeAlerta('warning',$e->getMessage());
        $Mensaje_Alerta->imprimir();
    }
}
}