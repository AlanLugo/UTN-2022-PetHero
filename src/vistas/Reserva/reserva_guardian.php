<?php
if($Reservas==NULL)
{
  throw new \Exception("No hay registros almacenados...");
}
?>
<div class="row" id="tabla_reservas">
  <div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default ">
    <div class="panel-heading"><h2>Mis Solicitudes</h2>
    </div>
    <div id="tabla_reservas_body">
    <?php
    include("reserva_guardian_body.php");
    ?>
    </div>
    </div>
</div>
</div>