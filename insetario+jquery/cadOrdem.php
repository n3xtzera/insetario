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
        <title>Cadastro de Ordem</title>
    </head>
    <body class="s013">
        <?php
            include 'cabecalho.php';
            if(isset($_GET['alter'])){
                $id = $_GET['alter'];
                include 'classes/ordem.class.php';
                $ordem = new Ordem;
                $dados = $ordem->selectById($id);
            }

	    ?>
    <div class="" style="background-color:#d9d9d9;"  align="center">
		<div id="form" class="form1">
			<div id="delimeter">
                <form action="processa.php?t=ordem<?php echo isset($id) ? '&alter='.$dados[0]['id'] : '' ?>" method="POST">
                    <h1> <?php echo isset($id) ? 'Alteração' : 'Cadastro'?> de Ordem <img src="icones/folder.png" height="40"></h1>
                    <div class="form-group">
                        <label>Nome: </label><br>
                        <input value="<?php echo isset($id) ? $dados[0]['nome'] : '' ?>" class="form-control" type="text" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label>Nome comum: </label><br>
                        <input value="<?php echo isset($id) ? $dados[0]['ncomum'] : '' ?>" class="form-control" type="text" name="nomeComum" required>
                    </div>
                    <div class="form-group">
                        <label>Características: </label><br>
                        <textarea class="form-control" id="text" rows="3" type="text" name="caracteristicas"><?php echo isset($id) ? $dados[0]['nome'] : '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Controle: </label><br>
                        <textarea class="form-control" id="text" rows="3" type="text" name="controle"><?php echo isset($id) ? $dados[0]['nome'] : '' ?></textarea><br>
                    </div>
                    <button type="submit" class="btn btn-success cadastrar" style="margin-top:-10px;"><?php echo isset($id) ? 'Alterar' : 'Cadastro'?></button>
                </form>
            </div>
        </div>
    </div>
                
    </body>
</html>