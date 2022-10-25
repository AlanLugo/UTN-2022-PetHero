<?php
if($Disponibilidades==NULL)
{
  throw new \Exception("No hay registros almacenados...");
}
?>
<div class="panel panel-default">
<div id="tabla_pedido_body">
<?php
include("disponibilidad_body.php");
?>
</div>
</div>
      
      
 