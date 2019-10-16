<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<option 
			value="<?= $row->proveedor_clasificacion; ?>"
			<?= ($row->proveedor_clasificacion==$clasificacion)?"selected":""; ?>
		>
			<?= $row->nombre; ?>
		</option>
	<?php endforeach ?>
<?php endif ?>