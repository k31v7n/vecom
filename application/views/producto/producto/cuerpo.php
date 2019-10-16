<div class="panel panel-default remove-radio">
	<div class="panel-heading">
		
		<h3 class="remove-margin">

			<i class="fa fa-box"></i> 
			Control de Productos 

			<div class="pull-right">
				
				<button class="btn btn-xs btn-default" onclick="openFProducto()">
					<i class="fa fa-plus"></i> Nuevo
				</button>

				<button class="btn btn-xs btn-primary" onclick="OpenFProveedor()">
					<i class="fa fa-plus"></i> Proveedor
				</button>

				<button class="btn btn-xs btn-success" onclick="OpenFTipo()">
					<i class="fa fa-plus"></i> Tipo de producto
				</button>
				
			</div>

		</h3>
		
	</div>

	<div class="panel-body">
		<div id="contenidoFProd"></div>

		<div class="table-responsivex" id="ListaProd">
			<table class="table table-bordered table-hover">
				<thead>
					<tr style="background: #eeeeee;">
						<th class="text-center">Código</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Cantidad</th>
						<th class="text-center">Medida</th>
						<th class="text-center">Tipo</th>
						<th class="text-center">Precio Compra</th>
						<th class="text-center">Precio Venta</th>
						<th class="text-center">Fecha Ingreso</th>
						<th class="text-center">Fecha Vencimiento</th>
						<th></th>
					</tr>
				</thead>
				<tbody id='contenidoProdLista'></tbody>
			</table>
		</div>
	</div>
</div>