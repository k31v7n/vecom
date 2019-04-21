function activa_desactiva_menu(media) {
  if (media.matches) {
  	document.getElementById('vc-check').checked = false
  } else {
  	document.getElementById('vc-check').checked = false
  }
}

var media = window.matchMedia("(max-width: 767px)")
activa_desactiva_menu(media)
media.addListener(activa_desactiva_menu)

$(document).on('click','.vc-container',function(){
	document.getElementById('vc-check').checked = false
})

$(document).on("submit","form#FormSearchMenu", function(e) {
	e.preventDefault()
	
	document.getElementById('lt-menu-cp').style.display = 'block'
	document.getElementById('lt-menu-lateral').style.display = 'none'

	var x = new XMLHttpRequest()
	x.open('POST', this.action, true)
	x.onload = function() {
		document.getElementById('lt-menu').innerHTML = this.responseText
	}
	x.send(new FormData(this))
})

function cerrarMenuBusqueda()
{
	document.getElementById('lt-menu-cp').style.display = 'none'
	document.getElementById('lt-menu-lateral').style.display = 'block'
}