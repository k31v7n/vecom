<?php if (isset($registros) && $registros): ?>
	<?php foreach ($registros as $row): ?>
		<tr onclick="openFVenta(<?= $row->venta; ?>)">
			<td><?= FormatoFecha($row->fecha, 1); ?></td>
			<td><?= $row->cliente_nit; ?></td>
			<td><?= $row->cliente; ?></td>
			<td><?= $row->descripcion; ?></td>
			<td><?= $row->moneda; ?></td>
			<td><?= $row->monto; ?></td>
			<td><?= $row->tipo_pago; ?></td>
			<td><?= $row->usuario; ?></td>
			<td><?= $row->estatus; ?></td>
			<!-- <td class="text-center">

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
				    			onclick="openFVenta(<?= $row->venta; ?>)"
				    		>
				    			Editar
				    		</a>
				    	</li>
				  	</ul>

				</div>

			</td> -->
		</tr>
	<?php endforeach ?>
<?php endif ?>