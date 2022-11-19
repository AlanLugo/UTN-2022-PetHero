<div class="panel panel-default">
      <div class="panel-heading"><h4>Buscar un guardian para reservar.. 
      <div class="panel-body">
        <div class="col-md-12">
        <div id="formulario_busqueda_guardian">
            
        <div class="form-group">
            <label class="control-label">Tipo de mascota</label>
                <select class="form-control" id="alta_reserva_mascota_tipo" required>    
                    <?php
                      foreach($Tipos_Mascota_Dueño_Filtro as $Tipo){
                    ?>
                        <option value="<?php echo $Tipo->getId_tipo_mascota();?>"><?php echo $Tipo->getNombre();?></option>
                    <?php      
                    }     
                    ?>
                </select>    
        </div>

        <div class="form-group">
            <label class="control-label">Tamaño</label>
                <select class="form-control" id="alta_reserva_mascota_tamaño" required>    
                    <?php
                      foreach($Tamaños_Mascota_Dueño_Filtro as $Tamaño){
                    ?>
                        <option value="<?php echo $Tamaño->getId_tamaño_mascota();?>"><?php echo $Tamaño->getNombre();?></option>
                    <?php      
                    }     
                    ?>
                </select>    
        </div>
        
      <button type="button" class="btn btn-success" aria-label="Right Align" onclick="Procesar('listar_disponibilidad','disponibilidad/listar_disponibilidad_guardian_raza_tamanio',[$('#alta_reserva_mascota_tipo').val(),$('#alta_reserva_mascota_tamaño').val()]);">Buscar
      </button>

        <div id="listar_disponibilidad">
        </div>
        </div>
        </div>  
      </div>  
      </div>  
</div>  
