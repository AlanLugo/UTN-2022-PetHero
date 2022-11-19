<div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirmacion</h4>
      </div>

      <div class="modal-body">
        <center><div id="Cargando_Consulta"></div></center>
        <div id="modal-body-conf-consulta"><p>Desea eliminar la disponibilidad?</p> </div> 

      </div>
      <div id="EnviarConsulta_ModalBody" align="center" ></div>
      <div class="modal-footer" id="footer_disponibilidad_confirmacion">
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" onclick="Procesar('modal-body-conf-consulta','disponibilidad/eliminar_disponibilidad',['<?php echo $Disponibilidad->getId_Disponibilidad();?>',]);">Si</button>
      </div>
    </div>
  </div>