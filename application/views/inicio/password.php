<div class="well well-sm remove-margin">
	<p class="text-right"><small>
		Última vez actualizada <b><?= nota_actualizacion($dato->dias); ?>.</b>
	</small></p>
	
	<small>
		<div class="alert alert-info alert-padding" style="display: none;" id="mensale_alert"></div>
	</small>

	<form action="<?php echo $xaccion; ?>" class="form-horizontal" method="POST" id="FormPassword">
		<div class="form-group form-group-sm">
			<label for="pactual" class="col-sm-2 control-label">Actual:</label>
			<div class="col-sm-10">
				<div class="input-group">
			    	<input
			    	type="password" 
					name="pactual" 
					id="pactual" 
					class="form-control" 
					placeholder="Contraseña"
					required>
			      	<span class="input-group-btn">
			        	<button class="btn btn-sm btn-default" id="bpactual" type="button">
			        		<i class="fa fa-eye"></i>
			        	</button>
			      	</span>
			    </div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<label for="pnueva" class="col-sm-2 control-label">Nueva:</label>
			<div class="col-sm-10">
				<div class="input-group">
			    	<input
			    	type="password" 
					name="pnueva" 
					id="pnueva" 
					class="form-control changepass" 
					placeholder="Nueva contraseña"
					required>
			      	<span class="input-group-btn">
			        	<button class="btn btn-sm btn-default" id="bpnueva" type="button">
			        		<i class="fa fa-eye"></i>
			        	</button>
			      	</span>
			    </div>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<label for="pconfirmar" class="col-sm-2 control-label">Confirmar:</label>
			<div class="col-sm-10">
				<input 
					type="password" 
					name="pconfirmar" 
					id="pconfirmar" 
					class="form-control changepass" 
					placeholder="Repetir contraseña"
					required>	
			</div>
		</div>
		<div class="form-group form-group-sm">
			<div class="col-sm-12 text-right">
				<button class="btn btn-sm btn-danger active"><i class="fa fa-check"></i> Aceptar</button>
			</div>
		</div>
	</form>
</div>