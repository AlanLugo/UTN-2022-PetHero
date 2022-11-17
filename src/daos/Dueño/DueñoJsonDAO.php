<?php
namespace daos\Guardian;

use daos\Dueño\IDueñoDAO;
use modelos\Usuario\Dueño;
use modelos\Usuario\Guardian;

class DueñoJsonDAO implements IDueñoDAO
{
    private $dueñoLista = array();
    private $fileName;
    private $id;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__)."/db/dueño.json";
    }

    public function TraerDatos() 
    {
        $this->dueñoLista = array();

        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valueArray) {
                $dueño = new Dueño();
                $dueño->setId_Dueño($valueArray["id_dueño"]);
                $dueño->setNombre($valueArray["nombre"]);
                $dueño->setDni($valueArray["dni"]);
                $dueño->setDireccion($valueArray["direccion"]);
                $dueño->setTelefono($valueArray["telefono"]);

                $dueño->setId_Cuenta($valueArray["id_cuenta"]);
                array_push($this->dueñoLista, $dueño);

                if ($valueArray["id_guardian"] > $this->id) {
                    $this->id = $valueArray["id_guardian"];
                }
            }
        }
    }

    public function GuardarDatos() 
    {
        $arrayToEncode = array();

        foreach($this->dueñoLista as $dueño) {
            $valuesArray["id_dueño"] = $dueño->getId_Dueño();
            
            array_push($arrayToDecode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function getDueño_byID($id)
    {
        $this->TraerDatos();
        $guardian = new Guardian();
        foreach($this->guardianLista as $guardian){
            if($guardian->getId_Guardian() == $id){
                return $guardian;
            }
        }
    }
	public function getDueño_byID_Cuenta($Cuenta){}
	public function leer($obj){}
	public function leer_x_apellido_nombre($obj){}
	public function actualizar($id){}
	public function borrar($id){}
	public function crear($obj){}
	public function listar(){}
}