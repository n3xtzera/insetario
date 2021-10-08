<!DOCTYPE html>
<html>
    <head>
        <style>
            body{
                background: url("images/ladybug.jpg");
                background-size: cover;
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
        </style>
        <meta charset="UTF-8">
        <title>Listagem</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <?php
            include 'links.php';
        ?>
    </head>
    <body>
        <?php
            include 'cabecalho.php';
        ?>
        <div class="search_area">
            <div>
                <?php

                    if(isset($_GET['pesquisa'])){
                        $pesquisa = $_GET['pesquisa'];
                        if(isset($_GET['conteudo'])){
                            $conteudo = $_GET['conteudo'];
                            $s = true;
                        }
                    }

                ?>
                <form class="form-inline active-cyan-4" action="listar.php">
                    <select id="inputState" class="form-control" name="conteudo">
                        <option value="1" <?php 
                            if(isset($conteudo)){
                                if($conteudo == 1){
                                    echo "selected";
                                }
                            }
                        ?>
                        >Inseto</option>
                        <option value="2" <?php 
                            if(isset($conteudo)){
                                if($conteudo == 2){
                                    echo "selected";
                                }
                            }
                        ?>>Ordem</option>
                        <option value="3" <?php 
                            if(isset($conteudo)){
                                if($conteudo == 3){
                                    echo "selected";
                                }
                            }
                        ?>>Família</option>
                    </select>
                    <input value="<?php echo isset($pesquisa) ? $pesquisa : "" ?>" name="pesquisa" id="search_bar" class="form-control" type="text" placeholder="Search" aria-label="Search">
                    <button class="search_button"><img src="icones/search.png" height="20"></button>
                </form>
            </div>
        </div>
        <div class="itens_list">
	        <div id="itens_box">
	        	<?php

                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }                            

                    function makeTable($dados, $op, $c){
                        if(is_array($dados)){
                            if(count($dados) >= 1){
                                $table = "<table class='pesquisa table table-striped table-dark'>";
                                for($i=0; $i<count($dados) ; $i++){
                                    $table .= "<tr><td><label class='ncom'>{$dados[$i]['ncomum']}</label><br>"; 
                                                if($op == 0){
                                                    $table .= "<label class='ncie'>{$dados[$i]['nome']}</label></td>";
                                                }else{
                                                    $table .= "<label class='ncie'>{$dados[$i]['nomeCientifico']}</label></td>";
                                                }
                                    $table .= "<td class='buttons_table'><button id='botaofdc' onclick='redirect({$c}, {$dados[$i]['id']})' type='button' class='btn btn-outline-light'>DETALHES</button></td>
                                            </tr>";
                                    // echo $op == 0 ? $dados[$i]['nome']."<br>" : $dados[$i]['nomeCientifico']."<br>";
                                }
                                $table .= "</table>";
                                echo $table;
                            }
                        }else{
                            $table .= "<tr><td><label class='ncom'>{$dados[0]['ncomum']}</label><br>"; 
                                        if($op == 0){
                                            $table .= "<label class='ncie'>{$dados[0]['nome']}</label></td>";
                                        }else{
                                            $table .= "<label class='ncie'>{$dados[0]['nomeCientifico']}</label></td>";
                                        }
                            $table .= "<td class='buttons_table'><button id='botaofdc' onclick='redirect({$c}, {$dados[0]['id']})' type='button' class='btn btn-outline-light'>DETALHES</button></td>
                                     </tr>";
                            // echo $op == 0 ? $dados[$i]['nome']."<br>" : $dados[$i]['nomeCientifico']."<br>";
                            $table .= "</table>";
                            echo $table;
                        }
                        
                    }
					if(isset($_GET)){
						if(isset($_GET['conteudo'])){
                            $pesquisa = $_GET['pesquisa'];
							$conteudo = $_GET['conteudo'];
							if($conteudo == 2){

                                echo "<h3 style='padding-bottom:15px;'>Pesquisar por ordem: ".$pesquisa."</h3>";
								include_once 'classes/ordem.class.php';
								$ordem = new Ordem;
                                $resultado = $ordem->selectName($pesquisa);
                                makeTable($resultado, 0, $conteudo);

							}elseif($conteudo == 3){

                                echo "<h3 style='padding-bottom:15px;'>Pesquisar por familia: ".$pesquisa."</h3>";
								include_once 'classes/familia.class.php';
                                $familia = new Familia;
                                $resultado = $familia->selectName($pesquisa);
                                makeTable($resultado, 0, $conteudo);

							}elseif($conteudo == 1){

                                echo "<h3 style='padding-bottom:15px;'>Pesquisar por inseto: ".$pesquisa."</h3>";
								include_once 'classes/inseto.class.php';
                                $inseto = new Inseto;
                                $resultado = $inseto->selectName($pesquisa);
                                makeTable($resultado, 1, $conteudo);
                                
							}
						}
					}else{
						header('location: index.php');
					}

				?>
	        </div>
	    </div>
    </body>
    <script>
        function redirect(conteudo, id){
            window.location.href = 'detalhes.php?conteudo='+conteudo+'&id='+id;
        }
    </script>
</html>