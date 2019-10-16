<div class="well well-sm">
		<?= $form->fopen; ?>
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
				
				<?= $form->label_direccion; ?>	
				<div class="col-sm-4">
					<?= $form->input_direccion; ?>
				</div>

				<?= $form->label_telefono; ?>
				<div class="col-sm-4">
					<?= $form->input_telefono; ?>
				</div>

			</div>

			<div class="form-group form-group-sm">
				<?= $form->label_correo; ?>
				<div class="col-sm-4">
					<?= $form->input_correo; ?>
				</div>

				<?= $form->label_cliente_tipo; ?>
				<div class="col-sm-4">
					<?= $form->select_cliente_tipo; ?>
				</div>
			</div>

			<div class="form-group form-group-sm">
				<?= $form->label_aplica_descuento; ?>
				<div class="col-sm-3">
					<?= $form->check_aplica_descuento; ?>
				</div>

				<?= $form->label_monto_descuento; ?>
				<div class="col-sm-4">
					<?= $form->input_monto_descuento; ?>
				</div>
			</div>

			<div class="form-group form-group-sm">				
				<?= $form->label_aplica_iva; ?>
				<div class="col-sm-3">
					<?= $form->check_aplica_iva; ?>
				</div>
				<div class="col-sm-3 col-sm-offset-3">
					<?= $form->boton_btnGuardar; ?>
					<?= $form->boton_btnCancelar; ?>
				</div>
			</div>

		<?= $form->fclose; ?>
</div>