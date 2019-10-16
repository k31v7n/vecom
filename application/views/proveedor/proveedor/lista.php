<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>

		<tr ondblclick = "openFProv(<?= $row->proveedor ?>)">

			<td><?= $row->nit; ?></td>
			<td><?= $row->nombre; ?></td>
			<td><?= $row->razon_social; ?></td>

			<td><?= $row->direccion; ?></td>
			<td><?= $row->telefono; ?></td>
			<td><?= $row->contacto; ?></td>

			<td><?= $row->nombre_tipo; ?></td>
			<td><?= $row->nombre_clasificacion; ?></td>

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
					    		onclick="openFProv(<?= $row->proveedor; ?>)"
					    	>
					    		<i class="fa fa-edit" style="width: 15px;"></i> Editar
					    	</a>
					    </li>

					    <!-- <li role="separator" class="divider"></li> -->

					    <li>
					    	<a 
					    		href="javascript:;" 
					    		onclick="DarDeBaja(<?= $row->proveedor; ?>)"
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