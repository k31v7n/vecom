<?php if (isset($lista) && $lista): ?>
	<?php foreach ($lista as $key => $row): ?>
		<tr>
			<td class="text-center" width="25px"><?= $key+1; ?></td>
			<td class="text-left">
				<a href="javascript:;" 
					onclick="abrirPaginaMante({tipo:3, ide:<?= $row->pais_empresa; ?>, forma:1})">
					<?= $row->nombre; ?> <small class="text-muted">(<?= ($row->activo == 1) ? 'Activo' : 'Inactivo';?>)</small>
				</a>
			</td>
			<td class="text-center"><?= $row->codigo; ?></td>
			<td class="text-left"><?= $row->codigo_postal; ?></td>
			<td class="text-center"><?= $row->iva; ?></td>
		</tr>
	<?php endforeach ?>
<?php endif ?>