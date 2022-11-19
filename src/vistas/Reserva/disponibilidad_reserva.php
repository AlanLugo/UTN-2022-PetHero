<?php
if($Disponibilidades==NULL)
{
  throw new \Exception("No hay registros almacenados...");
}
?>
<div id="tabla_disponibilidad_body">
    <?php
      include("disponibilidad_reserva_body.php");
    ?>
</div>