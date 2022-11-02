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
            $nombre, $raza, $tamaño, $observaciones, $archivo=''
            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Raza</label>
                <input class="form-control" id="alta_mascota_raza" placeholder="Ingrese una raza" type="text">
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Tamaño</label>
                <input class="form-control" id="alta_mascota_tamaño" placeholder="Ingrese un tamaño" type="text">
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
            <span class='label label-info' id="info-imagen-mascota"></span>          
        </div>
    </div>
      </form>
    </div>
    <div class="modal-footer" id="footer_mascota_crear">

      <button type="button" class="btn btn-success" onclick="Procesar('formulario_alta_mascota','mascota/alta_mascota',[$('#alta_mascota_nombre').val(),$('#alta_mascota_raza').val(),$('#alta_mascota_tamaño').val(),$('#alta_mascota_observacion').val(),$('#imagen-mascota').prop('files')[0]]);">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#alta_mascota_nombre').focus();
</script>