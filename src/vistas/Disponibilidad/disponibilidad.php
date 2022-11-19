
<div class="row" id="tabla_disponibilidad">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default ">
    <div class="panel-heading"><h2>Mi Disponibilidad</h2>
      <button type="button" class="btn btn-success btn-md pull-right"  aria-label="Left Align" data-toggle="modal" data-target="#modal_alta_disponibilidad" onclick="Procesar('modal_alta_disponibilidad','disponibilidad/modal_disponibilidad_crear',[]);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
      </button>
    </div>
    <div id="tabla_disponibilidad_body">
    <?php
      if($Disponibilidades==NULL)
      {
        throw new \Exception("No hay registros almacenados...");
      }
      ?>
    <?php
    include("disponibilidad_body.php");
    ?>
    </div>
    </div>
</div>
</div>