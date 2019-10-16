<div class="well well-sm">
	<?= $form->fopen; ?>

	<div class="form-group form-group-sm">
		<div class="col-sm-11 col-sm-offset-1">
			<h4 class="remove-margin">

				<button class="close" type="button" onclick="CloseFCompra()" style="font-size: 15px;">
					<i class="fa fa-times"></i>
				</button>

				<button 
					class 	= "close" 
					type 	= "button" 
					onclick = "OpenFCompra( <?= (!empty($compra))?$compra->compra:''; ?> )"
					style 	= "padding-right: 5px; font-size: 15px;"
				>
					<i class="fa fa-redo-alt" ></i>
				</button>

				<strong>
					<?php if (!empty($compra)): ?>
						Editanto compra
					<?php else: ?>
						Nueva Compra
					<?php endif ?>
				</strong>

			</h4>
		</div>
	</div>

	<div class="form-group form-group-sm">
		
		<?= $form->label_fecha_factura; ?>
		<div class="col-sm-4">
			<?= $form->input_fecha_factura; ?>
		</div>

		<?= $form->label_serie; ?>
		<div class="col-sm-2">
			<?= $form->input_serie; ?>
		</div>

		<?= $form->label_factura_numero; ?>
		<div class="col-sm-2">
			<?= $form->input_factura_numero; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">
		
		<?= $form->label_concepto; ?>
		<div class="col-sm-4">
			<?= $form->input_concepto; ?>
		</div>
			
		<?= $form->label_proveedor; ?>
		<div class="col-sm-5">
			<?= $form->select_proveedor; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">
		
		<?= $form->label_tipo_pago; ?>
		<div class="col-sm-4">
			<?= $form->select_tipo_pago; ?>
		</div>

		<?= $form->label_moneda; ?>
		<div class="col-sm-5">
			<?= $form->select_moneda; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">

		<?= $form->label_fecha_pago; ?>
		<div class="col-sm-4">
			<?= $form->input_fecha_pago; ?>
		</div>
		<div class="col-sm-6 text-right">
			
			<?= $form->boton_btnGuardarCompra; ?>
			<?= $form->boton_btnCancelar; ?>

		</div>
	</div>

	<?= $form->fclose; ?>

	<?php if (!empty($compra)): ?>
		<?php $this->load->view('compra/detalle/cuerpo'); ?>
	<?php endif ?>
</div>