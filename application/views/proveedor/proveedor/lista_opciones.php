<option value="">----------</option>
<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<option 
			value = "<?= $row->proveedor; ?>"
			 <?= ($row->proveedor == $proveedor) ? "selected": ""; ?>
		>
			<?= $row->nombre; ?>
		</option>
	<?php endforeach ?>
<?php endif ?>