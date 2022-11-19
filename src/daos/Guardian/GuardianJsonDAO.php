<?php
namespace daos\Guardian;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

use modelos\Usuario\Guardian;

class GuardianJsonDAO implements IGuardianDAO
{
    private $guardianLista = array();
    private $fileName;
    private $id;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/db/guardian.json";
    }

    public function TraerDatos() 
    {
        $this->guardianLista = array();

        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valueArray) {
                $guardian = new Guardian();
                $guardian->setId_Guardian($valueArray["id_guardian"]);
                $guardian->setNombre($valueArray["nombre"]);
                $guardian->setDireccion($valueArray["direccion"]);
                $guardian->setCuil($valueArray["cuil"]);
                $guardian->setDisponibilidad($valueArray["disponibilidad"]);
                $guardian->setPrecio($valueArray["precio"]);
                $guardian->set_tamaño_maximo($valueArray["tamaño_maximo"]);
                $guardian->set_raza_dia($valueArray["raza_dia"]);
                $guardian->setId_Cuenta($valueArray["id_cuenta"]);
                array_push($this->guardianLista, $guardian);

                if ($valueArray["id_guardian"] > $this->id) {
                    $this->id = $valueArray["id_guardian"];
                }
            }
        }
    }

    public function GuardarDatos() 
    {
        $arrayToEncode = array();

        foreach($this->guardianLista as $guardian) {
            $valuesArray["id_guardian"] = $guardian->getId_Guardian();
            $valuesArray["nombre"] = $guardian->getNombre();
            $valuesArray["direccion"] = $guardian->getDireccion();
            $valuesArray["cuil"] = $guardian->getCuil();
            $valuesArray["disponibilidad"] = $guardian->getDisponibilidad();
            $valuesArray["precio"] = $guardian->getPrecio();
            $valuesArray["tamaño_maximo"] = $guardian->get_tamaño_maximo();
            $valuesArray["raza_dia"] = $guardian->get_raza_dia();
            $valuesArray["id_cuenta"] = $guardian->getId_Cuenta();
            array_push($arrayToDecode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function getGuardian_byID($id)
    {
        $this->TraerDatos();
        $guardian = new Guardian();
        foreach($this->guardianLista as $guardian){
            if($guardian->getId_Guardian() == $id){
                return $guardian;
            }
        }
    }

	public function getGuardian_byID_Cuenta($Cuenta){}

	public function leer($obj)
    {
        $this->TraerDatos();
        $guardian = new Guardian();
        foreach($this->guardianLista as $guardian)
        {
            if($guardian->getId_Guardian() == $obj->getId_Guardian())
            {
                return $guardian;
            }
        }
        return $guardian;
    }

	public function leer_x_cuil($obj){}
    public function actualizar($id){}
	public function borrar($id){}

	public function crear($obj)
    {
        $this->TraerDatos();
        $obj->setId_Guardian($this->id + 1);
        array_push($this->guardianLista, $obj);
        $this->GuardarDatos();
    }

	public function listar()
    {
        $this->TraerDatos();
        return $this->guardianLista;
    }

	public function buscar_x_id_guardian($obj){}
}
