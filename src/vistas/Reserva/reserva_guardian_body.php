<div class="panel-body">
<table class="table table-hover">
  <thead class="row">
    <tr>            
      <th class="col-md-1">Fecha Inicio</th>
      <th class="col-md-1">Fecha Final</th>
      <th class="col-md-1">Mascota</th>
      <th class="col-md-1">Dueño</th>
      <th class="col-md-2">Telefono</th>
      <th class="col-md-6">Acciones</th>
    </tr>
  </thead>
  <tbody class="row">
  <?php    
  foreach($Reservas as $Reserva){
    ?>
    <tr>
      <td class="col-md-3"><?php echo $Reserva->getFecha_inicio()?></td>
      <td class="col-md-3"><?php echo $Reserva->getFecha_final()?></td>
      <td class="col-md-2"><?php echo $Reserva->getId_mascota()->getNombre()?></td>
      <td class="col-md-2"><?php echo $Reserva->getId_Dueño()->getNombre()?></td>
      <td class="col-md-2"><?php echo $Reserva->getId_Dueño()->getTelefono()?></td>
      <td class="col-md-4">
        <!-- 0 Pendiente - 1 Aceptada - 2 Rechazada-->
        <?php
        if($Reserva->getEstado()==0){
            ?>
            <button type="button" class="btn btn-success" onclick="Procesar('tabla_reservas_body','reserva/acciones_reserva',['1']);">Aceptar</button> 
            <button type="button" class="btn btn-danger" onclick="Procesar('tabla_reservas_body','reserva/acciones_reserva',['2']);">Rechazar</button> 
            <?php
        }        
        ?>
      </td>
    </tr>
    <?php      
  }     
  ?>      
  </tbody>
</table>
</div>