<?php include("../includes/head.php") ?>
<?php include("../includes/navKeeper.php") ?>
<!-- aca mostramos el perfil del keeper -->

<div class="container">


    <body class="keeperPag">
        <main class="pt-4">
            <div class="card mb-4 bg-light" style="min-width: 500px; min-height: 440px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="../img/logo-pethero.png" class="p-5 img-fluid rounded-start" alt="imagen del keeper">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-3">
                            <h5 class="card-title">Nombre del keeper</h5>
                            <p class="card-text">direccion</p>
                            <p class="card-text">cuil</p>
                            <p class="card-text">disponibilidad</p>
                            <p class="card-text">precio</p>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
               
                <div class="d-grid gap-2 col-6 mx-auto">

                <button type="button" class="m-5 btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#ModalKeeper">
                    Editar Perfil
                </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="ModalKeeper" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php include("../includes/formKeeper.php") ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                                <a href="./index.php" class="btn btn-primary">Guardar Cambios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>




</div>







<?php include("../includes/footer.php") ?>