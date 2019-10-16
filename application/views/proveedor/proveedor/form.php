<div class="well well-sm">
	<?= $form->fopen; ?>

		<div class="form-group form-group-sm">

			<div class="col-sm-11 col-sm-offset-1">
				<h4 class="remove-margin">
					<strong>
						
						<?php if (!empty($proveedor)): ?>
							Editando proveedor
						<?php else: ?>	
							Nuevo Proveedor
						<?php endif ?>

					</strong>

					<?php if (isset($modal) && !$modal): ?>
						<button type="button" class="close" onclick="closeProvForm()">&times;</button>
					<?php endif ?>

				</h4>
			</div>

		</div>

		<div class="form-group form-group-sm">

			<?= $form->label_nit; ?>
			<div class="col-sm-4">
				<?= $form->input_nit; ?>
			</div>

			<?= $form->label_nombre; ?>
			<div class="col-sm-4">
				<?= $form->input_nombre; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">

			<?= $form->label_razon_social; ?>
			<div class="col-sm-4">
				<?= $form->input_razon_social; ?>
			</div>

			<?= $form->label_direccion; ?>
			<div class="col-sm-4">
				<?= $form->input_direccion; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">

			<?= $form->label_telefono; ?>
			<div class="col-sm-4">
				<?= $form->input_telefono; ?>
			</div>

			<?= $form->label_contacto; ?>
			<div class="col-sm-4">
				<?= $form->input_contacto; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">

			<?= $form->label_credito_contado; ?>
			<div class="col-sm-4">
				<?= $form->select_credito_contado; ?>
			</div>

			<?= $form->label_dias_credito; ?>
			<div class="col-sm-4">
				<?= $form->input_dias_credito; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">

			<?= $form->label_proveedor_tipo; ?>
			<div class="col-sm-4">
				<?= $form->select_proveedor_tipo; ?>
			</div>

			<?= $form->label_proveedor_clasificacion; ?>
			<div class="col-sm-4">
				<?= $form->select_proveedor_clasificacion; ?>
			</div>

		</div>
		<div class="form-group form-group-sm">
			<div class="col-sm-12 text-right">
				<?= $form->boton_guardarProv; ?>
				<?= $form->boton_cancelar; ?>
			</div>
		</div>

	<?= $form->fclose; ?>
</div>