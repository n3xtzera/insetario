<head>
    <?php
        include 'cabecalho.php';
        include 'links.php';
    ?>
    <style>
        td{
            padding:5px;
        }
    </style>
    <script>
        function excluir(c, id){
				Swal.fire({
					title: 'Você tem certeza?',
					text: "Você deseja mesmo excluir esse elemento?!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
					confirmButtonText: 'Sim, excluir!'
					}).then((result) => {
					if (result.value) {
						window.location.href='excluir.php?c='+c+'&id='+id;                  
					}
				})
			}

        function ver(id){
            window.location.href = 'ver.php?id='+id;
        }
    </script>
</head>
<div class='s013'>
    <div style="padding:20px; margin-top:100px; color:white;">
    <?php
        if(!isset($_COOKIE["PHPSESSID"])){
          session_start();
        }
        function construir($dados, $id){
            if($id == 1){
                echo "<div style='width:100%; text-align:center;'><h1>Detalhamento de inseto</h1></div><br>";
                echo "Nome científico: ".$dados[0]['nomeCientifico']."<br>";
                echo "Nome comum: ".$dados[0]['ncomum']."<br>";
                include 'classes/familia.class.php';
                $familia = new Familia;
                $dados_familia = $familia->selectById($dados[0]['id_familia']);
                echo "Familia: ".$dados_familia[0]['nome']."<br>";
                include 'classes/ordem.class.php';
                $ordem = new Ordem;
                $dados_ordem = $ordem->selectById($dados_familia[0]['id_ordem']);
                echo "Ordem: ".$dados_ordem[0]['nome']."<br>";
                echo "Características: ".$dados[0]['caract']."<br>";
                echo "Controle: ".$dados[0]['controle'];
                if(isset($_SESSION['user']['coordenador'])){
                    echo "<br><br><a class='btn btn-info' href='cadInseto.php?familia=".$dados[0]['id_familia']."&alter=".$dados[0]['id']."'>Alterar</a>";
                    echo "&nbsp<button onclick='excluir(1,{$dados[0]['id']})' class='btn btn-danger'>Excluir</button>";
                    echo "&nbsp<a class='btn btn-success' href='cadFotos.php?id_inseto=".$dados[0]['id']."'>Adicionar foto</a>";
                }
                echo "<br>";
                include_once 'classes/fotos.class.php';
                $fotos = new Foto;
                $dados_fotos = $fotos->getFotosInseto($dados[0]['id']);
                if(!empty($dados_fotos)){
                    $table = "<br><table><tr>";
                    for($i=0; $i < count($dados_fotos); $i++){
                        if($i%3==0){
                            $table .= "</tr><tr>";
                        }
                        $table .= "<td style='text-align:center;'><img class='image_inseto' src='uploaded/".$dados_fotos[$i]['foto_nome']."'/><br>";
                        $table .= "<button style='width:100px' onclick='ver({$dados_fotos[$i]['id']})' class='btn btn-default'>Ver</button>&nbsp";
                        if($_SESSION['logado']){
                            $table .= "<button onclick='excluir(5, {$dados_fotos[$i]['id']})' style='width:100px' class='btn btn-default'>Apagar</button>";   
                        }
                    }
                    $table .= "</table>";
                    echo $table;
                }


            }elseif($id == 2){
                echo "<div style='width:100%; text-align:center;'><h1>Detalhamento de ordem</h1></div><br>";
                echo "Nome científico: ".$dados[0]['nome']."<br>";
                echo "Nome comum: ".$dados[0]['ncomum']."<br>";
                echo "Características: ".$dados[0]['caract']."<br>";
                echo "Controle: ".$dados[0]['controle'];
                if(isset($_SESSION['user']['coordenador'])){
                    echo "<br><br><a href='cadOrdem.php?alter=".$dados[0]['id']."' class='btn btn-info'>Alterar</a>";
                    echo "&nbsp<button onclick='excluir(2,{$dados[0]['id']})' class='btn btn-danger'>Excluir</button>";
                }
                echo "<br><br>";
                include 'classes/familia.class.php';
                $familia = new Familia;
                $familias = $familia->getFamiliasOrdem($dados[0]['id']);
                echo "<h3>Familias:</h3>";
                if(count($familias) >= 1){
                    $table = "<table><tr>";
                    for($i = 0; $i < count($familias); $i++){
                        if($i%3==0){
                            $table .= "</tr><tr>";
                        }
                        $table .= '<td><div class="card" style="width: 18rem; color:black;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-style:italic;">'.$familias[$i]['nome'].'</h5>
                                <p class="card-text">Família cadastrada</p>
                                <a href="detalhes.php?conteudo=3&id='.$familias[$i]['id'].'" class="btn btn-outline-dark">DETALHES</a>
                            </div>
                        </div></td>';
                    }
                    if(isset($_SESSION['user']['coordenador'])){
                        if($i == 3){
                            $table .= '<tr><td>
                                <div class="card" style="width: 18rem; color:black;">
                                    <div class="card-body">
                                        <h5 class="card-title">Adicionar familia</h5>
                                        <a href="cadFamilia.php?new='.$dados[0]['id'].'" class="btn btn-outline-dark">NOVO</a>
                                    </div>
                                </div></td></tr>';
                        }else{
                            $table .= '<td>
                                <div class="card" style="width: 18rem; color:black;">
                                    <div class="card-body">
                                        <h5 class="card-title">Adicionar familia</h5>
                                        <a href="cadFamilia.php?new='.$dados[0]['id'].'" class="btn btn-outline-dark">NOVO</a>
                                    </div>
                                </div></td></tr>';
                        }
                    }
                    $table .= "</table>";
                    echo $table;
                }else{
                    echo 'Sem famílias cadastradas';
                    echo '<div class="card" style="width: 18rem; color:black;">
                        <div class="card-body">
                            <h5 class="card-title">Adicionar familia</h5>
                            <a href="cadFamilia.php?new='.$dados[0]['id'].'" class="btn btn-outline-dark">NOVO</a>
                        </div>
                    </div>';
                }

            }elseif($id == 3){
                echo "<div style='width:100%; text-align:center;'><h1>Detalhamento de familia</h1></div><br>";
                echo "Nome científico: ".$dados[0]['nome']."<br>";
                echo "Nome comum: ".$dados[0]['ncomum']."<br>";
                include 'classes/ordem.class.php';
                $ordem = new Ordem;
                $dados_ordem = $ordem->selectById($dados[0]['id_ordem']);
                echo "Ordem: ".$dados_ordem[0]['nome']."<br>";
                echo "Características :".$dados[0]['caract']."<br>";
                echo "Controle: ".$dados[0]['controle'];
                if(isset($_SESSION['user']['coordenador'])){
                    echo "<br><br><a href='cadFamilia.php?alter=".$dados[0]['id']."' class='btn btn-info'>Alterar</a>";
                    echo "&nbsp<button onclick='excluir(3,{$dados[0]['id']})' class='btn btn-danger'>Excluir</button>";
                }
                echo "<br><br>";
                include 'classes/inseto.class.php';
                $inseto = new Inseto;
                $insetos = $inseto->getInsetosFamilia($dados[0]['id']);
                echo "<h3>Insetos:</h3>";
                if(count($insetos) >= 1){
                    $table = "<table><tr>";
                    for($i = 0; $i < count($insetos); $i++){
                        if($i%3==0){
                            $table .= "</tr><tr>";
                        }
                        include_once 'classes/fotos.class.php';
                        $fotos = new Foto;
                        $foto_dados = $fotos->selectFoto($insetos[$i]['id']);
                        if(!empty($foto_dados)){
                            $table .= '<td><div class="card" style="width: 18rem; color:black; white-space:nowrap;">
                            <img src="uploaded/'.$foto_dados[0]['foto_nome'].'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" style="font-style:italic;">'.$insetos[$i]['nomeCientifico'].'</h5>
                                <p class="card-text">Inseto cadastrado</p>
                                <a href="detalhes.php?conteudo=1&id='.$insetos[$i]['id'].'" class="btn btn-outline-dark">DETALHES</a>
                            </div>
                        </div></td>';
                        }else{
                            $table .= '<td><div class="card" style="width: 18rem; color:black; white-space:nowrap;">
                            <img src="images/new.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title" style="font-style:italic;">'.$insetos[$i]['nomeCientifico'].'</h5>
                                <p class="card-text">Inseto cadastrado</p>
                                <a href="detalhes.php?conteudo=1&id='.$insetos[$i]['id'].'" class="btn btn-outline-dark">DETALHES</a>
                            </div>
                        </div></td>';
                        }
                    }
                    if(isset($_SESSION['user']['coordenador'])){
                        if($i == 3){
                            $table .= '<tr><td>
                                <div class="card" style="width: 18rem; color:black;">
                                    <div class="card-body">
                                        <h5 class="card-title">Adicionar inseto</h5>
                                        <a href="cadInseto.php?familia='.$dados[0]['id'].'" class="btn btn-outline-dark">NOVO</a>
                                    </div>
                                </div></td></tr>';
                        }else{
                            $table .= '<td>
                                <div class="card" style="width: 18rem; color:black;">
                                    <div class="card-body">
                                        <h5 class="card-title">Adicionar inseto</h5>
                                        <a href="cadInseto.php?familia='.$dados[0]['id'].'" class="btn btn-outline-dark">NOVO</a>
                                    </div>
                                </div></td></tr>';
                        }
                    }
                    $table .= "</table>";
                    echo $table;
                }else{
                    echo 'Sem inseto cadastrados';
                    echo '<div class="card" style="width: 18rem; color:black;">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar inseto</h5>
                        <a href="cadInseto.php?familia='.$dados[0]['id'].'" class="btn btn-outline-dark">NOVO</a>
                    </div>
                </div>';
                }

            }
        }


        if(isset($_GET['conteudo']) && isset($_GET['id'])){
            $conteudo = $_GET['conteudo'];
            $id = $_GET['id'];

            if($conteudo == 1){
                include_once 'classes/inseto.class.php';
                $inseto = new Inseto;
                $inseto = $inseto->selectById($id);
                construir($inseto, 1);

            }elseif($conteudo == 2){
                include_once 'classes/ordem.class.php';
                $ordem = new Ordem;
                $ordem = $ordem->selectById($id);
                construir($ordem, 2);

            }elseif($conteudo == 3){
                include_once 'classes/familia.class.php';
                $familia = new Familia;
                $familia = $familia->selectById($id);
                construir($familia, 3);

            }

        }else{
            header('location: index.php');
        }

    ?>
        </div>
    </div>