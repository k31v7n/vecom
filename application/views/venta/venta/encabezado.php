<div class="table-responsivex">
	<table class="table table-striped" style="margin-bottom: 0px;">
		<thead>
			<tr>
				<th colspan="100%" class="text-center">
					Venta #<?= (elemento($venta, "venta"))? $venta->venta: ""; ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th width="75px">Cliente</th>
			
				<td colspan="3"><?= (elemento($venta, "cliente_nombre"))? $venta->cliente_nombre: ""; ?></td>
			</tr>
			<tr>
				<th>Moneda</th>
				<td><?= (elemento($venta, "nombre_moneda"))? $venta->nombre_moneda." ({$venta->codigo_moneda})": ""; ?></td>

				<th>Pago</th>
				<td><?= (elemento($venta, "nombre_tipo_pago"))? $venta->nombre_tipo_pago: ""; ?></td>
			</tr>
			<tr>
				<th>Total</th>
				<th 
					colspan="3" 
					class="text-right"
				>
					<?= number_format(
						((elemento($venta, "monto"))? $venta->monto: "0"), 
						2
					); ?>
				</th>
			</tr>
			<tr>
				<th>Concepto</th>
				<td colspan="3"><?= (elemento($venta, "concepto"))? $venta->concepto: ""; ?></td>
			</tr>

			
		</tbody>
	</table>
</div>
<?php if (isset($venta) && $venta): ?>
	
	<div class="col-sm-6 btn-encabezado">
		<a 
			href    = "javascript:;" 
			onclick = "CompletarVenta(<?= $venta->venta; ?>)" 
			class   = "btn btn-primary btn-sm col-sm-12 remove-radio"
			style   = "width: 100%;"

		>
			<i class="fa fa-check"></i> Completar Venta
		</a>
	</div>

	<div class="col-sm-6 btn-encabezado">
		<a 
			href 	= "javascript:;" 
			onclick = "AnularVenta(<?= $venta->venta; ?>)" 
			class 	= "btn btn-danger btn-sm col-sm-12 remove-radio"
			style   = "width: 100%;"
		>
			<i class="fa fa-times"></i> Anular Venta
		</a>
	</div>

<?php else: ?>

	<div class="col-sm-12 btn-encabezado">
		<a 
			href    = "javascript:;" 
			onclick = "CrearNuevaVenta()" 
			class   = "btn btn-primary btn-sm col-sm-12 remove-radio"
			style   = "width: 100%;"
		>
			<i class="fa fa-plus"></i> Crear Venta
		</a>
	</div>
<?php endif ?>