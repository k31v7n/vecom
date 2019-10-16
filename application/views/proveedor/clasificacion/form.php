<?= $form->fopen; ?>
	<div class="form-group form-group-sm">

		<?= $form->label_nombre; ?>
		<div class="col-sm-10">
			<?= $form->input_nombre; ?>
		</div>
		
	</div>
	<div class="form-group form-group-sm">
		<div class="col-sm-12 text-right">
			<?= $form->boton_guardarClas; ?>
			<?= $form->boton_cancelar; ?>
		</div>
		
	</div>
<?= $form->fclose; ?>