<?php if ($lista): ?>
	<?php $total = 0; ?>
	<?php foreach ($lista as $key => $value): ?>
		<tr>
			<td><?php echo $value->venta; ?></td>
			<td class="text-center"><?php echo FormatoFecha($value->fecha,1); ?></td>
			<td><?php echo $value->cliente_nombre; ?></td>
			<td><?php echo $value->cliente_nit; ?></td>
			<td class="text-center"><?php echo $value->estatus; ?></td>
			<td><?php echo $value->usuario; ?></td>
			<td class="text-center"><?php echo $value->nombre_moneda; ?></td>
			<td class="text-right"><?php echo number_format($value->monto, 2); ?></td>
		</tr>

		<?php $total += $value->monto; ?>

	<?php endforeach ?>

	<tr class="bg-info">
		<th class="text-right" colspan="7">TOTAL:</th>
		<th class="text-right"><?php echo $total; ?></th>
	</tr>

<?php endif ?>