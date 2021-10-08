<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/insetario.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Forms</title>
</head>
<body>
	
		<?php
			include 'cabecalho.php';
		?>
		<div class="" style="background-color:#d9d9d9;"  align="center">
		<div id="form">
			<div id="delimeter">
				<form>
						<h1> Cadastro </h1>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Email address</label>
				    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlSelect1">Example select</label>
				    <select class="form-control" id="exampleFormControlSelect1">
				      <option>1</option>
				      <option>2</option>
				      <option>3</option>
				      <option>4</option>
				      <option>5</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlSelect2">Example multiple select</label>
				    <select multiple class="form-control" id="exampleFormControlSelect2">
				      <option>1</option>
				      <option>2</option>
				      <option>3</option>
				      <option>4</option>
				      <option>5</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Example textarea</label>
				    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea><br>
				  </div>
				  <button type="submit" class="btn btn-success cadastrar" class="cadastrar" style="margin-top:-20px; margin-bottom:10px;">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>