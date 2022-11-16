<div class="modal-dialog">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Buscar guardian disponibilidad por raza y tamaño</h4>
    </div>
    <div class="modal-body row">
      <form class="col-xs-12">
        <div id="formulario_busqueda_guardian">
            <div class="form-group">
                <label class="control-label">Raza</label>
                    <select class="form-control" id="busqueda_guardian_raza_dia" placeholder="Ingrese una raza a buscar" required>
                        <option>Vacio</option>
                        <option>Caniche</option>
                        <option>Chihuahua</option>
                        <option>Bulldog</option>
                        <option>Yorkshire</option>
                        <option>Labrador</option>
                        <option>Boxer</option>
                        <option>Husky</option>
                        <option>Pitbull</option>
                        <option>San Bernardo</option>
                        <option>Dogo Argentino</option>
                        <option>Bobtail</option>
                    </select>    
            </div>

            <div class="form-group">
                <label class="control-label">Tamaño</label>
                    <select class="form-control" id="busqueda_guardian_tamaño_maximo" placeholder="Ingrese un tamaño maximo a buscar" required>
                        <option>Vacio</option>
                        <option>Chico</option>
                        <option>Mediano</option>
                        <option>Grande</option>
                    </select>    
            </div>
        </div>

      <button type="button" class="btn btn-success" aria-label="Right Align" onclick="Procesar('listar_disponibilidad','disponibilidad/listar_disponibilidad_guardian_raza_tamanio',[$('#busqueda_guardian_raza_dia').val(),$('#busqueda_guardian_tamaño_maximo').val()]);">Buscar
      </button>

      </form>
    </div>
    
    <div id="listar_disponibilidad">
    
    </div>
  
  </div>
</div>
