function abrirPaginaMante(args)
{
	$("#contenidoManteForm").show()
	$("#ListaMante").hide()

	var url = ''
	var ide = (args.ide) ? args.ide : ''
	vercargando('contenidoManteForm', 1)

	switch(args.tipo) {
		case 1:
			url = base_url("index.php/mante/usuario/form/" + ide)
		break;
		case 2:
			url = base_url("index.php/mante/empresa/form/" + ide)
		break
	}

	var xhr = new XMLHttpRequest()
	xhr.open('POST', url, true)
	xhr.onload = function()
	{
		document.getElementById('contenidoManteForm').innerHTML = this.responseText
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
			abrirListaMante({tipo:res.tipo})
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

function closeManteForm()
{
	$("#contenidoManteForm").hide('blind')
	$("#ListaMante").show()
}