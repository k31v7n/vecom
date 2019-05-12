function abrirPaginaMante(args)
{
	if (args.modal) {
		var icono = ''
		if (args.icono) {
			icono = '<i class="fa fa-'+args.icono+'"></i>'
		}

		var m = parent.MGR
		m.cargando()
		m.titulo(icono+' '+args.titulo)
		m.tamanio(args.tamanio)
		m.modal()
	}

	var url = ''
	var ide = (args.ide) ? args.ide : ''
	var div = 'contenidoManteForm'

	switch(args.tipo) {
		case 1:
			abrirManteForm()
			url = base_url("index.php/mante/usuario/form/" + ide)
		break;
		case 2:
			abrirManteForm()	
			url = base_url("index.php/mante/empresa/form/" + ide)
		break
		case 3:
			if (args.forma == 1) {
				abrirManteForm()
			} else {
				div = 'vcmodalcontenido'
			}

			url = base_url("index.php/mante/empresa/form_pais/" +args.forma +"/"+ ide)
		break
	}

	vercargando(div, 1)

	var xhr = new XMLHttpRequest()
	xhr.open('POST', url, true)
	xhr.onload = function()
	{
		if (args.modal) {
			m.contenido(this.responseText)
		} else {
			document.getElementById(div).innerHTML = this.responseText
		}
	}
	xhr.send()
}

function abrirListaMante(args)
{
	var url = ''
	var ide = (args.ide) ? args.ide : ''
	vercargando('contenidoManteLista', 2)

	switch(args.tipo) {
		case 1:
			url = base_url("index.php/mante/usuario/lista/" + ide)
		break;
		case 2:
			url = base_url("index.php/mante/empresa/lista/" + ide)
		break;
		case 3:
			url = base_url("index.php/mante/empresa/lista_pais/" + ide)
		break;
	}

	var xhr = new XMLHttpRequest()
	xhr.open('POST', url, true)
	xhr.onload = function()
	{
		document.getElementById('contenidoManteLista').innerHTML = this.responseText
	}
	xhr.send()
}

function activarRegistro(args)
{
	if (confirm("¿Está seguro de realizar está acción?")) {
		var url = ''
		var ide = (args.ide) ? args.ide : ''

		switch(args.tipo) {
			case 1:
				url = base_url("index.php/mante/usuario/anular/"+ide)
			break;
		}

		var xhr = new XMLHttpRequest()
		xhr.open('POST', url, true)
		xhr.onload = function() {
			var res = JSON.parse(this.responseText)

			if (res.exito === true) {
				abrirListaMante({tipo:args.tipo})
			}

			Notificar(res.exito, res.mensaje)

		}
		xhr.send()
	}
}

function guardarManteForm(args)
{
	cargarBoton("btnMante", "Guardando...");
	
	var x = new XMLHttpRequest()
	x.open('POST', args.action, true)
	x.onload = function() {
		var res = JSON.parse(this.responseText)
		if (res.exito === true) {
			abrirPaginaMante(res)

			if (!res.esmodal) {
				abrirListaMante({tipo:res.tipo})
			}

		} else {
			$("#btnMante").button('reset')
		}
		
		Notificar(res.exito, res.mensaje)
	}	
	x.send(new FormData(args))
	return false;
}

$(document).on("submit","#FormGuardarMante",function(e) {
	e.preventDefault()
	guardarManteForm(this)
})

function abrirManteForm()
{
	$("#contenidoManteForm").show()
	$("#ListaMante").hide()
}

function closeManteForm()
{
	$("#contenidoManteForm").hide('blind')
	$("#ListaMante").show()
}