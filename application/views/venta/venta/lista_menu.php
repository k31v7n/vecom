<div class="collapse navbar-collapse" id="myNavbar">
	<ul class="nav navbar-nav">

		<?php if (isset($registros) && $registros): ?>
			<?php foreach ($registros as $row): ?>

				<?php if ($row === end($registros)): ?>
					<li class="opc-vent activa" onclick="CargarVenta(<?= $row->venta; ?>)">
				<?php else: ?>
					<li class="opc-vent" onclick="CargarVenta(<?= $row->venta; ?>)">
				<?php endif ?>
					<a href="javascript:;" class="ventanas">
						Venta #<?= $row->venta; ?>
					</a>
				</li>

			<?php endforeach ?>
		<?php endif ?>
	</ul>
	<ul class="nav navbar-nav">
		<li class="btn-nuevo sinmargen">
			<a href="javascript:;" style="color: #FFF;" title="Nueva venta" data-target="#myNavbar" onclick="CrearNuevaVenta()">
				<i class="fa fa-plus"></i>
			</a>
		</li>
	</ul>
</div>
<script>var UltimaVenta = <?= (isset($row))?$row->venta:'0' ?></script>