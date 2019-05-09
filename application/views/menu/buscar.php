<ul class="vc-menu-ul">
	<?php if (isset($opciones) && $opciones): ?>

		<?php foreach ($opciones as $key => $row): ?>
			<li>
				<a href="<?= base_url("{$row->url}"); ?>">
					<?= "{$row->icono} {$row->nombre}"; ?>
				</a>
			</li>
		<?php endforeach ?>

	<?php else: ?>

		<li>
			<a href="javascript:;">
				<small>Sin resultados</small>
			</a>
		</li>

	<?php endif ?>
</ul>