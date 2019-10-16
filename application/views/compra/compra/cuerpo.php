<div class="panel panel-default remove-radio">
	<div class="panel-heading">
		
		<h3 class="remove-margin">
			<i class="fa fa-cart-arrow-down"></i> 
			Control de Compras

			<div class="pull-right">
				
				<button class="btn btn-xs btn-default" onclick="OpenFCompra()">
					<i class="fa fa-plus"></i> Nuevo
				</button>
				<button class="btn btn-xs btn-primary" onclick="OpenFProveedor()">
					<i class="fa fa-plus"></i> Proveedor
				</button>

			</div>
			
		</h3>
	</div>
	
	<div class="panel-body">
		<div id="ContenidoFCompra"></div>

		<div class="table-responsivex" id="ListaCompras">
			<table class="table table-bordered table-hover">
				<thead>
					<tr style="background: #eeeeee;">
						<th class="text-center">Fecha</th>
						<th class="text-center">Serie</th>
						<th class="text-center">Numero</th>
						<th class="text-center">Concepto</th>
						<th class="text-center" width="130px">Fecha de pago</th>
						<th class="text-center">Proveedor</th>
						<th class="text-center">Estatus</th>
						<th class="text-center">Tipo de pago</th>
						<th width="25px"></th>
					</tr>
				</thead>
				<tbody id='contenidoComprasLista'></tbody>
			</table>
		</div>
	</div>
</div>