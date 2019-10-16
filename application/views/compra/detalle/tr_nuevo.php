<tr>
	<th colspan="100%" class="text-center">
		<a 
			href="javascript:;" 
			onclick="
				FormDetalle({
					compra     : <?= ($compra)?$compra->compra:''; ?>,
					detalle    : '',
					contenedor : 'ContenidoFDetalle',
					form 	   : 'FormGuardarDetalle'
				})
			"
		>
			Agregar detalle
		</a>
	</th>
</tr>