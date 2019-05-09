function cargarBoton(id,texto)
{
	$("#"+id).attr('data-loading-text', texto)
	$("#"+id).button('loading')
}

function base_url(url)
{
	var link = window.location.origin+"/vips/vecom/"
	if (url) { link = link +'/'+ url }

	return link
}

function vercargando(id,tipo) 
{
	var img = ''
	var gif = base_url("public/img/cargando.gif")

	switch(tipo) {
		case 1:
			img = "<p class='text-center'><img src='"+gif+"' alt='Cargando'></p>"
		break
		case 2:
			img = "<tr><td class='text-center' colspan='100%'><img src='"+gif+"' alt='Cargando'></td></tr>"
		break
		default:
			return false
		break
	}

	$("#"+id).html(img)
}

var MGR = {
    xmodal   : document.getElementById("vcmodal"), 
    xtamanio : document.getElementById("vcmodaltamanio"), 
    xtitulo  : document.getElementById("vcmodaltitulo"), 
    xcuerpo  : document.getElementById("vcmodalcontenido"), 

    titulo : function(t) {
        this.xtitulo.innerHTML = t
    }, 
    tamanio : function(t) {
        var size = ['modal-xs', 'modal-sm', 'modal-md', 'modal-lg']
        var tam = this.xtamanio
        
        size.forEach(function(e) { 
            tam.classList.remove(e); 
        })

        tam.classList.add(size[t])
    }, 
    contenido : function(c) {
        this.xcuerpo.innerHTML = c;
    }, 
    cargando : function()
    {
        vercargando('vcmodalcontenido',1)
    },
    modal : function() {
        $(this.xmodal).modal();
    }
}

var nsms = 0
function Notificar(tipo, mensaje)
{
    nsms++;
    var elemento = document.getElementsByClassName('vc-alert-conte')

    if (elemento.length == 0) {
        var elemento = document.createElement('div')
        elemento.classList.add('vc-alert-conte')

        $("body").append(elemento)
    }
    
    var xid = 'sms_'+nsms

    var contenedor = document.createElement('div')
    contenedor.classList.add('vc-alert-ms')
    contenedor.id = xid

    var divicono = document.createElement('div')
    divicono.classList.add('vc-ms-icon')

    var h1icono = document.createElement('h1')
    h1icono.classList.add('remove-margin')
    h1icono.classList.add('text-center')

    var icono = document.createElement('i')
    icono.classList.add('fa')
   
    if (tipo == 1) {
        divicono.classList.add('text-success')
        icono.classList.add('fa-check')
    } else if (tipo == 2) {
        divicono.classList.add('text-warning')
        icono.classList.add('fa-exclamation-circle')
    } else {
        divicono.classList.add('text-danger')
        icono.classList.add('fa-times')
    }

    $(h1icono).append(icono)
    $(divicono).append(h1icono)

    var divmensaje = document.createElement('div')
    divmensaje.classList.add('vc-ms-data')

    var boton = document.createElement('button')
    boton.setAttribute("onclick","cerrarNotificacion('"+xid+"')")
    boton.setAttribute("type","button")
    boton.classList.add("close")
    boton.innerHTML = '&times;'

    var ptitulo = document.createElement('p')
    ptitulo.classList.add('remove-margin')
    ptitulo.setAttribute("style", "font-size:16px")
    ptitulo.innerHTML = "<b>Notificación</b>"    

    $(ptitulo).append(boton)

    var pmensaje = document.createElement('p')
    pmensaje.setAttribute('style','font-size:13px;')
    pmensaje.innerHTML = mensaje

    $(divmensaje).append(ptitulo)
    $(divmensaje).append(pmensaje)

    $(contenedor).append(divicono)
    $(contenedor).append(divmensaje)

    $(elemento).append(contenedor)

    setTimeout(function() {
        $(contenedor).hide('highlight')
        setTimeout(function() { $(contenedor).remove() },1000)
    },4000)
}

function cerrarNotificacion(id)
{
    $("#"+id).hide('puff')
    setTimeout(function() {
        $("#"+id).remove()
    },1000)
}