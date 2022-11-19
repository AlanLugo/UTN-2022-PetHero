<div class="modal-dialog">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Crear Reserva</h4>
    </div>
    <div class="modal-body row">
      <form class="col-xs-12">
        <div id="formulario_alta_reserva">

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Fecha Inicio: <?php echo $Disponibilidad->getFechaInicio();?></label>
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Fecha Final: <?php echo $Disponibilidad->getFechaFinal();?></label>
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Nombre guardian: <?php echo $Disponibilidad->getId_Guardian()->getNombre();?></label>
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Precio jornada: <?php echo $Disponibilidad->getId_Guardian()->getPrecio();?></label>
            </div>
            
            <div class="form-group">
              <label class="control-label">Mis mascotas</label>
                  <select class="form-control" id="seleccion_mascota" required>    
                    <?php
                      foreach($Mascotas as $Mascota){
                    ?>
                        <option value="<?php echo $Mascota->getId_mascota();?>"><?php echo $Mascota->getNombre();?></option>
                    <?php      
                    }     
                    ?>
                  </select>    
            </div>
      </form>
    </div>
    <div class="modal-footer" id="footer_reserva_crear">

      <button type="button" class="btn btn-success" onclick="Procesar('formulario_alta_reserva','reserva/alta_reserva',['<?php echo $Disponibilidad->getFechaInicio();?>','<?php echo $Disponibilidad->getFechaFinal();?>',$('#seleccion_mascota').val(),'<?php echo $Disponibilidad->getId_Guardian()->getId_Guardian();?>']);">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>

