<?php
if($Reservas==NULL)
{
  throw new \Exception("No hay registros almacenados...");
}
?>

<div class="row" id="tabla_reserva">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading"><h2>Mis Reservas
      <?php
        include("lista_reserva.php");
        ?>   
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