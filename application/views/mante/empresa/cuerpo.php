<div class="panel panel-default remove-radio">
	<div class="panel-body">
		<h2 class="remove-margin">
			<i class="fa fa-building"></i> 
			Control de Empresas	|
			<button class="btn btn-xs btn-default" onclick="abrirPaginaMante({tipo:2})">
				<i class="fa fa-plus"></i> Nuevo
			</button>

			<button class="btn btn-xs btn-success" 
				onclick="abrirPaginaMante({tipo:3, modal:true, tamanio:2, titulo:'Agregar País', icono:'globe-americas', forma:2})">

				<i class="fa fa-plus"></i> Nuevo País
			</button>
		</h2>
		<hr>
		<div id="contenidoManteForm"></div>
		<div class="table-responsivex" id="ListaMante">
			<table class="table table-bordered table-hover">
				<thead>
					<tr style="background: #eeeeee;">
						<th class="text-center">#</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Abreviatura</th>
						<th class="text-center">Dirección</th>
						<th class="text-center">NIT</th>
						<th class="text-center">Teléfono</th>
						<th class="text-center">País</th>
						<th class="text-center">Moneda</th>
						<th class="text-center">Aplica IVA</th>
					</tr>
				</thead>
				<tbody id='contenidoManteLista'>
					<?php $this->load->view('mante/empresa/lista'); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>