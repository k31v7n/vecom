<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<tr ondblclick="OpenFCompra(<?= $row->compra; ?>)">

			<td><?= FormatoFecha($row->fecha_compra, 2); ?></td>
			<td class="text-center"><?= $row->serie; ?></td>

			<td><?= $row->factura_numero; ?></td>
			<td><?= $row->concepto; ?></td>


			<td>
				<?php if (!empty($row->fecha_pago)): ?>
					<?= FormatoFecha($row->fecha_pago, 2); ?>
				<?php endif ?>
			</td>

			<td><?= $row->proveedor_nombre; ?></td>
			<td><?= $row->estatus_nombre; ?></td>

			<td><?= $row->tipo_pago_nombre; ?></td>
			<td class="text-center">
				<div class="btn-group">
					<button 
						type="button" 
						class="btn btn-default btn-xs dropdown-toggle" 
						data-toggle="dropdown" 
						aria-haspopup="true" 
						aria-expanded="false">
				    	<span class="caret"></span>
				  	</button>
				  	<ul class="dropdown-menu dropdown-menu-right">

					    <li>
					    	<a 
					    		href="javascript:;" 
					    		onclick="OpenFCompra(<?= $row->compra; ?>)"
					    	>
					    		<i class="fa fa-edit" style="width: 15px;"></i> Editar
					    	</a>
					    </li>

					    <!-- <li>
					    	<a 
					    		href 	= '<?= base_url("index.php/compra/compra/imprimir/{$row->compra}") ?>'
					    		target  = ”_blank”
					    	>
					    		Imprimir
					    	</a>
					    </li> -->

					    <li role="separator" class="divider"></li>

					    <li>
					    	<a 
					    		href="javascript:;" 
					    		onclick="ActualizarEstatus(<?= $row->compra; ?>, 2)"
					    	>
					    		<i class="fa fa-times" style="width: 15px;"></i> Anular
					    	</a>
					    </li>

					    <li>
					    	<a 
					    		href="javascript:;" 
					    		onclick="ActualizarEstatus(<?= $row->compra; ?>, 3)"
					    	>
					    		<i class="fa fa-trash-alt" style="width: 15px;"></i> Eliminar
					    	</a>
					    </li>
					    
				  	</ul>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
<?php endif ?>