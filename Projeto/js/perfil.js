window.onload = function (){
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	hours();


	function hours(){
		var data = new Date();
		var hora = data.getHours();
		var res  = document.getElementById('res');
		var page = document.getElementById('container-fluid');

		if (hora >= 0 && hora < 12){
			res.innerHTML = 'Bom dia,';
		}
		else if (hora >= 12 && hora <= 18){
			res.innerHTML = 'Boa tarde,';
		}
		else{
			res.innerHTML = 'Boa noite,';
		}
	}
}