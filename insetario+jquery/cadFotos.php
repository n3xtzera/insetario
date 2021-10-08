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
        <title>Cadastro de Fotos</title>
    </head>
    <body class="s013">
        <?php
            include 'cabecalho.php';
            if(isset($_GET['id_inseto'])){
                $inseto = $_GET['id_inseto'];
            }else{
                header('location: index.php');
            }
        ?>
        <div class="" style="background-color:#d9d9d9;"  align="center">
        <div id="form" class="form4">
            <div id="delimeter">
                <form action="processa.php?t=foto" method="POST" enctype="multipart/form-data">
                    <h1> Cadastro de foto </h1>
                    <div class="form-group">
                        <label>Fotos: </label><br>
                        <input type='file' required multiple name="fotos">
                    </div>
					<div class="form-group">
						<input type="hidden" name="id_inseto" value="<?php echo $inseto; ?>">
						<label>Fotógrafo: </label><br>
						<input type="text" class="form-control" id="fotografo" name="fotografo" required>
					</div>
					<div class="form-group">
						<label>Coletor: </label><br>
						<input type="text" class="form-control" id="coletor" name="coletor" required>
					</div>
					<div class="form-group">
						<label>Local:</label><br>
						<input type='text' class="form-control" id="local" rows="3" name="local"/>
					</div>
					<button type="submit" class="btn btn-success cadastrar" style="margin-top:-10px;"><?php echo isset($id) ? 'Alterar' : 'Cadastrar' ?></button>
                </form>
            </div>
        </div>
    </div> 
    </body>
</html>