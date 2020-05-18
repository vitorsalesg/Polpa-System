function validaLogin() {
	if(document.form.usuario.value == "" || document.form.senha.value == "" ){
			alert( "O campo usuario ou senha não esta preenchido !" );
			document.form.nome.focus();
			return false;
	}	
 }
