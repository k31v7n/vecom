<div class="vc-cont-user">
	<div class="vc-photo">
		<?php if ($_SESSION['UserGenero'] == 2): ?>
			<img src="<?= base_url("public/img/girl.svg") ?>" alt="" style="height: 50px; ">
		<?php else: ?>
			<img src="<?= base_url("public/img/boy.svg") ?>" alt="" style="height: 50px; ">
		<?php endif ?>
	</div>
	<div class="vc-user-data">
		<small><?= $_SESSION['UserName'] ?></small><br>
		<small>Conectado</small><div class='vc-online'></div>
	</div>
	<br>

	<form action="<?= base_url("index.php/vecom/buscar_menu"); ?>" id="FormSearchMenu">
		<div class="input-group boton-search">
		    <input type="text" class="form-control input-sm input-search" placeholder="Buscar..." name="bmenu" autocomplete="off">
		    <span class="input-group-btn">
		    	<button class="btn btn-search btn-sm" type="submit"><i class="fa fa-search"></i></button>
		    </span>
		</div>
	</form>
</div>

<div id="lt-menu-cp">
	<div class="vc-cont-search">
		<small>Resultado de búsqueda</small>
		<button type="button" class="close" onclick="cerrarMenuBusqueda()" style="color: #fFF;">&times;</button><br>
	</div>

	<div id="lt-menu"></div>
</div>

<div id="lt-menu-lateral">
	<?php $this->load->view('menu/lista'); ?>
</div>