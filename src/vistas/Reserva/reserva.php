

<div class="row" id="tabla_reserva">
  <div class="col-md-12 col-md-offset-0">
    <div class="panel panel-default">
      <div class="panel-heading"><h2>Mis Reservas      
      <div class="panel-body">
        <div class="col-md-7">

        <?php
          if($Reservas!=NULL)
          {
            include("lista_reserva.php");
          }
          ?>
        </div>
                  
        <div class="col-md-5" id="tabla_reserva_body"  style="padding-top:75px;">
        <?php
        include("reserva_body.php");
        ?>
        </div>
      </div>
      
    </div>
  </div>
</div>