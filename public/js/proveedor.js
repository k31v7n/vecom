function openFProv(proveedor=""){
	$("#contenidoFProv").show()
	$("#ListaProv").hide()

	var url = base_url(`index.php/proveedor/proveedor/form/0/${proveedor}`)
	var xhr = new XMLHttpRequest()
	vercargando("contenidoFProv", 1)

	xhr.open("POST", url, true)
	xhr.onload= function() {
		document.getElementById('contenidoFProv').innerHTML = this.responseText

		document.getElementById("formGuardarProv").addEventListener("submit",
			function(e){
				e.preventDefault()
				cargarBoton("guardarProv", "Guardando...")
				guardar(this)
			}
		)

	}
	xhr.send()
}

function closeProvForm(){
	$("#contenidoFProv").hide("blind").empty()
	$("#ListaProv").show()
	lista();
}

function guardar(form) {
	var url = form.action
	var met = form.method

	var dat = new FormData(form)
	var xhr = new XMLHttpRequest()

	xhr.open(met, url, true)
	xhr.onload = function(){

		var res = JSON.parse(this.responseText)
		Notificar(res.exito, res.mensaje)

		if (res.proveedor) {
			openFProv(res.proveedor); 

		} else if(res.clasificacion) {
			clasificacion(res.clasificacion);

		} else if (res.tipo_proveedor) {
			tipoProveedor(res.tipo_proveedor);

		}

		activarBotones()

	}
	xhr.send(dat)
}

function lista() {
	vercargando("contenidoProvLista", 2)
	var url = base_url("index.php/proveedor/proveedor/filtrar")
	var xhr = new XMLHttpRequest()

	xhr.open("POST", url, true)
	xhr.onload = function(){

		document.getElementById("contenidoProvLista").innerHTML = this.responseText
		
	}
	xhr.send()
}

function openFclasificacion(clasificacion='') {
	var m = parent.MGR
	m.cargando()

	m.titulo('<i class="fa fa-sort-amount-down"></i> Nueva clasificación')
	m.tamanio(2)
	m.modal()

	var url = base_url(`index.php/proveedor/clasificacion/form/${clasificacion}`)
	var xhr = new XMLHttpRequest()

	xhr.open('POST', url, true)
	xhr.onload = function() {

		m.contenido(this.responseText)
		var form = document.getElementById("formClasificacion")

		if (form) {
			form.addEventListener("submit",function(e){
				e.preventDefault()
				cargarBoton("guardarClas","cargando")
				guardar(this)
			})
		}

	}
	xhr.send()
}

function openFtipoProveedor(tipo_proveedor=""){
	var m = parent.MGR
	m.cargando()

	m.titulo('<i class="fa fa-tags"></i>Tipo de proveedor')
	m.tamanio(2)
	m.modal()

	var url = base_url(`index.php/proveedor/tipo/form/${tipo_proveedor}`)
	var xhr = new XMLHttpRequest()

	xhr.open('POST', url, true)
	xhr.onload = function() {

		m.contenido(this.responseText)
		var form = document.getElementById("formTipoProveedor")

		if (form) {
			form.addEventListener("submit",function(e){
				e.preventDefault()
				cargarBoton("guardarTipo","Guardando...")
				guardar(this)
			})
		}

	}
	xhr.send()
}

function clasificacion(clas='') {
	var selector = document.getElementById("proveedor_clasificacion")
	if (selector) {

		var url = base_url(`index.php/proveedor/clasificacion/lista_opciones/${clas}`)
		var xhr = new XMLHttpRequest()

		xhr.open("POST", url, true)
		xhr.onload = function(){

			selector.innerHTML = this.responseText

		}
		xhr.send()
	}
}

function tipoProveedor(tipo_proveedor='') {
	var selector = document.getElementById("proveedor_tipo")
	if (selector) {

		var url = base_url(`index.php/proveedor/tipo/lista_opciones/${tipo_proveedor}`)
		var xhr = new XMLHttpRequest()

		xhr.open("POST", url, true)
		xhr.onload = function(){

			selector.innerHTML = this.responseText

		}
		xhr.send()
	}
}

function DarDeBaja(proveedor='') {
	
	if (confirm("Está seguro de anular el proveedor")) {
		var url = base_url(`index.php/proveedor/proveedor/dar_de_baja/${proveedor}`)
		var xhr = new XMLHttpRequest()

		xhr.open("POST", url, true)
		xhr.onload = function(){

			var res = JSON.parse(this.responseText)
			Notificar(res.exito, res.mensaje)
			if (res.exito) {lista();}

		}
		xhr.send()
	}
}