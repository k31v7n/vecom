<option value="">---------------</option>
<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<option 
			value="<?= $row->cliente; ?>" 
			<?= ($row->cliente==$id)?'selected':'' ?>
		>
			<?= $row->nombre; ?>
		</option>
	<?php endforeach ?>
<?php endif ?>