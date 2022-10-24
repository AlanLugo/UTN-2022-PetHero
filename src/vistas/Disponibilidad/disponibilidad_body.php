<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>

<?php

foreach($Disponibilidades as $Disponibilidad){
?>
   
  <tbody>
    <tr>
      <th scope="row"><?php echo $Disponibilidad->getId_Disponible()?></th>
      <td><?php echo $Disponibilidad->getFechaInicio()?></td>
      <td><?php echo $Disponibilidad->getFechaFinal()?></td>
      <td><?php echo $Disponibilidad->getDisponible()?></td>
    </tr>
  </tbody>
</table>

<?php
}
?>