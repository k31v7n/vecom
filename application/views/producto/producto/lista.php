<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<tr ondblclick="openFProducto(<?= $row->producto; ?>)">

			<td><?= $row->codigo; ?></td>
			<td><?= $row->nombre; ?></td>
			<td><?= $row->cantidad; ?></td>

			<td><?= $row->unidad_nombre; ?></td>
			<td><?= $row->tipo_nombre; ?></td>
			<td><?= $row->precio_compra; ?></td>

			<td><?= $row->precio_venta; ?></td>
			<td><?= $row->fecha_ingreso; ?></td>
			<td><?= $row->fecha_vencimiento; ?></td>

			<td class="text-center">
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
					    		onclick="openFProducto(<?= $row->producto; ?>)"
					    	>
					    		<i class="fa fa-edit" style="width: 15px;"></i> Editar
					    	</a>
					    </li>

					    <!-- <li role="separator" class="divider"></li> -->

					    <li>
					    	<a 
					    		href="javascript:;" 
					    		onclick="AnularProducto(<?= $row->producto; ?>)"
					    	>
					    		<i class="fa fa-times" style="width: 15px;"></i> Anular
					    	</a>
					    </li>
					    
				  	</ul>

				</div>
			</td>
		</tr>
	<?php endforeach ?>
<?php endif ?>