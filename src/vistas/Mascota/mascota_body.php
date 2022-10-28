<?php

use modelos\Mascota\Mascota;

foreach($Mascotas as $Mascota){
?>
    <div class="col-sm-4">
   
    <div class="card card-price">
  <div class="card-img">
    <a href="#">
      <img src="<?php echo $Mascota->getImagen();?>" class="img-responsive">
      <div class="card-caption">
        <span class="h2"><?php echo $Mascota->getNombre();?></span>
        <p><?php echo $Mascota->getRaza()?> </p>
      </div>
    </a>
  </div>
  <div class="card-body">
    <div class="price"><?php echo $Mascota->getTamaño() ?> <small></small></div>
    <div class="lead">Observaciones
      <?php //arreglar observaciones no las muestra ?>Z
      <p><?php echo $Mascota->getObservaciones()?></p>
  </div>
    <a href="#" class="btn btn-primary btn-lg btn-block buy-now">
      Buy now <span class="glyphicon glyphicon-triangle-right"></span>
    </a>
    <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_editar_mascota" onclick="Procesar('modal_editar_mascota','mascota/modal_mascota_modificar',['<?php echo $Mascota->getId_Mascota();?>']);return false;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
  </button> 

  <button type="button" class="btn btn-default btn-sm"  aria-label="Left Align" data-toggle="modal" data-target="#modal_eliminar_confirmacion" onclick="Procesar('modal_eliminar_confirmacion','mascota/eliminar_mascota_confirmacion',['<?php echo $Mascota->getId_Mascota();?>']);return false;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
  </button>
  </div>
  
</div>
    </div>
<?php
}
?>