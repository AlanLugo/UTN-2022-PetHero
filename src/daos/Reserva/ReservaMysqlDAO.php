<?php
namespace daos\Reserva;
use daos\SingletoneAbstractDAO as SingletoneAbstractDAO;
use daos\Conexion as Conexion;
use PDOException;

/**
 * 
 */
class ReservaMysqlDAO extends SingletoneAbstractDAO implements IReservaDAO
{
    protected $tabla = 'reservas';
    protected $dbh;
    private $MascotaDAO;
    private $DueñoDAO;
    private $GuardianDAO;
    public function __construct()
    {
        $this->dbh = Conexion::getInstance();
        $this->MascotaDAO = \daos\Mascota\MascotaMysqlDAO::getInstance();
        $this->DueñoDAO = \daos\Dueño\DueñoMysqlDAO::getInstance();
        $this->GuardianDAO = \daos\Guardian\GuardianMysqlDAO::getInstance();
    }

    public function getReserva_byID($id){}

    public function leer($obj)
    {

        try{
            $sql = "SELECT * from ".$this->tabla." WHERE id_reserva= ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_reserva());
            $query->execute();
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Reserva\Reserva');
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
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Reserva\Reserva.php');
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
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Reserva\Reserva.php');
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
            if($obj_existente != NULL && $obj_existente->getId_reserva() != $obj->getId_reserva())
            {
                throw new \Exception("Error ya existe un registro con el mismo nombre.");
                exit();
            }
            $sql = "UPDATE " . $this->tabla . " SET fecha_inicio = ?, fecha_final = ?, estado = ? WHERE id_reserva = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getFecha_inicio());
            $query->bindValue(2,$obj->getFecha_final());
            $query->bindValue(3,$obj->getEstado());
            $query->bindValue(4,$obj->getId_reserva());
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
            $sql = "DELETE FROM " . $this->tabla . " WHERE id_reserva = ? ";
            $query = $this->dbh->prepare($sql);
            $query->bindValue(1,$obj->getId_reserva());
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
            $sql = "INSERT INTO " . $this->tabla . " (fecha_inicio,fecha_final,estado,id_mascota,id_dueño,id_guardian) VALUES (?,?,?,?,?,?)";
            $query = $this->dbh->prepare($sql);
            //seguir aca 
            $query->bindValue(1,$obj->getFecha_inicio());
            $query->bindValue(2,$obj->getFecha_final());
            $query->bindValue(3,$obj->getEstado());
            $query->bindValue(4,$obj->getId_mascota()->getId_mascota());
            $query->bindValue(5,$obj->getId_dueño()->getId_dueño());
            $query->bindValue(6,$obj->getId_guardian()->getId_guardian());
            if($query->execute())
            {
                $obj->setId_reserva($this->dbh->lastInsertId());
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
            $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Reserva\Reserva');
            $obj = NULL;
            while ($row = $query->fetch()) {
                $obj[] = $row;
            }

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
    }

    public function listar_x_dueño($obj)
	{
		try {
			$sql = "SELECT * from ".$this->tabla." where id_dueño = ?";
			$query = $this->dbh->prepare($sql);
			$query->bindValue(1,$obj->getId_Dueño());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Reserva\Reserva');
			$Reservas = NULL;
			while ($row = $query->fetch()) {
                $row->setId_Mascota($this->MascotaDAO->leer(new \modelos\Mascota\Mascota($row->getId_mascota())));			
                $row->setId_Guardian($this->GuardianDAO->leer(new \modelos\Usuario\Guardian($row->getId_Guardian())));
				$Reservas[] = $row;
			}
			return $Reservas;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

    public function listar_x_guardian($obj)
	{
		try {
			$sql = "SELECT * from ".$this->tabla." INNER JOIN mascotas ON reservas.id_mascota = mascotas.id_mascota AND mascotas.id_tipo_mascota = ? where id_guardian = ?";
			$query = $this->dbh->prepare($sql);            
            $query->bindValue(1,$obj->getId_tipo_mascota());
			$query->bindValue(2,$obj->getId_Guardian());
			$query->execute();
			$query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'modelos\Reserva\Reserva');
			$Reservas = NULL;
			while ($row = $query->fetch()) {	
                $row->setId_Mascota($this->MascotaDAO->leer(new \modelos\Mascota\Mascota($row->getId_mascota())));			
                $row->setId_Dueño($this->DueñoDAO->leer(new \modelos\Usuario\Dueño($row->getId_Dueño())));			
				$Reservas[] = $row;
			}
			return $Reservas;
			
		}catch(PDOException $e){
			
			print "Error!: " . $e->getMessage();
			
		}
	}

}
?>