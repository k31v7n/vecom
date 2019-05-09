<div class="well well-sm remove-radio">
	<?= $form->fopen; ?>
	
	<div class="form-group form-group-sm">
		<div class="col-sm-offset-2 col-sm-10">
			<h4 class="remove-margin">
				<?php if (!empty($usuario)): ?>
					Actualización de ficha de usuario
				<?php else: ?>
					Nueva ficha de usuario
				<?php endif ?>
				<button type="button" class="close" onclick="closeManteForm()">&times;</button>
			</h4>
		</div>
	</div>
	<div class="form-group form-group-sm">
		<?= $form->label_nombre; ?>	
		<div class="col-sm-10"><?= $form->input_nombre; ?></div>
	</div>
		
	<div class="form-group form-group-sm">
		<?= $form->label_correo; ?>	
		<div class="col-sm-4"><?= $form->input_correo; ?></div>

		<?= $form->label_telefono; ?>	
		<div class="col-sm-4"><?= $form->input_telefono; ?></div>
	</div>

	<div class="form-group form-group-sm">
		<?= $form->label_alias; ?>	
		<div class="col-sm-4"><?= $form->input_alias; ?></div>

		<?= $form->label_password; ?>	
		<div class="col-sm-4">
			<div class="input-group">
				<?= $form->input_password; ?>
				<span class="input-group-btn">
			        <button class="btn btn-sm btn-default" id="bpnueva" type="button">
			        	<i class="fa fa-eye"></i>
			        </button>
			    </span>
			</div>
		</div>
	</div>
	
	<div class="form-group form-group-sm">
		<?= $form->label_identificacion; ?>	
		<div class="col-sm-4"><?= $form->input_identificacion; ?></div>

		<?= $form->label_direccion; ?>	
		<div class="col-sm-4"><?= $form->input_direccion; ?></div>
	</div>

	<div class="form-group form-group-sm">
		<?= $form->label_empresa; ?>	
		<div class="col-sm-4"><?= $form->select_empresa; ?></div>

		<?= $form->label_usuario_genero; ?>
		<div class="col-sm-4"><?= $form->select_usuario_genero; ?></div>
	</div>

	<div class="form-group form-group-sm">
		<div class="col-sm-offset-2 col-sm-4">
			<label class="checkbox-inline"><?= $form->input_jefe; ?> Jefe de Proceso</label>
			<label class="checkbox-inline"><?= $form->input_subjefe; ?> Subjefe de Proceso</label>
		</div>

		<?= $form->label_rol; ?>
		<div class="col-sm-4"><?= $form->select_rol; ?></div>
	</div>

	<div class="form-group form-group-sm">
		<div class="col-sm-12 text-right">
			<?= $form->boton_btnMante; ?>
		</div>
	</div>
	<?= $form->fclose; ?>
</div>
