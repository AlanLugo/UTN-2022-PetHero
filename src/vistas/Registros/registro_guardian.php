<!--    
    protected $id_guardian;
    protected $nombre;
    protected $direccion;
    protected $cuil;
    protected $disponibilidad;
    protected $precio;
    protected $tamaño_maximo;
    protected $raza_dia;
    protected $id_cuenta; 
            -->
            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Nombre</label>
                <input class="form-control" id="alta_guardian_nombre" placeholder="Ingrese un nombre" type="text" required>
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Direccion</label>
                <input class="form-control" id="alta_guardian_direccion" placeholder="Ingrese una direccion" type="text" required>
            </div>
            
            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Cuil</label>
                <input class="form-control" id="alta_guardian_cuil" placeholder="Ingrese un Cuil" type="text" required>
            </div>
            
            <!--ACA SE SETEA LA DISPONIBILIDAD -->

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Precio estimado</label>
                <input class="form-control" id="alta_guardian_precio_estimado" placeholder="Ingrese un precio estimado" type="number" required>
            </div>

            <div class="form-group">
                <label class="control-label">Tamaño mascota preferencia</label>
                    <select class="form-control" id="alta_guardian_tamaño_mascota" placeholder="Seleccione un tamaño" required>
                        <option>Vacio</option>
                        <option>Chico</option>
                        <option>Mediano</option>
                        <option>Grande</option>
                    </select>    
            </div>

            <div class="form-group">
                <label class="control-label"
                for="inputEmail3">Raza dia</label>
                <input class="form-control" id="alta_guardian_raza_dia" placeholder="Ingrese una raza" type="text" required>
            </div>

