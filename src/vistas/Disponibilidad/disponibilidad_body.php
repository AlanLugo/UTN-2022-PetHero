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
        <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_editar_disponibilidad" onclick="Procesar('modal_editar_disponibilidad','disponibilidad/modal_disponibilidad_modificar',['<?php echo $Disponibilidad->getId_Disponibilidad();?>']);return false;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </button> 

        <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_confirmacion" onclick="Procesar('modal_confirmacion','disponibilidad/eliminar_disponibilidad_confirmacion',['<?php echo $Disponibilidad->getId_Disponibilidad();?>']);return false;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </button> 
      </td>
    </tr>
    <?php      
  }     
  ?>      
  </tbody>
</table>
</div>