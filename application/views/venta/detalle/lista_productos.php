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

					<img 
						src="<?= base_url('public/img/logo.jpg')?>" 
						alt="<?= $row->nombre; ?>"
					>
			  		<b><?= $row->codigo; ?></b> <?= $row->nombre; ?>
			  		<br>
			  		<?= number_format($row->precio_venta, 2); ?>/<?= $row->unidad_codigo; ?>
			  		
				</div>

			</div> 
			<?php $cantidad++; ?>
		<?php endforeach ?>

	</div>
<?php endif ?>
