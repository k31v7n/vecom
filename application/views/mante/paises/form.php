<div class="well well-sm remove-radio remove-margin">
	<?= $form->fopen; ?>

		<div class="form-group form-group-sm">
			<div class="col-sm-offset-3 col-sm-9">
				<h4 class="remove-margin">
					<?php if (!empty($pais)): ?>
						Actualización de País
					<?php else: ?>
						Registro de Nuevo País
					<?php endif ?>

					<?php if ($tipo == 1): ?>
						<button type="button" class="close" onclick="closeManteForm()">&times;</button>	
					<?php endif ?>
				</h4>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?= $form->label_nombre; ?>	
			<div class="col-sm-9"><?= $form->input_nombre; ?></div>
		</div>

		<div class="form-group form-group-sm">
			<?= $form->label_codigo; ?>	
			<div class="col-sm-9"><?= $form->input_codigo; ?></div>
		</div>

		<div class="form-group form-group-sm">
			<?= $form->label_codigo_postal; ?>	
			<div class="col-sm-9"><?= $form->input_codigo_postal; ?></div>
		</div>

		<div class="form-group form-group-sm">
			<?= $form->label_iva; ?>	
			<div class="col-sm-9"><?= $form->input_iva; ?></div>
		</div>

		<div class="form-group form-group-sm">	
			<div class="col-sm-offset-3 col-sm-3">
				<label class="checkbox-inline"><?= $form->input_activo; ?> Activo</label>
			</div>
			<div class="col-sm-6 text-right"><?= $form->boton_btnMante; ?></div>
		</div>

	<?= $form->fclose; ?>
</div>