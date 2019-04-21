$(document).on("submit","#FormLogin", function(e){
	e.preventDefault()

	var xhr = new XMLHttpRequest()
	xhr.open('POST', this.action, true)
	xhr.onload = function() {
		var res = JSON.parse(this.responseText)
		
		if (res.exito === true) {
			window.location.href = res.redirect
		} else {
			$("#vc-login-msg").show().html("<small>"+res.mensaje+"</small>")
		}
	}
	xhr.send(new FormData(this))
})