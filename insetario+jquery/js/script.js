$(document).ready(function() {
	$("#formuser").submit(function(){
		var nome = $("#nome").val().trim();
		var email = $("#email").val();
		var senha1 = $("#senha1").val();
		var senha2 = $("#senha2").val();
		
		if(nome == ""){//Nome vazio
			alert("O campo nome é obrigatório.");
			return false;
		}else if(nome.length < 3){//Nome menor que 3
			alert("O campo nome deve ter pelo menos 3 letras.");
			return false;
		};

		if(email == ""){//E-mail vazio
			alert("O campo e-mail é obrigatório.");
			return false;
		};

		if(senha1 == ""){//Senha vazia
			alert("O campo senha é obrigatório.");
			return false;
		}else if(senha1.length < 8){//Senha menor que 8
			alert("O campo senha deve ter pelo menos 8 caracteres.");
			return false;
		};

		if(senha2 == ""){//Senha vazia
			alert("Você deve repetir a senha.");
			return false;
		}else if(senha2 != senha1){//Senhas diferentes
			alert("As senhas devem ser idênticas.");
			return false;
		};
		
		return true;
	});
	$("#forminseto").submit(function(){
		var nmcint = $("#nomeCientifico").val().trim();
		var nmcomm = $("#nomeComum").val().trim();

		if(nmcint == ""){//Nome vazio
			alert("O campo nome é obrigatório.");
			return false;
		}else if(nmcint.length < 3){//Nome menor que 3
			alert("O campo nome deve ter pelo menos 3 letras.");
			return false;
		};

		if(nmcomm == ""){//Nome vazio
			alert("O campo nome é obrigatório.");
			return false;
		}else if(nmcomm.length < 3){//Nome menor que 3
			alert("O campo nome deve ter pelo menos 3 letras.");
			return false;
		};

		return true;
	});
});