<?php
if($Pedidos==NULL)
{
  throw new \Exception("No hay registros almacenados...");
}
?>
<div class="row" id="tabla_sucursal">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading"><h2>Mis Reservas
              <button type="button" class="btn btn-success btn-md pull-right"  aria-label="Left Align" onclick="Procesar('body-panel-dueño','reserva/crear_reserva',[]);return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              </button></div>
      <div class="panel-body">          
        <div id="tabla_reserva_body">
        <?php
        include("reserva_body.php");
        ?>
        </div>
      </div>
      
    </div>
  </div>
</div>