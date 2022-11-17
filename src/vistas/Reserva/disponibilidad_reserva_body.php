<div class="panel-body">
<table class="table table-hover">
  <thead class="row">
    <tr>            
      <th class="col-md-4">Fecha Inicio</th>
      <th class="col-md-4">Fecha Final</th>
      <th class="col-md-2">Acciones</th>
    </tr>
  </thead>
  <tbody class="row">
  <?php    
  foreach($Disponibilidades as $Disponibilidad){
    ?>
    <tr>
      <td class="col-md-4"><?php echo $Disponibilidad->getFechaInicio()?></td>
      <td class="col-md-4"><?php echo $Disponibilidad->getFechaFinal()?></td>
      <td class="col-md-2">
        <button type="button" class="btn btn-success btn-md pull-right"  aria-label="Left Align" data-toggle="modal" data-target="#modal_alta_reserva" onclick="Procesar('modal_alta_reserva','reserva/modal_reserva_crear',['<?php echo $Disponibilidad->getId_Disponibilidad();?>']);return false;">Reservar <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
      </button>
      </td>
    </tr>
    <?php      
  }     
  ?>      
  </tbody>
</table>
</div>