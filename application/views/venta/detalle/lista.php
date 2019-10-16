<?php $total_g = 0; ?>

<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>

		<tr ondblclick="form_detalle(<?= $venta->venta; ?>, <?= $row->venta_detalle; ?>)">
			<td style="padding: 0px 5px 0px 5px;">
				<div class="col-sm-12 remove-padding">

					<b>
						<?= $row->nombre; ?>
						<span 
							class="pull-right"
						>
							<?= number_format($row->total, 2); ?> <?= $row->codigo_moneda; ?>
						</span>
					</b>
					<br>
					<?= number_format($row->cantidad, 2); ?> <?= $row->nombre_unidad; ?>
					en
					<?= number_format($row->precio, 2); ?> <?= $row->codigo_moneda; ?> / <?= $row->nombre_unidad; ?>

				</div>
			</td>

			<td width="25px" style="padding: 0px 0px 0px 5px ;">
				<div class="btn-group">

					<button 
						type 			= "button" 
						class 			= "btn btn-default btn-xs dropdown-toggle" 
						data-toggle 	= "dropdown" 
						aria-haspopup 	= "true" 
						aria-expanded 	= "false">

				    	<span class 	= "caret"></span>

				  	</button>

				  	<ul class="dropdown-menu dropdown-menu-right">

					    <li>
					    	<a 
					    		href="javascript:;" 
					    		onclick="form_detalle(<?= $venta->venta; ?>, <?= $row->venta_detalle; ?>)"
					    	>
					    		<i class="fa fa-edit" style="width: 15px;"></i> Editar
					    	</a>
					    </li>

					    <!-- <li role="separator" class="divider"></li> -->

					    <li>
					    	<a 
					    		href="javascript:;" 
					    		onclick="AnularDetalle(<?= $row->venta; ?> ,<?= $row->venta_detalle; ?>)"
					    	>
					    		<i class="fa fa-times" style="width: 15px;"></i> Anular
					    	</a>
					    </li>
					    
				  	</ul>

				</div>
			</td>
		</tr>

		<?php $total_g += $row->total; ?>

	<?php endforeach ?>
<?php else: ?>
	<tr>
		<td>
			
			<div class="col-sm-12 text-center">

				<?php if (elemento($venta, "venta")): ?>
					<h4>La venta está vacía</h4>

				<?php else: ?>
					<h4>Debe crear una venta para continuar.</h4>

				<?php endif ?>

			</div>

		</td>
	</tr>
<?php endif; ?>
<tr>
	
	<th class="text-left" style="background-color: #eee; border-top: 2px solid #777;" colspan="100%">
		<h3 class="remove-margin">Total <span class="pull-right"> <?= number_format($total_g, 2); ?> </span></h3>
		
	</th>
</tr>