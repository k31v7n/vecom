function OpenFCompra(compra=''){

	$("#ContenidoFCompra").show();
	$("#ListaCompras").hide();

	vercargando("ContenidoFCompra", 1);
	var	url = base_url(`index.php/compra/compra/form/${compra}`);

	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);

	xhr.onload = function() {

		document.getElementById("ContenidoFCompra").innerHTML = this.responseText;

		document.getElementById("FormGuardarCompra").addEventListener("submit", function(e){
			e.preventDefault();

			cargarBoton("cargarBoton", "Guardando...");
			guardar(this);

		});

		if (compra) {lista_detalles(compra);NuevoDetalleTr(compra)}

	};
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

function CloseFCompra() {
	$("#ContenidoFCompra").hide("blind").empty()
	$("#ListaCompras").show()
	lista()
}

function lista() {
	vercargando("contenidoComprasLista", 2)
	var url = base_url("index.php/compra/compra/buscar")
	var xhr = new XMLHttpRequest()

	xhr.open("POST", url, true)
	xhr.onload = function(){

		document.getElementById("contenidoComprasLista").innerHTML = this.responseText
		
	}
	xhr.send()
}

function guardar(form) {
	console.log(form)

	var url = form.action;
	var met = form.method;

	var dat = new FormData(form);
	var xhr = new XMLHttpRequest();

	xhr.open(met, url, true);
	xhr.onload = function(){

		var res = JSON.parse(this.responseText);
		Notificar(res.exito, res.mensaje);

		if (res.compra && res.compra_detalle) { 
			lista_detalles(res.compra); 
			NuevoDetalleTr(res.compra);
		}else if(res.compra){
			OpenFCompra(res.compra);
		}else if(res.proveedor){
			Proveedores(res.proveedor);
		}

		activarBotones();
	}
	xhr.send(dat);

}


(function(){
	lista();
})();

/*** Detalles de compra**/
function NuevoDetalleTr(compra) {
	var url = base_url(`index.php/compra/detalle/tr_nuevo/${compra}`);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true)
	xhr.onload = function(){

		document.getElementById("ContenidoFDetalle").innerHTML = this.responseText

	}
	xhr.send()
}

function FormDetalle(args){
	console.log(args);
	
	if (args.contenedor) {
		var c 	= document.getElementById(args.contenedor);
		var url = base_url(`index.php/compra/detalle/form/${args.compra}/${args.detalle}`);
		var xhr = new XMLHttpRequest();
		xhr.open("POST", url, true)
		xhr.onload = function(){

			c.innerHTML = this.responseText
			DetalleForm(args)

		}
		xhr.send()

	}
}

function DetalleForm(args) {
	document.getElementById(args.form).addEventListener("submit", function(e){
		e.preventDefault();
		cargarBoton();
		guardar(this);
	})

	var producto  = document.getElementById(`producto${args.detalle}`);
	var cantidad  = document.getElementById(`cantidad${args.detalle}`);
	var precio 	  = document.getElementById(`precio${args.detalle}`);
	var total     = document.getElementById(`total${args.detalle}`);

	producto.addEventListener("change", function(){
		var producto = this.value
		var url = base_url(`index.php/producto/producto/get_producto/${producto}`)
		var xhr = new XMLHttpRequest()

		xhr.open("POST", url, true)
		xhr.onload = function() {

			var res 	 = JSON.parse(this.responseText)
			precio.value = res.precio_compra
			total.value  = (cantidad.value * res.precio_compra)

		}
		xhr.send()
	})

	cantidad.addEventListener("change", function(){total_detalle(args.detalle)})
	precio.addEventListener("change", function(){total_detalle(args.detalle)})
	cantidad.addEventListener("keyup", function(){total_detalle(args.detalle)})
	precio.addEventListener("keyup", function(){total_detalle(args.detalle)})

}

function total_detalle(detalle='') {
	var cantidad  = document.getElementById(`cantidad${detalle}`);
	var precio 	  = document.getElementById(`precio${detalle}`);
	var total     = document.getElementById(`total${detalle}`);

	total.value = cantidad.value * precio.value
}

function lista_detalles(compra='') {
	vercargando("DetallesDeCompra", 2)
	var url = base_url(`index.php/compra/detalle/detalles_compra/${compra}`)
	var xhr = new XMLHttpRequest()

	xhr.open("POST", url, true)
	xhr.onload = function() {

		document.getElementById("DetallesDeCompra").innerHTML = this.responseText

	}
	xhr.send()
}

function ActualizarEstatus(compra='', estatus=1){
	var url = base_url(`index.php/compra/compra/actualizar_estatus/${compra}/${estatus}`)
	var xhr = new XMLHttpRequest()

	xhr.open("POST", url, true)
	xhr.onload = function() {

		var res = JSON.parse(this.responseText)
		Notificar(res.exito, res.mensaje)
		if (res.exito) {lista();}

	}
	xhr.send()
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