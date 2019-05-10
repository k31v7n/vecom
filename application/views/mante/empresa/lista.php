<?php if (isset($lista) && $lista): ?>
	<?php foreach ($lista as $key => $row): ?>
		<tr>
			<td class="text-center" width="25px"><?= $key+1; ?></td>
			<td class="text-left">
				<a href="javascript:;" 
					onclick="abrirPaginaMante({tipo:2, ide:<?= $row->empresa; ?>})">
					<?= $row->nombre; ?> <small class="text-muted">(<?= ($row->activo == 1) ? 'Activo' : 'Inactivo';?>)</small>
				</a>
			</td>
			<td class="text-center"><?= $row->abreviatura; ?></td>
			<td class="text-left"><?= $row->direccion; ?></td>
			<td class="text-center"><?= $row->nit; ?></td>
			<td class="text-center"><?= $row->telefono; ?></td>
			<td class="text-left"><?= $row->npais; ?></td>
			<td class="text-center"><?= $row->nmoneda; ?></td>
			<td class="text-center">
				<?php if ($row->aplica_iva == 1): ?>
					Si
				<?php else: ?>	
					No
				<?php endif ?>
			</td>
		</tr>
	<?php endforeach ?>
<?php endif ?>