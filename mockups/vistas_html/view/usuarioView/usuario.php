<?php include("../includes/head.php") ?>
<?php include("../includes/nav.php") ?>
<link rel="stylesheet" href="../styles/styles.css">

<div class="pagUsuario">
<div class=" container" >
<h1> ver mascotas aca</h1>
<h2 >crear elminar y modificar mascota aca </h2>
<h3>hacer una table que englobe tanto las vistas como los botones</h3>
<div class="p-3">

<div class="card mt-3 bg-light " style="width: 18rem;">
<form action="./editarMascota.php">
  <img src="..." class="card-img-top p-2" alt="aca la img">
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <button type="submit"  class="mt-3 btn btn-info">editar mascota</button>
    <a  class="mt-3 btn btn-danger">borrar mascota</a>
</form>
</div>
</div>

<a class="btn btn-success mt-2" href="./agregarMascota.php">agregar mascota</a>
</div>
</div>
</div>

<?php include("../includes/footer.php") ?>
