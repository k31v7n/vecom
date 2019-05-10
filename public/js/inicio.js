function change_password(tipo)
{
	document.getElementById('vc-check').checked = false
	
	var m = parent.MGR
	m.cargando()

	if (tipo == 1) {
		m.titulo('<i class="fa fa-unlock-alt"></i> Actualización de Contraseña')
		m.tamanio(2)
		m.modal()
	}

	var url = base_url("index.php/vecom/form_password")
	var xhr = new XMLHttpRequest()
	xhr.open('POST', url, true)
	xhr.onload = function() {
		m.contenido(this.responseText)	
	}
	xhr.send()	
}

$(document).on('click', '#bpactual', function() 
{
	elemento = document.getElementById('pactual')

	if (elemento.getAttribute('type') === 'password') {
		elemento.setAttribute('type', 'text')
		this.classList.remove('btn-default')

	} else {
		elemento.setAttribute('type', 'password')
		this.classList.add('btn-default')

	}
})

$(document).on('click', '#bpnueva', function() 
{
	elemento = document.getElementsByClassName('changepass')

	for (var i = elemento.length - 1; i >= 0; i--) {

		if (elemento[i].getAttribute('type') === 'password') {
			elemento[i].setAttribute('type', 'text')
			this.classList.remove('btn-default')

		} else {

			elemento[i].setAttribute('type', 'password')
			this.classList.add('btn-default')
		}
	}
})

$(document).on('submit','#FormPassword', function(e) {
	e.preventDefault()

	var xhr = new XMLHttpRequest()
	xhr.open('POST', this.action, true)
	xhr.onload = function() {
		var res = JSON.parse(this.responseText)
		if (res.exito == true) {
			document.getElementById('vcmodalcontenido').innerHTML = res.mensaje
		} else {
			var elemento = document.getElementById('mensale_alert')
			elemento.innerHTML = res.mensaje
			elemento.style.display = 'block'
		}
	} 
	xhr.send(new FormData(this))
})