<?php 
$menu = $this->Menu_model->verMenu(); 

$vmodulo = (isset($_SESSION['vcModulo'])) ? $_SESSION['vcModulo'] : '';
$vsubmod = (isset($_SESSION['vcSubmenu'])) ? $_SESSION['vcSubmenu'] : '';
$vopcion = (isset($_SESSION['vcMenu'])) ? $_SESSION['vcMenu'] : '';
?>

<div class="lt-menu-lateral-title">
	<small>Menú Vips</small>
	<span class="pull-right">
		<small><?= count($menu) ?></small>
	</span>
</div>

<ul class="vc-menu-ul">
	<?php if ($menu): ?>
		<?php foreach ($menu as $key => $row): ?>
			<li class="tree-one">

				<?php 
					$activamodulo = ($vmodulo == $row['modulo']) ? 'vactive' : '';
					$xiconomodulo = ($vmodulo == $row['modulo']) ? 'angle-down' : 'angle-left'; 
				?>

				<a href="javascript:;">
					<span class="ic-tree"><?= $row['icono']?> </span>
					<span class="nm-tree"><?=$row['nombre']; ?></span>

					<small><span class="naicon">
						<i class="fa fa-<?=$xiconomodulo?> pull-right"></i>
					</span></small>
				</a>

				<ul class="vc-menu-ul">
					<?php foreach ($row['submenu'] as $submenu): ?>

						<?php $vermodulo = ($vmodulo == $row['modulo']) ? 'style="display:block"' : ''; ?>

						<li class="tree-two" <?= $vermodulo; ?>>

							<?php 
								$activasubmodulo = ($vsubmod == $submenu['submenu'] && $vmodulo == $row['modulo']) ? 'vactiveb' : '';
								$xiconosubmodulo = ($vsubmod == $submenu['submenu'] && $vmodulo == $row['modulo']) ? 'angle-down' : 'angle-left'; ?>

							<a href="javascript:;">
								<?= $submenu['nombre'] ?>
								<small><span class="nbicon">
									<i class="fa fa-<?=$xiconosubmodulo; ?> pull-right"></i>
								</span></small>
	                    	</a>

							<ul class="vc-menu-ul">
								<?php foreach ($submenu['opcion'] as $opcion): ?>

									<?php $versubmodulo = ($vsubmod == $submenu['submenu'] && $vmodulo == $row['modulo']) ? 'style="display:block"' : ''; ?>

									<li class="tree-three" <?= $versubmodulo; ?>>

										<?php $activaopcion = ($vopcion == $opcion->menu && $vmodulo == $row['modulo']) ? 'activaopcion' : ''; ?>

										<a href="<?= base_url("index.php/vecom/pagina/{$opcion->menu}")?>" 
										class="<?= $activaopcion; ?>">
											<span class="ic-tree"><?= $opcion->icono;?></span>
											<span class="nm-tree"><?= $opcion->nombre;?></span>
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						</li>
					<?php endforeach ?>
				</ul>
			</li> 
		<?php endforeach ?>
	<?php endif ?>
	
	<li class="acces-control">
		<a href="<?= base_url("index.php/vecom/pagina")?>">
			<span class="ic-tree"><i class="fa fa-chart-line"></i></span>
			<span class="nm-tree">Tablero</span>
		</a>
	</li>
	<li class="tree-one acces-control">
		<a href="javascript:;">
			<span class="ic-tree"><i class="fa fa-cog"></i> </span>
			<span class="nm-tree">Cuenta</span>
			<small><span class="naicon"><i class="fa fa-angle-left pull-right"></i></span></small>
		</a>
		<ul class="vc-menu-ul">
			<li class="tree-two">
				<a href="javascript:;">
					<span class="ic-tree"><i class="fa fa-user"></i></span>
					<span class="nm-tree">Configurar Cuenta</span>
            	</a>
            </li>
            <li class="tree-two">
				<a href="javascript:;" onclick="change_password(1)">
					<span class="ic-tree"><i class="fa fa-unlock-alt"></i></span>
					<span class="nm-tree">Cambiar contraseña</span>
            	</a>
            </li>
            <li class="tree-two">
				<a href="<?= base_url("index.php/sesion/log_out") ?>">
					<span class="ic-tree"><i class="fa fa-sign-out-alt"></i></span>
					<span class="nm-tree">Cerrar Sesion</span>
            	</a>
            </li>
		</ul>
	</li>
</ul>
