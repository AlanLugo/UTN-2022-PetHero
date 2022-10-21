<?php
namespace modelos\Auxiliar;
class JS_EN_PHP
{
	
	public function __construct()
	{

		$args = func_get_args();
		$nargs = func_num_args();
		switch($nargs)
		{ 
		case 1:
			self::__construct1($args[0]);
		break;
		}	
	}
	function __construct1($js='')
	{
		$this->ejecutar($js);
	}
	public function ejecutar($funcion='')
	{
		?>
			<script type="text/javascript">
				<?php echo $funcion;?>
			</script>
		<?php		
	}

	public function limpiar($div='',$contenido)
	{
		?>
			<script type="text/javascript">
				$("#<?php echo $div;?>").html('<?php echo $contenido;?>');
			</script>
		<?php		
	}

	
} 
