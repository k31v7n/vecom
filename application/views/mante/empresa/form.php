<div class="well well-sm remove-radio">
	<?= $form->fopen; ?>
	
	<div class="form-group form-group-sm">
		<div class="col-sm-offset-2 col-sm-10">
			<h4 class="remove-margin">
				<?php if (!empty($empresa)): ?>
					Actualización de Empresa
				<?php else: ?>
					Registro de Nueva Empresa
				<?php endif ?>
				<button type="button" class="close" onclick="closeManteForm()">&times;</button>
			</h4>
		</div>
	</div>
	
	<div class="form-group form-group-sm">
		<?= $form->label_nombre; ?>
		<div class="col-sm-6">
			<?= $form->input_nombre; ?>
		</div>

		<?= $form->label_pais_empresa; ?>
		<div class="col-sm-3">
			<?= $form->select_pais_empresa; ?>
		</div>
	</div>

	<div class="form-group form-group-sm">
		<?= $form->label_direccion; ?>
		<div class="col-sm-6">
			<?= $form->input_direccion; ?>
		</div>

		<?= $form->label_moneda; ?>
		<div class="col-sm-3">
			<?= $form->select_moneda; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">
		<?= $form->label_representante; ?>
		<div class="col-sm-6">
			<?= $form->input_representante; ?>
		</div>
		
		<?= $form->label_nit; ?>
		<div class="col-sm-3">
			<?= $form->input_nit; ?>
		</div>
	</div>

	<div class="form-group form-group-sm">
		<?= $form->label_abreviatura; ?>
		<div class="col-sm-6">
			<?= $form->input_abreviatura; ?>
		</div>

		<?= $form->label_telefono; ?>
		<div class="col-sm-3">
			<?= $form->input_telefono; ?>
		</div>
	</div>

	<div class="form-group form-group-sm">
		<div class="col-sm-offset-2 col-sm-6">
				<label class="checkbox-inline"><?= $form->input_aplica_iva?> Aplicar IVA</label>
				<label class="checkbox-inline"><?= $form->input_activo?> Empresa activo</label>
		</div>
		<div class="col-sm-4 text-right">
			<?= $form->boton_btnMante; ?>
		</div>
	</div>
	
	<?= $form->fclose; ?>
</div>
