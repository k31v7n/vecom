<div class="well well-sm">
	<?= $form->fopen; ?>

		<div class="form-group form-group-sm">
			<div class="col-sm-offset-1 col-sm-11">

				<h4 class="remove-margin">
					<strong>
						
						<?php if (!empty($producto)): ?>
							Actualización de Producto
						<?php else: ?>
							Registro de Producto
						<?php endif ?>

					</strong>
					<button type="button" class="close" onclick="closeProdForm()">&times;</button>
				</h4>

			</div>
		</div>
		
		<div class="form-group form-group-sm">

			<?= $form->label_codigo; ?>
			<div class="col-sm-4">
				<?= $form->input_codigo; ?>
			</div>

			<?= $form->label_nombre; ?>
			<div class="col-sm-4">
				<?= $form->input_nombre; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">
			
			<?= $form->label_proveedor; ?>
			<div class="col-sm-4">
				<?= $form->select_proveedor; ?>
			</div>

			<?= $form->label_unidad_medida; ?>
			<div class="col-sm-4">
				<?= $form->select_unidad_medida; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">
			
			<?= $form->label_producto_tipo; ?>
			<div class="col-sm-4">
				<?= $form->select_producto_tipo; ?>
			</div>

			<?= $form->label_precio_compra; ?>
			<div class="col-sm-4">
				<?= $form->input_precio_compra; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">
			
			<?= $form->label_precio_venta; ?>
			<div class="col-sm-4">
				<?= $form->input_precio_venta; ?>
			</div>

			<?= $form->label_incluye_iva; ?>
			<div class="col-sm-1">
				<?= $form->check_incluye_iva; ?>
			</div>
			<?= $form->label_valor_iva; ?>
			<div class="col-sm-2">
				<?= $form->input_valor_iva; ?>
			</div>


		</div>

		<div class="form-group form-group-sm">

			<?= $form->label_fecha_ingreso; ?>
			<div class="col-sm-4">
				<?= $form->input_fecha_ingreso; ?>
			</div>

			<?= $form->label_fecha_vencimiento; ?>
			<div class="col-sm-4">
				<?= $form->input_fecha_vencimiento; ?>
			</div>

		</div>

		<div class="form-group form-group-sm">

			<?= $form->label_imagen; ?>
			<div class="col-sm-4">
				<?= $form->input_imagen; ?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<div class="col-sm-12 text-right">
				<?= $form->boton_guardarProd; ?>
				<?= $form->boton_cancelar; ?>
			</div>
		</div>

	<?= $form->fclose; ?>
</div>