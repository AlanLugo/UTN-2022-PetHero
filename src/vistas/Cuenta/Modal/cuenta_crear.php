<div class="modal-dialog">
    <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Crear Cuenta</h4>
    </div>
    <div class="modal-body row">
      <form class="col-xs-12">
        <div id="formulario_alta_cuenta">

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Usuario</label>
                <input class="form-control" id="alta_cuenta_usuario" placeholder="Ingrese un usuario email" type="email" >
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Contraseña</label>
                <input class="form-control" id="alta_cuenta_password" placeholder="Ingrese una contraseña" type="password">
            </div>
            
            <div class="form-group">
                <label class="control-label">Rol</label>
                    <select class="form-control" id="alta_cuenta_rol" placeholder="Seleccione un rol">
                      
                      <div id="registro_dueño">
                        <option>Dueño</option>
                      </div>
                      
                      <div id="registro_guardian">
                        <option>Guardian</option>
                    </div>
                    </select>
            </div>

        </div>
      </form>
    </div>
    <div class="modal-footer" id="footer_cuenta_crear">

      <button type="button" class="btn btn-success" onclick="Procesar('formulario_alta_cuenta','cuenta/alta_cuenta',[$('#alta_cuenta_usuario').val(),$('#alta_cuenta_password').val(),$('#alta_cuenta_rol').val()]);">Crear cuenta
    
    </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>




<script type="text/javascript">
    var rol = document.getElementById('alta_cuenta_rol').value;

    if(rol == "Dueño"){

    }
</script>