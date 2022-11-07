<link href="../css/inicio-session.css" rel="stylesheet"> 


<form class="form-signin" method="post">
 <div class="inicio">
    <div class="inicio-contenedor" style="padding: 15px;text-align-last: center;"><img src="images/logo-pethero.png" class="img-responsive" style="margin: 0 auto;" alt="Imagen responsive">
    </div>         
    <div class="inicio-contenedor" style="padding:10px;"><label for="inputEmail" class="sr-only">Nombre de Usuario</label>
      <input name="username" type="textarea" id="usuario" class="form-control" placeholder="Nombre de Usuario" required autofocus>
      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input name="password" type="password" id="contrasena" class="form-control" placeholder="Contraseña" onKeyDown="if(event.keyCode==13) Procesar('resultado_login', 'login/ingresar', [$('#usuario').val(), $('#contrasena').val()])" required>
      <div id="resultado_login"></div>
      <div class="checkbox">
        <label><input type="checkbox" value="remember-me"> Recordar</label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="button" onclick="Procesar('resultado_login', 'login/ingresar', [$('#usuario').val(), $('#contrasena').val()]);return false;">Entrar</button>
      <!-- como redirigir a la vista de registro -->
      <a class="btn btn-lg btn-success btn-block" type="button" onclick="Procesar('resultado_login', 'dueño/modal_dueño_crear', []);return false;">Registrarse Dueño</a>
      <button class="btn btn-lg btn-success btn-block" type="button" onclick="Procesar('resultado_login', 'procesarindex/entrar', []);return false;">Registrarse Guardian</button>
    </div>
</div>
</form>