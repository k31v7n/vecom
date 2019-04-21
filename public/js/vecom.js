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