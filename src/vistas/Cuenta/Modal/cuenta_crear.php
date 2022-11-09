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
                    <select class="form-control" id="alta_cuenta_rol" placeholder="Seleccione un rol" onchange="ocultar_div()" >
                        <option>Vacio</option>
                        <option>Dueño</option>
                        <option>Guardian</option>
                    </select>    
            </div>

            <div id="registro_dueño" style="display: none;">
              <?php include("../vistas/Registros/registro_dueño.php");?>
            </div>
            
            <div id="registro_guardian" style="display: none;">
            <?php include("../vistas/Registros/registro_guardian.php");?>
          </div>
              <script>
                
              </script>
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




<script>
    function ocultar_div (){
      var estado_select = $('#alta_cuenta_rol').val();
      console.log(estado_select);
      var registro_dueño = document.getElementById("registro_dueño");
      var registro_guardian = document.getElementById("registro_guardian");
      
      if (registro_dueño.style.display === "none") 
      {
        registro_dueño.style.display = "block";
        registro_guardian.style.display = "none";

      } else if (registro_guardian.style.display === "none"){
        registro_dueño.style.display = "none";
        registro_guardian.style.display = "block";
      }

      if(estado_select === 'Vacio'){
        registro_dueño.style.display = "none";
        registro_guardian.style.display = "none";
      }
            
    }
</script>

<script>
    function ocultar_div_guardian() {
      
            if (registro_guardian.style.display === "none") 
            {
              registro_guardian.style.display = "block";
            } else {
              registro_guardian.style.display = "none";
            }
            
    }
</script>