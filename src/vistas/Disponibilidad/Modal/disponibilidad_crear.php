<div class="modal-dialog">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Crear Disponibilidad</h4>
    </div>
    <div class="modal-body row">
      <form class="col-xs-12">
        <div id="formulario_alta_disponibilidad">
            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Fecha Inicio</label>
                <input class="form-control" id="alta_disponibilidad_fecha_inicio" placeholder="Ingrese la fecha de inicio" type="datetime-local" >
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Fecha Final</label>
                <input class="form-control" id="alta_disponibilidad_fecha_final" placeholder="Ingrese la fecha de fin" type="datetime-local">
            </div>
            

        </div>
      </form>
    </div>
    <div class="modal-footer" id="footer_disponibilidad_crear">

      <button type="button" class="btn btn-success" onclick="Procesar('formulario_alta_disponibilidad','disponibilidad/alta_disponibilidad',[$('#alta_disponibilidad_fecha_inicio').val(),$('#alta_disponibilidad_fecha_final').val()]);">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>