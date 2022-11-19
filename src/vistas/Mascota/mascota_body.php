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
     </div>
   </a>
 </div>
 <div class="card-body">
   <div class="lead"><span class="h2"><?php echo $Mascota->getNombre();?></span></div>
   <ul class="details">
     <li> Raza : <?php echo $Mascota->getId_raza_mascota()->getNombre();?></li>
     <li> Tamaño : <?php echo $Mascota->getId_tamaño_mascota()->getNombre();?></li>
     <li><?php echo $Mascota->getObservaciones();?></li>
   </ul>
    <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modal_editar_mascota" onclick="Procesar('modal_editar_mascota','mascota/modal_mascota_modificar',['<?php echo $Mascota->getId_Mascota();?>']);return false;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
  </button> 

  <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#modal_eliminar_confirmacion" onclick="Procesar('modal_eliminar_confirmacion','mascota/eliminar_mascota_confirmacion',['<?php echo $Mascota->getId_Mascota();?>']);return false;"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
  </button>
  </div>
  
</div>
    </div>
<?php
}
?>