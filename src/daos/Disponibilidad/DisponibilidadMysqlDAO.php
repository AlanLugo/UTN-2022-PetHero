<?php
namespace daos\Disponibilidad;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

/**
 * 
 */
class DisponibilidadMysqlDAO extends SingletoneAbstractDAO implements IDisponibilidadDAO
{
    protected $tabla = 'disponibilidades';
    protected $dbh;
    public function __construct()
    {
        $this->dbh = Conexion::getInstance();
    }

    public function getDisponibilidad_byID($id){}

    public function getDisponibilidad_byID_Guardian($Guardian)
    {
        try {

            $Mascota = NULL;

            $sql = "SELECT * from ".$this->tabla." WHERE id_disponibilidad = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1, $$Guardian->getId_Guardian());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\disponibilidad.php');
            $Mascota = $query->fetch();
            $Mascota->setId_Guardian($Guardian);
            return $Disponibilidad;

        }catch(PDOException $e){
            print "Error!: " . $e->getMessage();
        }
    }

    public function leer($obj)
    {

        try{
            $sql = "SELECT * from ".$this->tabla." WHERE id_disponibilidad = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_Disponibilidad());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\Disponibilidad');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function leer_x_fecha_Inicio($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE fecha_inicio = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getFechaInicio());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\disponibilidad.php');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function leer_x_fecha_Final($obj){

		try {			
			$sql = "SELECT * from ".$this->tabla." WHERE fecha_final = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getFechaFinal());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\disponibilidad.php');
			$obj = $query->fetch();			
			return $obj;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function actualizar($obj)
    {
        try {
            $obj_existente = $this->leer($obj);
            if($obj_existente != NULL && $obj_existente->getId_Disponibilidad() != $obj->getId_Disponibilidad())
            {
                throw new \Exception("Error ya existe un registro con el mismo nombre.");
                exit();
            }
            /* 
                protected $fechaInicio;
                protected $fechaFinal;
                protected $disponible;
                protected $id_guardian;

                $this->setId_Disponibilidad($id_disponibilidad);
                $this->setFechaInicio($fechaInicio);
                $this->setFechaFinal($fechaFinal);
                $this->setDisponible($disponible);
                $this->setId_Guardian($id_guardian);
         
            */
            $sql = "UPDATE " . $this->tabla . " SET fecha_inicio = ?, fecha_final = ?, disponible = ? WHERE id_disponibilidad = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getFechaInicio());
            $query->bindValue(2,$obj->getFechaFinal());
            $query->bindValue(3,$obj->getDisponible());
            $query->bindValue(4,$obj->getId_Disponibilidad());
            if($query->execute())
            {
                return $obj;
            }
            else
            {
                return NULL;
            }
        }catch(PDOException $e){
            
            print "Error!: " . $e->getMessage();
        }
    }
	
    public function borrar($obj) 
    {
        try {
            $obj = $this->leer($obj);
            $sql = "DELETE FROM " . $this->tabla . " WHERE id_disponibilidad = ? ";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_Disponibilidad());
            if($query->execute())
            {
                return $obj;
            }
            else
            {
                return NULL;
            }
        }catch(PDOException $e)
        {

            print "Error!: " . $e->getMessage();
        }
        
    }

	public function crear($obj)
    {
        try{
            /*if($this->leer($obj) != NULL)
            {
                throw new \Exception("Ya existe una disponibilidad con la misma descripcion.");
                exit();
            }*/
            $sql = "INSERT INTO " . $this->tabla . " (fecha_inicio,fecha_final,disponible,id_guardian) VALUES (?,?,?,?)";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getFechaInicio());
            $query->bindValue(2,$obj->getFechaFinal());
            $query->bindValue(3,$obj->getDisponible());
            $query->bindValue(4,$obj->getId_Guardian()->getId_Guardian());
            if($query->execute())
            {
                $obj->setId_Disponibilidad($this->dbh->lastInsertId());
                return $obj;
            }
            else
            {
                return NULL;
            }
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }

    }

	public function listar(){
        try{

            $sql = "SELECT * from".$this->tabla;
            $query = $this->dbh->prepare($sql);
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\Disponibilidad');
            $obj = NULL;
            while ($row = $query->fetch()) {
                $obj[] = $row;
            }

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function listar_x_guardian($obj)
	{
		try {
			$sql = "SELECT * from ".$this->tabla." where id_guardian = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getId_Guardian());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\Disponibilidad');
			$Disponibilidad = NULL;
			while ($row = $query->fetch()) {				
				$Disponibilidad[] = $row;
			}
			return $Disponibilidad;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function listar_disponibilidad_guardian_raza_tamanio($obj)
	{


		try {
			$sql = "SELECT id_disponibilidad,fecha_inicio,fecha_final,disponible,disponibilidades.id_guardian as id_guardian from ".$this->tabla." INNER JOIN guardianes ON disponibilidades.id_guardian = guardianes.id_guardian WHERE tamaño_maximo = ? AND raza_dia = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->get_tamaño_maximo());
			$query->bindValue(2,$obj->get_raza_dia());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\Disponibilidad');
			$Disponibilidad = NULL;
			while ($row = $query->fetch()) {				
				$Disponibilidad[] = $row;
			}
			return $Disponibilidad;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function buscar_x_id_disponibilidad($obj)
    {
        try {

            $sql = "SELECT * from ".$this->tabla." WHERE id_disponibilidad = ? order by id_disponibilidad";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_Disponibilidad());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Disponibilidad\Disponibilidad');
            $obj = $query->fetch();
            return $obj;

        }catch(PDOException $e){

            print  "Error!: " . $e->getMessage();

        }
    }
}
?>