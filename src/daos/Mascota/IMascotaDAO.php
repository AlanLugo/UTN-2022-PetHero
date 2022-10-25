<?php
namespace daos\Mascota;
use daos\IDAO as IDAO;
/**
 * 
 */
Interface IMascotaDAO extends IDAO
{
    public function getMascota_byID($id);
    public function listar_x_dueño($obj);
}
?>