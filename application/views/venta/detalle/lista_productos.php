<?php if (isset($productos) && $productos): ?>
	<?php $cantidad = 0; ?>


	<div class="row">
		
		<?php foreach ($productos as $row): ?>
			<?php if ($cantidad == 4): ?>
				
				</div>
				<div class="row">
				<?php $cantidad = 0; ?>

			<?php endif ?>

			<div class="col-sm-3 miniatura">

				<div 
					class 	= "thumbnail miniatura" 
					title 	= "<?= $row->nombre; ?>(<?= $row->precio_venta; ?>)"
					onclick = "AgregarDetalle({
						'venta'    : <?= $venta?>,
						'producto' : <?= $row->producto; ?>,
						'detalle'  : ''
					})"
				>
					<?php if ($row->imagen && file_exists(FCPATH.$row->imagen)): ?>
						<img 
							src="<?= base_url($row->imagen)?>" 
							alt="<?= $row->nombre; ?>"
							style="height: 200px;"
						>
					<?php else: ?>
						<img 
							src="<?= base_url('public/img/tag.jpg')?>" 
							alt="Producto"
							style="height: 200px;"
						>
					<?php endif ?>
			  		<b><?= $row->codigo; ?></b> <?= $row->nombre; ?>
			  		<br>
			  		<?= number_format($row->precio_venta, 2); ?>/<?= $row->unidad_codigo; ?>
			  		
				</div>

			</div> 
			<?php $cantidad++; ?>
		<?php endforeach ?>

	</div>
<?php endif ?>
