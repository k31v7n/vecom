<div class="panel panel-success remove-radio" style="margin-bottom: 1px;">
<div class="panel-body" style="padding: 5px;">
	<?= $form->fopen; ?>
	
	<div class="form-group form-group-sm">

		<?= $form->label_cliente; ?>
		<div class="col-sm-9">
			<?= $form->select_cliente; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">

		<?= $form->label_tipo_pago; ?>
		<div class="col-sm-9">
			<?= $form->select_tipo_pago; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">

		<?= $form->label_moneda; ?>
		<div class="col-sm-9">
			<?= $form->select_moneda; ?>
		</div>

	</div>

		<div class="form-group form-group-sm">

			<?= $form->label_concepto; ?>
			<div class="col-sm-9">
				<?= $form->input_concepto; ?>
			</div>

		</div>
	
	<div class="form-group form-group-sm" style="margin-bottom:0px;">

		<div class="col-sm-12 text-right">
			<?= $form->boton_guardar; ?>
			<?= $form->boton_cancelar; ?>
		</div>

	</div>
	
	<?= $form->fclose; ?>
</div>
</div>