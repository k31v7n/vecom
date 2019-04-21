<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo link_tag('public/cpn/bootstrap/css/bootstrap.min.css'); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset="UTF-8">
	<title>Login | Vips</title>
</head>
<body>
	<style>body{background: #9E64E0;} .form-control:focus{border:1px solid #35D24F;}</style>
	<div class="container">
		<div class="row">
			<div class="col-sm-offset-2 col-sm-8">
				<?php echo str_repeat('<br>', 5); ?>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-6"><br>
								<h1>Vips | Vecom</h1>   
								<p class="text-muted"><small>Módulo de Ventas y Compras</small></p>
								<p>
									<small>Si no tienes una cuenta disponible, comunícate con tu administrador para poder acceder.</small>
								</p>
							</div>
							<div class="col-sm-6"><br><br>
								<form action="<?php echo $baccion; ?>" class="form-horizontal" id="FormLogin">
									<div class="form-group form-group-sm">
										<div class="col-sm-12">
											<input type="text" name="user_name" class="form-control" placeholder="Usuario">
										</div>
									</div>

									<div class="form-group form-group-sm">
										<div class="col-sm-12">
											<input type="password" name="user_password" class="form-control" placeholder="Contraseña">
										</div>
									</div>

									<p class="text-danger" id="vc-login-msg" style="display: none;"></p>
									
									<div class="form-group form-group-sm">
										<div class="col-sm-12">
											<button class="btn btn-sm btn-info btn-block">Iniciar Sesión</button>
											<small><a href="javascript:;" class="help-block">¿Se te olvidó tu contraseña?</a></small>
										</div>
									</div>
								</form><br>
								<spam class="pull-right text-muted">
									<small>&#9400; 2019 Derechos reservados por grupo Vips GT.</small>
								</spam>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<?php echo script_tag('public/cpn/jquery.js') ?>
	<?php echo script_tag('public/cpn/bootstrap/js/bootstrap.min.js') ?>
	<?php echo script_tag('public/js/sesion.js', true) ?>

	<style>body{background-image: url('public/img/background.jpg'); background-repeat: no-repeat;
  background-size: auto;}</style>
</body>
</html>