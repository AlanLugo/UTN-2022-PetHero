<?php include("../includes/head.php") ?>
<?php include("../includes/nav.php") ?>
<link rel="stylesheet" href="../styles/styles.css">

<div class="pagUsuario">
  <div class=" container">
    <h1 class="pt-3">Tus mascotas</h1>

    <!-- for ech de todos las mascotas de x usuario -->
    <table class="table table-bordered ">
      <thead>
        <tr>
          <th>nombre</th>
          <th>raza</th>
          <th>tamaño</th>
          <th>observaciones</th>
        </tr>
      </thead>
      <tbody>
        <!--aca va el while donde se impre todos los valores de los perros -->
        <tr>
          <td>1</td>
          <td>2</td>
          <td>3</td>
          <td>4</td>
          <!--botones -->
          <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal2">
              Editar Mascota
            </button>
            <a class=" btn btn-danger">borrar mascota</a>

          </td>
        </tr>
      </tbody>
    </table>
    <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#Modal1">
      Agregar Mascota
    </button>


    <!-- Modal1 -->
    <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php include("../includes/formMascota.php") ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
            <form action="./index.php">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- Button trigger modal -->


<!-- Modal2 -->
<div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php include("../includes/formMascota.php") ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
        <a href="./index.php" class="btn btn-primary">Guardar Cambios</a>

      </div>
    </div>
  </div>
</div>

<?php include("../includes/footer.php") ?>