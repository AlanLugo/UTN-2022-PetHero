<div class="modal-dialog">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Modificar Disponibilidad</h4>
    </div>
    <div class="modal-body row">
      <form class="col-xs-12">
        <div id="formulario_modificar_disponibilidad">
            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Fecha Inicio</label>
                <input class="form-control" id="modificar_disponibilidad_fecha_inicio" placeholder="Ingrese la fecha de inicio" type="datetime-local" value="<?php echo $Disponibilidad->getFechaInicio();?>">
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Fecha Final</label>
                <input class="form-control" id="modificar_disponibilidad_fecha_final" placeholder="Ingrese la fecha de fin" type="datetime-local" value="<?php echo $Disponibilidad->getFechaFinal();?>">
            </div>

            <div class="form-group">
            <select name="choice" id="modificar_disponibilidad_disponibilidad">
  <option value="1" selected>Activo</option>
  <option value="0">Inactivo</option>
</select></div>
            

        </div>
      </form>
    </div>
    <div class="modal-footer" id="footer_disponibilidad_modificar">

      <button type="button" class="btn btn-success" onclick="Procesar('formulario_modificar_disponibilidad','disponibilidad/modificar_disponibilidad',['<?php echo $Disponibilidad->getId_Disponibilidad();?>',$('#modificar_disponibilidad_fecha_inicio').val(),$('#modificar_disponibilidad_fecha_final').val(),$('#modificar_disponibilidad_disponibilidad').val()]);">Modificar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>