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
        <title>Cadastro de Familia</title>
    </head>
    <body class="s013">
        <?php
            include 'cabecalho.php';
            if(isset($_GET['alter'])){
                $id = $_GET['alter'];
                include 'classes/familia.class.php';
                $familia = new Familia;
                $dados = $familia->selectById($id);
            }
        ?>
        <div class="" style="background-color:#d9d9d9;"  align="center">
		    <div id="form" class="form2">
			    <div id="delimeter">
                    <form action="processa.php?t=familia<?php echo isset($id) ? '&alter='.$dados[0]['id'] : '' ?>" method="POST">
                        <h1><?php echo isset($id) ? 'Alteração' : 'Cadastro' ?> de Família <img src="icones/document.png" height="40"></h1>
                        <?php
                            try{

                                include_once 'classes/ordem.class.php';
                                $ordem = new Ordem;
                                $ordens = $ordem->select();
                                $list = [];
                
                               

                                foreach($ordens as $o){
                                    $list[] = array(
                                        'nome' => $o->getNome(),
                                        'id' => $o->getId()
                                    );
                                }

                                if(count($list)==0){
                                    echo "Não há Ordens cadastradas!";
                                    echo "<br><a href='cadOrdem.php'>Cadastrar ordem</a>";
                                    die();
                                }
                            }catch(Exception $e){
                                echo $e;
                                die();
                            }
                        ?>
                        <div class="form-group">
                            <label>Ordem: </label>
                            <?php

                                // montagem do select

                                $select = "<select class='form-control' style='height:40px;' name='ordem'>";
                                for($c = 0; $c < count($list); $c++){
                                    if(isset($dados)){
                                        if($dados[0]['id_ordem'] == $list[$c]['id']){
                                            $select .= "<option selected value=".$list[$c]['id'].">".$list[$c]['nome']."</option>";
                                        }else{
                                            $select .= "<option value=".$list[$c]['id'].">".$list[$c]['nome']."</option>";
                                        }    
                                    }else{
                                        if(isset($_GET['new'])){
                                            if($_GET['new'] == $list[$c]['id']){
                                                $select .= "<option selected value=".$list[$c]['id'].">".$list[$c]['nome']."</option>";
                                            }else{
                                                $select .= "<option value=".$list[$c]['id'].">".$list[$c]['nome']."</option>";
                                            }
                                        }else{
                                            $select .= "<option value=".$list[$c]['id'].">".$list[$c]['nome']."</option>";
                                        }
                                        
                                    }
                                    
                                }
                                $select .= "</select>";
                                echo $select;

                            ?>
                        </div>
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
                            <textarea class="form-control" id="text" rows="3" type="text" name="caract"><?php echo isset($id) ? $dados[0]['caract'] : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Controle: </label><br>
                            <textarea class="form-control" id="text" rows="3" type="text" name="controle"><?php echo isset($id) ? $dados[0]['controle'] : '' ?></textarea><br>
                        </div>
                        <button type="submit" class="btn btn-success cadastrar" style="margin-top:-10px;"><?php echo isset($id) ? 'Alterar' : 'Cadastrar' ?></button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>