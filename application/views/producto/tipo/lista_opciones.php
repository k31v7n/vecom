<option value="">----------</option>
<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<option 
			value = "<?= $row->producto_tipo; ?>"
			<?= ($row->producto_tipo==$tipo)?"selected":""; ?>

		>
			<?= $row->nombre; ?>
		</option>
	<?php endforeach ?>
<?php endif ?>