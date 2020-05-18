<?php
include_once 'php_action/db_connect.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Polpa System - Polpas de Frutas Natural </title>
		<link rel="stylesheet" href="style/estilo.css">
		<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans|Archivo+Black&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="icon" type="imagem/png" href="image/icon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>	
		<section class="home bloco">
			<nav>
				<ul>
					<a><img class="logo"src="image/logo1.png"></a>
					<li><a class="active" href="login.php">Login</a></li>
					<li><a class="active" href="cadastro.php">Cadastrar</a></li>
				</ul>
			</nav>
			<div class="banner">
				<h2>POLPA DE FRUTA NATURAL DE VERDADE</h2>
				<p >Estamos localizados na cidade de Itaquaquecetuba - São Paulo e oferecemos nossos produtos de polpas de frutas 100% naturais e outros produtos como sorvetes, pão de queijo entre outros. </p>
				<div class="botoes">
					<a class="btn_sobre" href="#servico">Sobre nos</a>
					<a class="btn_contato" href="#contato">Contato</a>
				</div>
			</div>
		</section>
		<main id="servico" class="container servicos">
			<article class="servico">
				<img src="image/duvida.jpg" alt="Imagem de Nossos Serviços">
				<div class="inner">
					<a href="#">Quem Somos</a>
					<p>Fundada em 2015 em Guarulhos por Paulo Rubens Furtado a empresa Deja Alimentos era um pequeno negócio de congelados onde o próprio proprietário da empresa era responsável por fazer e administrar diversas tarefas dentro da empresa. Atualmente se mudou para Itaqua onde abriu sua primeira loja de polpas e outros diversos produtos congelados, contando agora com alguns funcionários.</p>
				</div>
			</article>
			<article class="servico">
				<img src="image/localizacao.jpg" alt="Imagem de localização da Empresa">
				<div class="inner">
					<a href="#">localização</a>
					<p>Estamos localizados na cidade de Itaquaquecetuba - São Paulo e oferecemos nossos produtos de polpas de frutas 100% naturais e outros produtos como sorvetes, pão de queijo entre outros. Não somente para região da zona leste como também trabalhamos com clientes no centro da cidade de São Paulo.  Clientes em São Paulo como diversos mercados, padarias, lanchonetes e restaurantes.</p>
				</div>
			</article>
			<article class="servico">
				<img src="image/entrega.jpg" alt="Imagem de Entrega de Produtos" >
				<div class="inner">
					<a href="#">Nossos serviços</a>
					<p>Em busca de satisfazer sempre o desejo de todos e o melhor dos seus clientes a empresa buscou e criou um menu inteiro com diversos produtos não somente congelados outros também como pão de queijo mineiro, diversos sabores de sorvestes e doces e a melhor parte você pode ter todos eles em seu comercio pois oferecemos um serviço rápido de entregas para varias regiões de são Paulo.</p>
				</div>
			</article>
		</main>
		<section id="contato" class="contato">
			<h1>
				Contato
				<?php
				$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				
				if(strpos($fullUrl, "signup=success") == true){
					echo "<i class='fas fa-check-circle' style='color:green' title='Obrigado, você sera respondido pelo Email informado!'></i>";
				}
				else if(strpos($fullUrl, "signup=vazio") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Por favor preencha todos os campos!'></i>";
				}
				else if(strpos($fullUrl, "signup=erro_insert") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Operação não realizada!'></i>";
				}
				?>
			</h1>
			<h3>Qualquer duvida ou sugestao nos mande aqui !</h3>
			<form action="php_action/operacoesIndex.php" method="POST">
				<input type="text" 	name="nome"    placeholder="Insira o seu nome " required>
				<input type="email" name="email"   placeholder="Insira seu E-mail aqui" required>
				<input type="text"  name="assunto" placeholder="Assunto" required>
				<textarea name="comentario" placeholder="Caso tenha algum comentario ou duvida pode contar aqui ! "  rows="1" ></textarea>
				<input type="submit" class="btn-contato" name="enviar">
				<input type="reset"  class="btn-contato" name="deletar" value="Apagar" >
			</form>
		</section>
		<footer class="container rodape">
			<div class="social-icons">
				<a href="https://m.facebook.com/polpadefrutasvariadas" target="_blank"><i class="fab fa-facebook" style="margin-top: 20px;"></i></a>
				<a href="https://twitter.com/DejaAlimentos?s=08" target="_blank"><i class="fab fa-twitter"></i></a>
				<a href="https://instagram.com/deja_alimentos?igshid=mxest88pezz8" target="_blank"><i class="fab fa-instagram"></i></a>
			</div>
			<p class="copyright">Copyright Polpa System 2019. Todos os direitos reservados. &copy;</p>
		</footer>
	</body>
</html>