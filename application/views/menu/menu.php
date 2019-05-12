<?php 
$empresa = $_SESSION['EmpresaAbre'];
$correo  = $_SESSION['UserMail'];
$espacio = strlen($correo);
?>

<input type="checkbox" id="vc-check">
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<div class="navbar-brand text-center">
				<span class="pull-left" id="mn-hambur">
					<label for="vc-check" >
						<i class="glyphicon glyphicon-menu-hamburger"></i>
					</label>
				</span>
				<?= $empresa; ?>
			</div>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
			    <li class="active"><a href="<?= base_url("index.php/vecom/pagina")?>"><i class="fa fa-chart-line"></i> Tablero</a></li>
			    <li class="notify-bell">
			    	<a href="javascript:;" id='bell-notify'>
			    		0 <i class="fa fa-bell"></i>
			    	</a>
			    </li>
			    <li class="dropdown">
			       	<a href="#" 
	          			class="dropdown-toggle" data-toggle="dropdown" 
	          			role="button" aria-haspopup="true" 
	          			aria-expanded="false">
	          			<i class="glyphicon glyphicon-user"></i> 
	          			<?= $correo; ?>
	          			<span class="caret"></span>
				    </a>

				    <ul class="dropdown-menu">
				       	<li>
				       		<a href="javascript:;" title="Configuración de cuenta">
				       			<i class="fa fa-user"></i> Cuenta<?= nbs($espacio-13) ?>
				       		</a>
				       	</li>
				       	<li>
				       		<a href="javascript:;" title="Cambiar contraseña" onclick="change_password(1)">
				       			<i class="fa fa-unlock-alt"></i> Cambiar contraseña<?= nbs($espacio-13) ?>
				       		</a>
				       	</li>
				       	<li>
				       		<a href="<?php echo base_url("index.php/sesion/log_out") ?>" title="Cerrar Sesión">
				       			<i class="fa fa-sign-out-alt"></i> Cerrar Sesión<?= nbs($espacio-13) ?>
				       		</a>
				       	</li>
				    </ul>

				</li>
			</ul>
		</div>
	</div>
</nav>