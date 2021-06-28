<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Reporte de ventas</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->

		<form class="navbar-form navbar-left" id="formBuscar" onsubmit="return buscar(this);">
			<div class="form-group">
				<input type="date" name="fdel" class="form-control" required>
				<input type="date" name="fal" class="form-control" required>
				<select name="estatus" class="form-control">
					<option value="">Seleccione un estatus</option>
					<?php foreach ($estatus as $key => $value): ?>
						<option value="<?php echo $value->venta_estatus ?>"><?php echo $value->nombre; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<button type="submit" class="btn btn-success">
				<i class="glyphicon glyphicon-search"></i>
			</button>
		</form>
	</div><!-- /.navbar-collapse -->
</nav>


<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsivex">
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr class="bg-warning">
						<th class="text-center"># Venta</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Cliente</th>
						<th class="text-center">NIT</th>
						<th class="text-center">Estatus</th>
						<th class="text-center">Vendedor</th>
						<th class="text-center">Moneda</th>
						<th class="text-center">Monto</th>
					</tr>
				</thead>
				<tbody id="contenidoReporte"></tbody>
			</table>
		</div>
	</div>
</div>


<script>
	function buscar(e) {
		
		var data = new FormData(e);
		var url  = base_url('index.php/reporte/buscar')
		var xhr = new XMLHttpRequest()
		vercargando('contenidoReporte', 2);

		xhr.open("POST", url, true)
		xhr.onload= function() {
			document.getElementById('contenidoReporte').innerHTML = this.responseText
		}
		xhr.send(data)
		return false;
	}
</script>