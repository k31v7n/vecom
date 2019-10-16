(function(){
	lista();
})()

function openFProducto(producto="") {
	$("#contenidoFProd").show();
	$("#ListaProd").hide();

	var url = base_url(`index.php/producto/producto/form/${producto}`);
	var xhr = new XMLHttpRequest();
	vercargando("contenidoFProd", 1);

	xhr.open("POST", url, true);
	xhr.onload= function() {
		document.getElementById('contenidoFProd').innerHTML = this.responseText;

		document.getElementById("FormGuardarProducto").addEventListener("submit",
			function(e){
				e.preventDefault();
				cargarBoton("guardarProd", "Guardando...");
				guardar(this);
			}
		);
		document.getElementById("incluye_iva").addEventListener("change", valor_iva);

	}
	xhr.send();
}

function closeProdForm(){
	$("#contenidoFProd").hide('blind').empty();
	$("#ListaProd").show();
	lista();
}

function lista() {
	vercargando("contenidoProdLista", 2);
	var url = base_url(`index.php/producto/producto/filtar`);
	var xhr = new XMLHttpRequest();

	xhr.open("POST", url, true);
	xhr.onload = function() {
		document.getElementById("contenidoProdLista").innerHTML = this.responseText;
	}
	xhr.send();

}

function guardar(form) {
	var url = form.action;
	var met = form.method;

	var dat = new FormData(form);
	var xhr = new XMLHttpRequest();

	xhr.open(met, url, true);
	xhr.onload = function() {

		var res = JSON.parse(this.responseText);
		Notificar(res.exito, res.mensaje);

		if (res.producto) { 
			openFProducto(res.producto);

		}else if(res.proveedor){
			Proveedores(res.proveedor);

		}else if(res.tipo_producto){
			TiposProducto(res.tipo_producto)

		}

		activarBotones();

	}
	xhr.send(dat);
}


function valor_iva() {
	var input = document.getElementById("valor_iva");
	if (this.checked === true) {
		input.readOnly = false;
	}else{
		input.readOnly = true;
	}
}

function AnularProducto(producto='') {
	var url = base_url(`index.php/producto/producto/anular/${producto}`);
	var xhr = new XMLHttpRequest();

	xhr.open("POST", url, true);
	xhr.onload = function() {

		var res = JSON.parse(this.responseText);
		Notificar(res.exito, res.mensaje);
		if (res.exito) {
			lista();
		}

	}
	xhr.send();

}

function OpenFProveedor(proveedor=''){
	var m = parent.MGR;
	m.cargando();

	m.titulo('<i class="fa fa-person-dolly-empty"></i> Proveedor');
	m.tamanio(3);
	m.modal();

	var url = base_url(`index.php/proveedor/proveedor/form/1/${proveedor}`);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);
	xhr.onload = function() {
		m.contenido(this.responseText);
		if (this.responseText) {
			document.getElementById("formGuardarProv").addEventListener("submit", function(e){
				e.preventDefault();
				cargarBoton("guardarProv", "Guardando...");
				guardar(this);
			})
		}
	}
	xhr.send();
}

function Proveedores(proveedor='') {
	/*
	* Carga la lista de proveedores al select de proveedor en el formulario de compra
	* siempre y cuando este abierto el formulario
	*/
	var select = document.getElementById("proveedor")
	if (select) {
		var url = base_url(`index.php/proveedor/proveedor/lista_opciones/${proveedor}`)
		var xhr = new XMLHttpRequest()
		xhr.open("POST", url, true)
		xhr.onload = function() {

			select.innerHTML =  this.responseText

		}
		xhr.send()
	}
}

function OpenFTipo(tipo='') {
	var m = parent.MGR;
	m.cargando();

	m.titulo('<i class="fa fa-person-dolly-empty"></i> Tipos de producto');
	m.tamanio(2);
	m.modal();

	var url = base_url(`index.php/producto/tipo/form/${tipo}`);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);

	xhr.onload = function() {
		m.contenido(this.responseText);

		if (this.responseText) {
			document.getElementById("FormTipoProducto").addEventListener("submit", function(e){

				e.preventDefault();
				cargarBoton("guardarTipo", "Guardando...");
				guardar(this);

			})
		}

	}
	xhr.send(); 
}

function TiposProducto(tipo='') {
	var selector = document.getElementById("producto_tipo")
	if (selector) {

		var url = base_url(`index.php/producto/tipo/lista_opciones/${tipo}`)
		var xhr = new XMLHttpRequest()

		xhr.open("POST", url, true)
		xhr.onload = function(){

			selector.innerHTML = this.responseText

		}
		xhr.send()
	}
}