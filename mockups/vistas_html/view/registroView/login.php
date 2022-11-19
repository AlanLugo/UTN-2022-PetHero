<?php include("../includes/head.php") ?>


<main class="d-flex align-items-center justify-content-center height-100 pagLogin">
     <div class="content">
          <header class="text-center">
               <h2>Iniciar secion</h2>
          </header>

          <form action="" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" name="username" class="form-control form-control-lg" placeholder="Ingresar usuario">
               </div>
               <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña">
               </div>
               <button class="btn btn-primary btn-block btn-lg mt-3" type="submit">Iniciar Sesión</button>
          </form>
     </div>
</main>

<?php include("../includes/footer.php") ?>