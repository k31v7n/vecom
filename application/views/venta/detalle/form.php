<div class="well well-sm">
	<?= $form->fopen; ?>

	<!-- <div class="form-group form-group-sm">

		<?= $form->label_producto; ?>
		<div class="col-sm-10">
			<?= $form->select_producto; ?>
		</div>

	</div> -->
	<?= $form->input_producto; ?>

	<div class="form-group form-group-sm">

		<?= $form->label_precio; ?>
		<div class="col-sm-10">
			<?= $form->input_precio; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">

		<?= $form->label_cantidad; ?>
		<div class="col-sm-10">
			<?= $form->input_cantidad; ?>
		</div>

	</div>

	<div class="form-group form-group-sm">

		<?= $form->label_total; ?>
		<div class="col-sm-10">
			<?= $form->input_total; ?>
		</div>

	</div>

	<div class="form-group form-group-xs">
		<div class="col-xs-12 text-right">
			<?= $form->boton_guardarDetalle; ?>
			<?= $form->boton_Cancelar; ?>
		</div>
	</div>

	<?= $form->fclose; ?>
</div>