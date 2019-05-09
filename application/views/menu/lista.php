<?php $menu = $this->Menu_model->verMenu(); ?>

<div class="lt-menu-lateral-title">
	<small>Menú Vips</small>
	<span class="pull-right"><small><?= count($menu) ?></small></span>
</div>

<ul class="vc-menu-ul">
	<?php if ($menu): ?>
		<?php foreach ($menu as $key => $row): ?>
			<li class="tree-one">
				<a href="javascript:;">
					<span class="ic-tree"><?= $row['icono']?> </span>
					<span class="nm-tree"><?=$row['nombre']; ?></span>
					<small><span class="naicon"><i class="fa fa-angle-left pull-right"></i></span></small>
				</a>

				<ul class="vc-menu-ul">
					<?php foreach ($row['submenu'] as $submenu): ?>
						<li class="tree-two">
							<a href="javascript:;">
								<?= $submenu['nombre'] ?>
								<small><span class="nbicon"><i class="fa fa-angle-left pull-right"></i></span></small>
	                    	</a>

							<ul class="vc-menu-ul">
								<?php foreach ($submenu['opcion'] as $opcion): ?>
									<li class="tree-three">
										<a href="<?= base_url($opcion->url)?>">
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
