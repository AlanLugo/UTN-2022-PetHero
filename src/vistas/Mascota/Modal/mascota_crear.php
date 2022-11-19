<div class="modal-dialog">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Crear Mascota</h4>
    </div>
    <div class="modal-body row">
      <form class="col-xs-12">
        <div id="formulario_alta_mascota">
            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Nombre</label>
                <input class="form-control" id="alta_mascota_nombre" placeholder="Ingrese un nombre" type="text" >
            </div>
            <div class="form-group">
              <label class="control-label">Tipo de mascota</label>
                  <select class="form-control" id="alta_mascota_tipo" required>    
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
              <label class="control-label">Raza</label>
                  <select class="form-control" id="alta_mascota_raza" required>    
                    <?php
                      foreach($Razas_Mascota as $Raza){
                    ?>
                        <option value="<?php echo $Raza->getId_raza_mascota();?>"><?php echo $Raza->getNombre();?></option>
                    <?php      
                    }     
                    ?>
                  </select>    
            </div>

            <div class="form-group">
              <label class="control-label">Tamaño</label>
                  <select class="form-control" id="alta_mascota_tamaño" required>    
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
                for="inputEmail3">Observaciones</label>
                <textarea class="form-control" id="alta_mascota_observacion"></textarea>
        </div>
        
        <div class="form-group">
                    <label for="ejemplo_archivo_1">Adjuntar Imagen</label>
                        <p class="help-block">Imagenes PNG y JPG.</p>
                    <label class="btn btn-primary" for="imagen-mascota">

                    <input id="imagen-mascota" type="file" style="display:none;" onchange="$('#info-imagen-mascota').html($(this).val());">
                        Buscar Imagen
                </label>
            <span class='label label-info' id="info-imagen-mascota"></span> </div>

    </div>
      </form>
    </div>
    <div class="modal-footer" id="footer_mascota_crear">

      <button type="button" class="btn btn-success" onclick="Procesar('formulario_alta_mascota','mascota/alta_mascota',[$('#alta_mascota_nombre').val(),$('#alta_mascota_observacion').val(),$('#alta_mascota_tipo').val(),$('#alta_mascota_raza').val(),$('#alta_mascota_tamaño').val(),$('#imagen-mascota').prop('files')[0]]);">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#alta_mascota_nombre').focus();
</script>