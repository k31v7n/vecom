<style>
	.col-sm-1,.col-sm-2,.col-sm-4{
		height: 24px; 
		padding-left: 5px; 
		padding-right: 5px;
	}
</style>
<tr>
	<th colspan="100%">
		<?= $form->fopen; ?>

			<div class="form-group form-group-sm" style="margin-bottom: 0;">
				<div class="col-sm-4 col-sm-offset-2">
					<?= $form->select_producto; ?>
				</div>
				<div class="col-sm-1">
					<?= $form->input_cantidad; ?>
				</div>
				<div class="col-sm-2">
					<?= $form->input_precio; ?>
				</div>
				<div class="col-sm-2">
					<?= $form->input_total; ?>
				</div>
				<div class="col-sm-1">
					<?= $form->boton_guardarDetalle; ?>
					<!-- <?= $form->boton_btnCancelar; ?> -->
				</div>
				
			</div>
		<?= $form->fclose; ?>
	</th>
</tr>