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

document.getElementById('FormSearchMenu').addEventListener('submit', function(e) {
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

$(document).on('click', '.tree-one', function() {

	/*$('.tree-one > a').removeClass('vactive')
	$(this).find('a:first').addClass('vactive')*/

	var disabled = '<i class="fa fa-angle-left pull-right">'
	var enabled  = '<i class="fa fa-angle-down pull-right">'

	$('.naicon').html(disabled)
	$(this).find('a').find('.naicon').html(enabled)

	$('.tree-two').hide()
	$(this).find('.tree-two').show()
})

$(document).on('click', '.tree-two', function() {

	/*$('.tree-two > a').removeClass('vactiveb')
	$(this).find('a:first').addClass('vactiveb')*/

	var disabled = '<i class="fa fa-angle-left pull-right">'
	var enabled  = '<i class="fa fa-angle-down pull-right">'

	$('.nbicon').html(disabled)
	$(this).find('a').find('.nbicon').html(enabled)

	$('.tree-three').hide()
	$(this).find('.tree-three').show()
})