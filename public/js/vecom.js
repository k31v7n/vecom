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

function Cargando(id,tipo) 
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
        Cargando('vcmodalcontenido',1)
    },
    modal : function() {
        $(this.xmodal).modal();
    }
}