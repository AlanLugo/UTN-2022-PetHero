<?php
namespace controladoras;
/**
* 
*/
class ProcesarindexControlador
{
	function __construct()
	{
		
	}
/*
	===============================================================================
				Funcion index, carga la vista por defecto de la web, utiliza la funcion Procesar para iniciar el login, o si tiene una sesion
				lo redirecciona.
	===============================================================================
*/	
	public function index()
	{
		require("../vistas/index.php");

		if(isset($_SESSION['Guardian']))
		{			
			?><script type="text/javascript">
			Procesar('contenido','procesarindex/inicio',[]);
			</script><?php				
		}
		elseif(isset($_SESSION['Cliente']))
		{			
			?><script type="text/javascript">
			Procesar('contenido','procesarindex/inicio',[]);
			</script><?php				
		}
		else
		{
			?><script type="text/javascript">
			Procesar('contenido','procesarindex/login',[]);
			</script><?php
		}
	}

	public function login()
	{
			
		include("../vistas/Login/login.php");
	}

	public function inicio()
	{		
		if(isset($_SESSION['Guardian']))
		{

			$Guardian = unserialize($_SESSION['Guardian']);
			include("../vistas/Guardian/index.php");
		}
		elseif(isset($_SESSION['Dueño']))
		{
			$Dueño = unserialize($_SESSION['Dueño']);
			include("../vistas/Dueño/index.php");
		}			
		else
		{
			include("../vistas/Login/login.php");
		}		
	}
	
/*
	===============================================================================
								Elimina la Session existente
	===============================================================================
*/			
	public function salir()
	{		
		header("Cache-Control: private");
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
		?>
		<script>
		location.reload(true);
		</script>
		<?php

	}

	public function eliminar_modales()
	{
		?>
		<script type="text/javascript">
		$('#modal_confirmacion').modal('hide'); 

		setTimeout(function() {
	    // needs to be in a timeout because we wait for BG to leave
    	// keep class modal-open to body so users can scroll
    	$('body').removeClass('modal-open');
		}, 400);
		</script>
		<?php
	}
}


