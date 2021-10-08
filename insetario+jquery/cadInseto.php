<?php
    include 'security.php';
?>
<!DOCTYPE html>
<html>
    <head>
		<?php
			include 'links.php';
		?>
        <meta charset="UTF-8">
        <title>Cadastro de Inseto</title>
    </head>
    <body class="s013">
        <?php
			include 'cabecalho.php';
			if(isset($_GET['alter'])){
				$id = $_GET['alter'];
				include 'classes/inseto.class.php';
				$inseto = new Inseto;
				$dados = $inseto->selectById($id);
			}
        ?>
        <div class="" style="background-color:#d9d9d9;"  align="center">
        <div id="form" class="form3">
            <div id="delimeter">
                <form action="processa.php?t=inseto<?php echo isset($id) ? '&alter='.$dados[0]['id'] : ''; ?>" method="POST" id="forminseto">
                        <h1> <?php echo isset($id) ? 'Alteração' : 'Cadastro' ?> de Inseto <img src="icones/insect.png" height="40"></h1>
                        <?php
							if(isset($_GET['familia'])){
								$familia = trim($_GET['familia']);
								if($familia != ''){
									include 'classes/familia.class.php';
									$fam = new Familia;
									if($fam->getNomeFamilia($familia)){
										echo "<label class='familia'>Família: ".$fam->getNomeFamilia($familia)."</label>";
									}else{
										echo "<label class='familia'>Família inválida</label>";
										die();
									}
								}else{
									echo "<label class='familia'> Nenhuma família definida! </label>";
									die();
								}
							}else{
								echo 'erro!';
								die();
							}

                        ?>
					<div class="form-group">
						<input type="hidden" name="id_familia" value="<?php echo $familia; ?>">
						<label>Nome Científico: </label><br>
						<input value="<?php echo isset($id) ? $dados[0]['nomeCientifico'] : ''; ?>" type="text" class="form-control" id="nomeCientifico" name="nomeCientifico" required>
					</div>
					<div class="form-group">
						<label>Nome Comum: </label><br>
						<input value="<?php echo isset($id) ? $dados[0]['ncomum'] : ''; ?>" type="text" class="form-control" id="nomeComum" name="nomeComum" required>
					</div>
					<div class="form-group">
						<label>Características: </label><br>
						<textarea class="form-control" id="text" rows="3" name="caract"><?php echo isset($id) ? $dados[0]['caract'] : ''; ?></textarea>
					</div>
					<div class="form-group">
						<label>Controle: </label><br>
						<textarea class="form-control" id="text" rows="3" name="controle"><?php echo isset($id) ? $dados[0]['controle'] : ''; ?></textarea><br>
					</div>
					<button type="submit" class="btn btn-success cadastrar" style="margin-top:-10px;"><?php echo isset($id) ? 'Alterar' : 'Cadastrar' ?></button>
                </form>
            </div>
        </div>
    </div> 
    </body>
</html>