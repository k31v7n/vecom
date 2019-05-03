<!DOCTYPE html>
<html lang="en">
<head>
	
	<?= link_tag('public/cpn/bootstrap/css/bootstrap.min.css'); ?>
	<?= link_tag('public/cpn/icono/css/all.css');?>
	<?= link_tag('public/css/vecom.css'); ?>
	<?= link_tag('public/css/menu.css'); ?>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset="UTF-8">
	<title>Vecom | VIPS</title>
</head>
<body>
	<header>
		<?php $this->load->view('menu/menu'); ?>
		
		<div class="vc-menu">
			<?php $this->load->view('menu/lateral');?>
		</div>
	</header>

	<section class="vc-container">
		<?php if (isset($vista)): ?>
			<div class="content">
				<?php $this->load->view($vista); ?>
			</div>
		<?php endif ?>
	</section>
	
	<div id="vcmodal" class="modal fade" role="dialog">
		<div class="modal-dialog" id="vcmodaltamanio">
			<div class="modal-content remove-radio">
				<div class="modal-header modal-header-padding">
					<button type="button" class="close" data-dismiss="modal" style="margin-top: 3px;">&times;</button>
					<h4 class="modal-title" id="vcmodaltitulo"></h4>
				</div>
				<div class="modal-body" id="vcmodalcontenido"></div>
			</div>
		</div>
	</div>

	<footer></footer>
	
	<?= script_tag('public/cpn/jquery.js'); ?>
	<?= script_tag('public/cpn/bootstrap/js/bootstrap.min.js'); ?>
	<?= script_tag('public/cpn/jquery-ui.min.js'); ?>
	<?= script_tag('public/js/vecom.js', true); ?>
	<?= script_tag('public/js/inicio.js', true); ?>
	<?= script_tag('public/js/menu.js', true); ?>

	<?php 
	if (isset($scripts)) {
		foreach ($scripts as $key => $row) {
			if ( is_object($row) ) {
	        	echo script_tag($row->ruta, $row->imp);
	      	} else {
	        	echo script_tag($row);
	      	}
		}
	}
	?>
</body>
</html>