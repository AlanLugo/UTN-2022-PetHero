<?php 
namespace daos;
Use PDOException;
/**
* 
*/

class Conexion extends SingletoneAbstractDAO
{
    
    protected function __construct()
    {
        try {//200.58.103.100
           
           $this->dbh = new \PDO( 'mysql:host=localhost;dbname=pethero','root', '' );
            $this->dbh->exec("SET CHARACTER SET utf8");
            
        } catch (PDOException $e) {
           
            print "Error!: " . $e->getMessage();
            
            die();
        }
    }
    
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }
    public function prepare($sql)
    {
       
        return $this->dbh->prepare($sql);
        
    }
    
     // Evita que el objeto se pueda clonar
    public function __clone()
    {
       
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
        
    }
}
?>