<div class="panel panel-default remove-radio">
	<div class="panel-body">
		<h2 class="remove-margin">
			<i class="fa fa-user"></i> 
			Control de Usuarios	|
			<button class="btn btn-xs btn-default" onclick="abrirPaginaMante({tipo:1})">
				<i class="fa fa-plus"></i> Nuevo
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
						<th class="text-center">Alias</th>
						<th class="text-center">Correo</th>
						<th class="text-center">Teléfono</th>
						<th class="text-center">Dirección</th>
						<th class="text-center">Empresa</th>
						<th class="text-center">Cargo</th>
						<th class="text-center">Estatus</th>
						<td></td>
					</tr>
				</thead>
				<tbody id='contenidoManteLista'>
					<?php $this->load->view('mante/usuario/lista'); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>