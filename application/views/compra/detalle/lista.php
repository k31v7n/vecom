<?php if (isset($registros) && $registros): ?>

	<?php $cantidad_total = $precio_total = $total_general = 0; ?>

	<?php foreach ($registros as $row): ?>
		<tr 
			id="ContenifoFormDetalle<?= $row->compra_detalle?>" 
			ondblclick="
				FormDetalle({
					compra     : <?= $row->compra; ?>,
					detalle    : <?= $row->compra_detalle; ?>,
					contenedor : 'ContenifoFormDetalle<?= $row->compra_detalle?>',
					form 	   : 'FormGuardarDetalle<?= $row->compra_detalle?>'
				})
			"
		>

			<td><?= $row->codigo_producto; ?></td>
			<td><?= $row->producto_nombre; ?></td>

			<td class="text-center"><?= $row->cantidad; ?></td>
			<?php $cantidad_total += $row->cantidad; ?>

			<td class="text-right"><?= $row->precio; ?></td>
			<?php $precio_total += $row->precio; ?>

			<td class="text-right"><?= $row->total; ?></td>
			<?php $total_general += $row->total; ?>

			<td class="text-center">

				<a 
					href="javascript:;" 
					style="color: rgba(255,0,0,.7);" 
					onclick=""
				>
					<i class="glyphicon glyphicon-remove"></i>
				</a>

			</td>

		</tr>
	<?php endforeach ?>
		<tr>
			<th colspan="2">TOTAL</th>
			<th class="text-center"><?= number_format($cantidad_total, 2); ?></th>
			<th class="text-right"><?= number_format($precio_total, 2); ?></th>
			<th class="text-right"><?= number_format($total_general, 2); ?></th>
			<th></th>
		</tr>
<?php endif ?>