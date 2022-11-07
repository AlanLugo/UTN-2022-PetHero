<?php
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
      <li> Raza : <?php echo $Mascota->getRaza();?></li>
      <li> Tamaño : <?php echo $Mascota->getTamaño();?></li>
      <li><?php echo $Mascota->getObservaciones();?></li>
    </ul>
    
<!--buscar implementar modals -->
    <button type="button" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modal_alta_pedido_sucursal" onclick="Procesar('modal_alta_pedido_sucursal','Mascota/alta_pedido_forma_entrega',[]);return false;"modal-body-alta-pedido>
                    Editar
    </button></td>

    <button class="btn btn-danger btn-lg btn-block">borrar</button>

            
  </div>
</div>
    </div>
<?php
}
?>