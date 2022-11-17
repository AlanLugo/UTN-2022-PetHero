<?php
namespace daos\Guardian;

use modelos\Usuario\Dueño;

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
            $valuesArray["nombre"] = $dueño->getNombre();
            $valuesArray["dni"] = $dueño->getDni();
            $valuesArray["direccion"] = $dueño->getDireccion();
            $valueArray["telefono"] = $dueño->getTelefono();
            $valueArray["id_cuenta"] = $dueño->getId_Cuenta();
            array_push($arrayToDecode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->fileName, $jsonContent);
    }

    public function getDueño_byID($id)
    {
        $this->TraerDatos();
        $dueño = new Dueño();
        foreach($this->dueñoLista as $dueño) {
            if($dueño->getId_Dueño() == $id) {
                return $dueño;
            }
        }
        
    }

	public function getDueño_byID_Cuenta($Cuenta){}

	public function leer($obj)
    {
        $this->TraerDatos();
        $dueño = new Dueño();
        foreach($this->dueñoLista as $dueño) 
        {
            return $dueño;
        }
        return $dueño;
    }

	public function leer_x_apellido_nombre($obj){}
	public function actualizar($id){}
	public function borrar($id){}
    
	public function crear($obj)
    {
        $this->TraerDatos();
        $obj->setId_Dueño($this->id + 1);
        array_push($this->dueñoLista, $obj);
        $this->GuardarDatos();
    }

	public function listar()
    {
        $this->TraerDatos();
        return $this->dueñoLista;
    }
}