
<?php
use modelos\Mascota\Tipo_Mascota;
use modelos\Mascota\Raza_Mascota;
use modelos\Mascota\Tamaño_Mascota;
?>

<div class="row" id="tabla_mascota">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default ">
    <div class="panel-heading"><h2>Mis Mascotas
      <button type="button" class="btn btn-success btn-md pull-right"  aria-label="Left Align" data-toggle="modal" data-target="#modal_alta_mascota" onclick="Procesar('modal_alta_mascota','mascota/modal_mascota_crear',[]);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
      </button>
    </div>
    <div id="tabla_mascota_body">
    <?php
      if($Mascotas==NULL)
      {
          throw new \Exception("No hay registros almacenados...");   
      }      
      ?>
    <?php
    include("mascota_body.php");
    ?>
    </div>
    </div>
</div>
</div>

      
 