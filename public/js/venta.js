(function(){
	if (window.innerWidth >= 768){
		document.getElementById("DivProductos").style.height = (window.innerHeight - 127.5) + "px";
		document.getElementById("ContenedorVenta").style.height = (window.innerHeight - 127.5) + "px";
	}else{
		document.getElementById("DivProductos").style.height = (window.innerHeight * 2) + "px";
		document.getElementById("ContenedorVenta").style.height = "auto";
	}
	// 	document.getElementsByClassName("vc-menu")[0].style.display = "none"
	// 	document.getElementsByClassName("vc-container")[0].style.marginLeft = "0"
	// 	document.getElementById("ToggleMenu").style.display = "block"

	// 	document.getElementById("DivProductos").style.height = (window.innerHeight - 160) + "px";
	// }else{
	// 	document.getElementById("ToggleMenu").style.display = "none"
	// }

	window.addEventListener("resize", function(){

		if (window.innerWidth >= 768){
			document.getElementById("DivProductos").style.height = (window.innerHeight - 127.5) + "px";
			document.getElementById("ContenedorVenta").style.height = (window.innerHeight - 127.5) + "px";

		}else{
			document.getElementById("DivProductos").style.height = (window.innerHeight * 2) + "px";
			document.getElementById("ContenedorVenta").style.height = "auto";

		}

	})
	if (typeof(mensaje) !== 'undefined' && mensaje) {
		Notificar(1, mensaje);
	}
	IconosCarga();
	CargarVenta(UltimaVenta)
})();

function IconosCarga() {
	vercargando("ListaProductos", 1);
	vercargando("ListaDetalles", 2);
	vercargando("DatosEncabezado", 1);
}

function ListaVentas(venta='') {
	var url = base_url(`index.php/venta/venta/lista_menu/${venta}`)
	var xhr = new XMLHttpRequest()
	xhr.open("POST", url, true)
	xhr.onload = function(){

		document.getElementById("ListaVentasMenu").innerHTML = this.responseText;

	}
	xhr.send()
}

function CargarVenta(venta='', iconos=true) {
	if (iconos) {IconosCarga();}
	ListaProductos(venta)
	lista_detalles(venta)
	encabezado_venta(venta)
}

function ListaProductos(venta='') {
	var url = base_url(`index.php/venta/detalle/lista_productos/${venta}`);
	var dat = new FormData(document.getElementById("FormFiltrarProductos"));
	var xhr = new XMLHttpRequest(); 
	xhr.open("POST", url, true);
	xhr.onload = function(){

		document.getElementById("ListaProductos").innerHTML = this.responseText;

	}
	xhr.send(dat)
}

function lista_detalles(venta='') {
	var url = base_url(`index.php/venta/detalle/lista/${venta}`);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.onload = function(){

		document.getElementById("ListaDetalles").innerHTML = this.responseText;

	}
	xhr.send()
}

function encabezado_venta(venta='') {
	var url = base_url(`index.php/venta/venta/encabezado/${venta}`);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.onload = function(){

		document.getElementById("DatosEncabezado").innerHTML = this.responseText;

	}
	xhr.send()
}

// document.getElementById("ToggleMenu").addEventListener("click", function(){
// 	if (this.visible==1) {
// 		document.getElementsByClassName("vc-menu")[0].style.display = "none"
// 		document.getElementsByClassName("vc-container")[0].style.marginLeft = "0"
// 		this.visible = 0;
// 	}else{
// 		document.getElementsByClassName("vc-container")[0].style.marginLeft = "230px"
// 		document.getElementsByClassName("vc-menu")[0].style.display = "block"
// 		this.visible = 1;
// 	}
// })
 
function guardar(form) {
	var url = form.action;
	var met = form.method;

	var dat = new FormData(form);
	var xhr = new XMLHttpRequest();

	xhr.open(met, url, true);
	xhr.onload = function() {

		var res = JSON.parse(this.responseText);
		Notificar(res.exito, res.mensaje);

		if (res.detalle && res.venta) {
			lista_detalles(res.venta);
			ListaProductos(res.venta);

		}else if (res.cliente) {
			ActualizarClientes(res.cliente);

		}else if(res.venta && res.exito){
			location.reload();
		}

		activarBotones();
	}
	xhr.send(dat)
}

function openFcliente() {
	var m = parent.MGR
	m.cargando()

	m.titulo('<i class="fa fa-list"></i> Nuevo cliente')
	m.tamanio(3)
	m.modal()

	var url = base_url("index.php/cliente/form")
	var xhr = new XMLHttpRequest()
	xhr.open('POST', url, true)
	xhr.onload = function() {
		m.contenido(this.responseText)
		fcliente()
	}
	xhr.send()
}

function fcliente() {
	document.getElementById("formCliente").addEventListener("submit", function(e) {
		e.preventDefault()
		guardar(this)
	})

	document.getElementById("aplica_descuento").addEventListener("change", function() {
		var input = document.getElementById("monto_descuento")
		if (this.checked === true) {
			input.readOnly = false
		}else{
			input.readOnly = true
		}
	})
}

function ActualizarClientes(cliente) {
	var slct = document.getElementById("cliente")
	if (slct){
		var url = base_url('index.php/cliente/lista_opciones/' + cliente)
		var xhr = new XMLHttpRequest()
		xhr.open('POST', url, true)
		xhr.onload = function(){
			slct.innerHTML = this.responseText
		}
		xhr.send()
	}
}


function AgregarDetalle(args) {
	var url = base_url(`index.php/venta/detalle/guardar/${args.venta}/${args.detalle}`);
	var xhr = new XMLHttpRequest();
	var dat = new FormData();
	dat.append("producto", args.producto)

	xhr.open("POST", url, true);
	xhr.onload = function(){

		var res = JSON.parse(this.responseText)
		Notificar(res.exito, res.mensaje)
		
		if (res.exito) {
			CargarVenta(res.venta, false)
		}
	}
	xhr.send(dat)
}

function form_detalle(venta='', detalle='') {
	var m = parent.MGR;
	m.cargando();

	m.titulo('<i class="fa fa-edit"></i> Editando detalle');
	m.tamanio(2);
	m.modal();

	var url = base_url(`index.php/venta/detalle/form/${venta}/${detalle}`);
	var xhr = new XMLHttpRequest();
	xhr.open('POST', url, true);
	xhr.onload = function() {
		m.contenido(this.responseText);
		f_detalle();

	}
	xhr.send()
}


function f_detalle() {
	document.getElementById("guardarDetalleVenta").addEventListener("submit", function(e){
		e.preventDefault();
		cargarBoton("guardarDetalle", "Guardando...");
		guardar(this);
	});
	document.getElementById("precio").addEventListener("keyup", total_detalle)
	document.getElementById("cantidad").addEventListener("keyup", total_detalle)

	function total_detalle() {
		var cantidad = parseFloat(Math.round(document.getElementById("precio").value * 100) / 100).toFixed(2);
		var precio   = parseFloat(Math.round(document.getElementById("cantidad").value * 100) / 100).toFixed(2);
		document.getElementById("total").value = cantidad * precio
	}
}

function CrearNuevaVenta(){
	var url = base_url(`index.php/venta/venta/guardar`);
	var xhr = new XMLHttpRequest();

	xhr.open("POST", url, true);
	xhr.onload = function(){

		var res = JSON.parse(this.responseText)
		Notificar(res.exito, res.mensaje)
		if (res.exito && res.venta) {
			CargarVenta(res.venta);
			ListaVentas();
		}

	};

	xhr.send();
}

function CompletarVenta(venta='') {
	var url = base_url(`index.php/venta/venta/form/${venta}`);
	var xhr = new XMLHttpRequest();

	xhr.open("POST", url, true);
	xhr.onload = function(){

		document.getElementById("DatosEncabezado").innerHTML = this.responseText
		if (xhr.status == 200){

			document.getElementById("FormGuardarVenta").addEventListener("submit",

				function(e){
					e.preventDefault();
					guardar(this);
				}

			);

		}

	};
	xhr.send();
}


function AnularVenta(venta='') {
	if (confirm("¿Está seguro de anular la venta?")) {

		var url = base_url(`index.php/venta/venta/anular/${venta}`);
		var xhr = new XMLHttpRequest();

		xhr.open("POST", url, true);
		xhr.onload = function(){

			if (xhr.status) {

				var res = JSON.parse(this.responseText);
				Notificar(res.exito, res.mensaje);
				if (res.exito) {
					location.reload();
				}

			}

		};
		xhr.send();

	}
}

document.getElementById("FormFiltrarProductos").addEventListener("submit", 
	function(e){
		e.preventDefault();
		ListaProductos();
	}
);

function AnularDetalle(venta, detalle){
	var url = base_url(`index.php/venta/detalle/guardar/${venta}/${detalle}/1`);
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.onload = function(){
		
		if (xhr.status == 200) {

			var res = JSON.parse(this.responseText);
			Notificar(res.exito, res.mensaje)
			if (res.exito) {
				CargarVenta(venta)
			}
			
			
		}else{
			alert("Ocurrio un error interno.");
		}
	
	}
	xhr.send();
}

$(document).on("click", ".opc-vent", function(){
	var self = this;
	$(".opc-vent").removeClass("activa");
	$(this).addClass("activa");
})