<div class="panel panel-default remove-radio">
	<div class="panel-heading">
		<h3 class="remove-margin">
			<i class="fa fa-users"></i> 
			Control de Proveedores
			<div class="pull-right">
				
				<button class="btn btn-xs btn-default" onclick="openFProv()">
					<i class="fa fa-plus"></i> Nuevo
				</button>
				<button class="btn btn-xs btn-primary" onclick="openFclasificacion()">
					<i class="fa fa-plus"></i> Clasificacion
				</button>
				<button class="btn btn-xs btn-info" onclick="openFtipoProveedor()">
					<i class="fa fa-plus"></i> Tipo proveedor
				</button>
			</div>
		</h3>
	</div>
	
	<div class="panel-body">
		<div id="contenidoFProv"></div>

		<div class="table-responsivex" id="ListaProv">
			<table class="table table-bordered table-hover">
				<thead>
					<tr style="background: #eeeeee;">
						<th class="text-center">Nit</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Razon Social</th>
						<th class="text-center">Dirección</th>
						<th class="text-center">Teléfono</th>
						<th class="text-center">Contacto</th>
						<th class="text-center">Tipo Proveedor</th>
						<th class="text-center">Clasificación</th>
						<th></th>
					</tr>
				</thead>
				<tbody id='contenidoProvLista'>
					<?php $this->load->view('proveedor/proveedor/lista'); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>