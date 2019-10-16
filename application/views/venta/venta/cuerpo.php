<?= style_tag("public/css/venta.css", true); ?>
<?php if (!empty($mensaje)): ?>
	<script>var mensaje = "<?= $mensaje ?>"; </script>
<?php endif ?>
<div class="navbar navbar-default margin-bot-5 margin-top-5">
	<div class="container-fluid">

		<div class="navbar-header" >
			<a href="#" class="navbar-brand">
				<i class="fa fa-shopping-cart"></i> Ventas
			</a>
			<button type="button" class="navbar-toggle btn-xs" data-toggle="collapse" data-target="#myNavbar">
				<i class="fa fa-bars"></i>
			</button>
		</div>

		<div id="ListaVentasMenu">
			<?php $this->load->view('venta/venta/lista_menu'); ?>
		</div>

	</div>
</div>

<div class="row">	
	<div class="col-sm-5 scroll-auto" id="ContenedorVenta">

		<div class="panel panel-default remove-radio margin-bot-5">
			<div class="panel-body padding7" id="DatosEncabezado"></div>
		</div>
		
		<!-- Lista de productos agregados -->
		<div class="panel panel-default remove-radio margin-bot-5">
			<div class="panel-body padding7">

				<?php $this->load->view('venta/detalle/cuerpo'); ?>

			</div>
		</div>
		
	</div>

	<!-- Lista y formulario de busqueda de productos -->
	<div class="col-sm-7 padding-lr-0">
		<div class="panel panel-default remove-radio margin-bot-5 scroll-auto" id="DivProductos">
			<div class="panel-body padding7">
				<div class="col-sm-12">
					<?php $this->load->view($f_producto); ?>
				</div>

				
				<div id="ListaProductos">

				</div>

			</div>
		</div>
	</div>

</div>