<style>
	.margin-bootom-sm {
		margin-top: 60px;

	}
	

</style>
<div class="row">
	<div class="col-md-12">
	<a href="#" onclick="Procesar('contenido','procesarindex/salir',[]);return false;"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Salir</a>
<nav class="navbar navbar-inverse navbar-fixed-top" data-target="#bs-example-navbar-collapse-3">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Menu</a>
	</div>


	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="#" data-toggle="modal" onclick="Procesar('contenido','procesarindex/index',[]);return false;"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Mis Pedidos</a></li>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <?php echo $Cliente->getId_Cuenta()->getUsuario();?></a></li>

			<li><a><span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> <?php echo $Cliente->getId_Cuenta()->getRol();?> </a></li>
			
			<li><a href="#" onclick="Procesar('contenido','procesarindex/salir',[]);return false;"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Salir</a></li><li><a></a></li>
		</ul>

	</div>

</nav>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
	<div class="margin-bootom-sm" id="body-panel-cliente">
		<script type="text/javascript">
			Procesar('body-panel-cliente','pedido/listar_pedidos_cliente',[<?php echo $Cliente->getId_Cliente();?>]);
		</script>
	</div>
		
	</div>
</div>
<?php include("modals.php");?>