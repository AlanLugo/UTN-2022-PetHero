<div class="panel-body">
<table class="table table-hover">
  <thead class="row">
    <tr>            
      <th class="col-md-4">Fecha Inicio</th>
      <th class="col-md-2">Fecha Final</th>
      <th class="col-md-2">Disponibilidad</th>
    </tr>
  </thead>
  <tbody class="row">
  <?php    
  foreach($Disponibilidades as $Disponibilidad){
    ?>
    <tr>
      <td class="col-md-4"><?php echo $Disponibilidad->getId_Disponibilidad()?></td>
      <td class="col-md-2"><?php echo $Disponibilidad->getFechaInicio()?></td>
      <td class="col-md-2"><?php echo $Disponibilidad->getFechaFinal()?></td>
      <td class="col-md-2"><?php echo $Disponibilidad->getDisponible()?></td>
      <td class="col-md-2">
        <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_vista_previa_pedido" onclick="Procesar('modal_vista_previa_pedido','pedido/modal_vista_previa_pedido',['<?php echo $Pedido->getId_Pedido();?>']);return false;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        </button>

        <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_editar_estado_pedido" onclick="Procesar('modal_editar_estado_pedido','pedido/modal_editar_estado_pedido',['<?php echo $Pedido->getId_Pedido();?>']);return false;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </button>

      </td>
    </tr>
    <?php      
  }     
  ?>      
  </tbody>
</table>
</div>
