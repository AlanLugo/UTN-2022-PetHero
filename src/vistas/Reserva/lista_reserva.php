<div class="panel-body">
<table class="table table-hover">
  <thead class="row">
    <tr>            
      <th class="col-md-4">Fecha Inicio</th>
      <th class="col-md-4">Fecha Final</th>
      <th class="col-md-4">Nombre Guardian</th>
      <th class="col-md-4">Precio Jornada</th>
      <th class="col-md-4">Mascota</th>
      <th class="col-md-4">Estado</th>
      <th class="col-md-2">Acciones</th>
    </tr>
  </thead>
  <tbody class="row">
  <?php    
  foreach($Reservas as $Reserva){
    ?>
    <tr>
      <td class="col-md-4"><?php echo $Reserva->getFecha_inicio()?></td>
      <td class="col-md-4"><?php echo $Reserva->getFecha_final()?></td>
      <td class="col-md-4"><?php echo $Reserva->getId_guardian()->getNombre()?></td>
      <td class="col-md-4"><?php echo $Reserva->getId_guardian()->getPrecio()?></td>
      <td class="col-md-4"><?php echo $Reserva->getId_mascota()->getNombre()?></td>
      <td class="col-md-4"><?php echo $Reserva->getEstadoReservaStr()?></td>
      <td class="col-md-2">
        <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_editar_reserva" onclick="Procesar('modal_editar_reserva','reserva/reserva_modificar',['<?php echo $Reserva->getId_reserva();?>']);return false;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </button> 

        <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_eliminar_reserva" onclick="Procesar('modal_eliminar_reserva','reserva/reserva_eliminar_confirmacion',['<?php echo $Reserva->getId_reserva();?>']);return false;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </button> 
      </td>
    </tr>
    <?php      
  }     
  ?>      
  </tbody>
</table>
</div>