<?php
foreach($Mascotas as $Mascota){
?>
    <div class="col-sm-4">
   
    <div class="card card-price">
  <div class="card-img">
    <a href="#">
      <img src="<?php echo $Mascota->getImagen();?>" class="img-responsive">
      <div class="card-caption">
        <span class="h2"><?php echo $Mascota->getNombre();?></span>
        <p>100% silk</p>
      </div>
    </a>
  </div>
  <div class="card-body">
    <div class="price">$20 <small>each</small></div>
    <div class="lead">Wrap yourself in luxury</div>
    <ul class="details">
      <li>A stitch in time saves nine.</li>
      <li>All good things come to those who wait.</li>
      <li><b>Shipping:</b> $10 in USA, $15 outside USA</li>
    </ul>
    <a href="#" class="btn btn-primary btn-lg btn-block buy-now">
      Buy now <span class="glyphicon glyphicon-triangle-right"></span>
    </a>
  </div>
</div>
    </div>
<?php
}
?>