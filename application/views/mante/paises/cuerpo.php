<div class="panel panel-default remove-radio">
	<div class="panel-body">
		<h2 class="remove-margin">
			<i class="fa fa-building"></i> 
			Control de Paises de Empresa |
			<button class="btn btn-xs btn-default" onclick="abrirPaginaMante({tipo:3, forma:1})">
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
						<th class="text-center">Código País</th>
						<th class="text-center">Código Postal</th>
						<th class="text-center">Valor IVA</th>
					</tr>
				</thead>
				<tbody id='contenidoManteLista'>
					<?php $this->load->view('mante/paises/lista'); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>