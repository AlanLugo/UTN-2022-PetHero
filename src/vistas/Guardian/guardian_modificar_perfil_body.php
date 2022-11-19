<div class="panel panel-default">
      <div class="panel-heading"><h4>Modifica tus datos de Guardian! 
      <div class="panel-body">
        <div class="col-md-12">
        <div id="formulario_busqueda_guardian">
            
        <div class="form-group">
            <label class="control-label">Tipo de mascota</label>
                <select class="form-control" id="modificacion_guardian_tipo"  required>    
                    <?php
                      foreach($Tipos_Mascota as $Tipo){
                    ?>
                        <option value="<?php echo $Tipo->getId_tipo_mascota();?>"><?php echo $Tipo->getNombre();?></option>
                    <?php      
                    }     
                    ?>
                </select>    
        </div>

        <div class="form-group">
            <label class="control-label">Tamaño</label>
                <select class="form-control" id="modificacion_guardian_tamaño"  required>    
                    <?php
                      foreach($Tamaños_Mascota as $Tamaño){
                    ?>
                        <option value="<?php echo $Tamaño->getId_tamaño_mascota();?>"><?php echo $Tamaño->getNombre();?></option>
                    <?php      
                    }     
                    ?>
                </select>    
        </div>

        <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Precio estimado</label>
                <input class="form-control" id="modificacion_guardian_precio_estimado" placeholder="Ingrese un precio estimado" type="number" value='<?php echo $Guardian->getPrecio();?>' required>
        </div>
        
      <button type="button" class="btn btn-success" aria-label="Right Align" onclick="Procesar('listar_disponibilidad','GuardianPerfil/modificar_perfil_guardian',['<?php echo $Guardian->getId_Guardian();?>',$('#modificacion_guardian_tipo').val(),$('#modificacion_guardian_tamaño').val(),$('#modificacion_guardian_precio_estimado').val()]);">Modificar
      </button>

        <div id="listar_disponibilidad">
        </div>
        </div>
        </div>  
      </div>  
      </div>  
</div>