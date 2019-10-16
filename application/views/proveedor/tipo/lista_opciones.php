<option value="">---------------</option>
<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<option 
			value="<?= $row->proveedor_tipo; ?>"
			<?= ($row->proveedor_tipo==$tipo)?"selected":""; ?>
		>
			<?= $row->nombre; ?>
		</option>
	<?php endforeach ?>
<?php endif ?>