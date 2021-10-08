<?php
    include 'security.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['user']['coordenador'])){
        if($_SESSION['user']['coordenador'] != 1){
            header('location: index.php');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
            include 'links.php';
        ?>
        <meta charset="UTF-8">
        <title>Cadastro de Usuário</title>
    </head>
    <body class="s013">
        <script type="text/javascript" src="js/script.js"></script>
        <?php
            include 'cabecalho.php';
            if(isset($_GET['alter'])){
                $id = $_GET['alter'];
                include 'classes/usuario.class.php';
                $usuario = new Usuario;
                $dados = $usuario->selectById($id);
            }
        ?>
        <div class="" style="background-color:#d9d9d9;"  align="center">
		    <div id="form" class="form3">
			    <div id="delimeter">
                    <form action="processa.php?t=usuario<?php echo isset($id) ? '&alter='.$dados[0]['id'] : '' ?>" method="POST" id="formuser">
                        <h1><?php echo isset($id) ? 'Alteração' : 'Cadastro'?> de Usuário <img src="icones/user.png" height="40"></h1>
                        <div class="form-group">
                            <label>Nome: </label><br>
                            <input value="<?php echo isset($id) ? $dados[0]['nome'] : '' ?>" class="form-control" type="text" name="nome" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail: </label><br>
                            <input value="<?php echo isset($id) ? $dados[0]['email'] : '' ?>" class="form-control" type="email" name="email" id="email" required>  
                        </div>
                        <div class="form-group">  
                            <label>Senha: </label><br>
                            <input <?php echo isset($id) ? 'disabled' : '' ?> class="form-control" type="password" name="senha1" id="senha1" required>
                        </div>
                        <div class="form-group">
                            <label>Repetir senha: </label><br>
                            <input <?php echo isset($id) ? 'disabled' : '' ?> class="form-control" type="password" name="senha2" id="senha2">
                        </div>
                        <div class="form-group">
                            <label>Cargo</label>
                            <select class='form-control' style='height:40px;' name='coordenador'>
                                <option <?php echo isset($id) ? $dados[0]['coordenador'] == 0 ? 'selected' : '' : '' ?> value="0">Bolsista</option>
                                <option <?php echo isset($id) ? $dados[0]['coordenador'] == 1 ? 'selected' : '' : '' ?> value="1">Coordenador</option>
                            </select>
                        </div><br>
                        <button type="submit" class="btn btn-success cadastrar" style="margin-top:-10px;"><?php echo isset($id) ? 'Alterar' : 'Cadastrar' ?></button>
                    </form>
                </div>
            </div>
        </div> 
    </body>
</html>