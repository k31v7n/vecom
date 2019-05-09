<?php if (isset($lista) && $lista): ?>
	<?php foreach ($lista as $key => $row): ?>
		<tr>
			<td class="text-center" width="25px"><?= $key+1; ?></td>
			<td class="text-left"><?= $row->nombre; ?></td>
			<td class="text-left"><?= $row->alias; ?></td>
			<td class="text-left"><?= $row->correo; ?></td>
			<td class="text-center"><?= $row->telefono; ?></td>
			<td class="text-left"><?= $row->direccion; ?></td>
			<td class="text-left"><?= $row->nempresa; ?></td>
			<td class="text-left"><?= $row->nrol; ?></td>
			<td class="text-center"><?= ($row->activo == 1) ? 'Activo' : 'Inactivo'; ?></td>

			<td width="25px" class="text-center">
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
					    <?php if ($row->activo == 1): ?>
					    	<li><a href="javascript:;" onclick="abrirPaginaMante({tipo:1, ide:<?= $row->usuario; ?>})">Editar</a></li>
					    	<li><a href="javascript:;" onclick="activarRegistro({tipo:1, ide:<?=$row->usuario?>})">Desactivar</a></li>
					    <?php else: ?>	
					    	<li><a href="javascript:;" onclick="activarRegistro({tipo:1, ide:<?=$row->usuario?>})">Activar</a></li>
					    <?php endif ?>
					    
				  	</ul>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
<?php endif ?>