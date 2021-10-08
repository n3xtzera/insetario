<?php

    // ARQUIVO DESTINADO PARA O TRATAMENTO DOS DADOS VINDOS DE QUALQUER FORMULÁRIO DO SISTEMA

    if(isset($_GET)){
        if(isset($_GET['t'])){

            // tratamento de dados de ordem
            if($_GET['t'] == 'ordem'){
                if(isset($_POST)){
                    include_once 'classes/ordem.class.php';
                    $nome = $_POST['nome'];
                    $nomeComum = $_POST['nomeComum'];
                    $caracteristicas = $_POST['caracteristicas'];
                    if(isset($_POST['controle'])){
                        $controle = $_POST['controle'];
                    }else{
                        $controle = null;
                    }

                    $ordem = new Ordem;
                    $ordem->SetNome($nome);
                    $ordem->SetNomeComum($nomeComum);
                    $ordem->SetCaracteristicas($caracteristicas);
                    $ordem->SetControle($controle);

                    if(isset($_GET['alter'])){
                        $id = $_GET['alter'];
                        $ordem->setId($id);
                        $retorno = $ordem->alterar();
                    }else{
                        $retorno = $ordem->adicionar();
                    }
                    if($retorno){
                        header('location: listar.php?conteudo=2&pesquisa');
                    }
                }else{
                    echo "Erro";
                }
            }

            if($_GET['t'] == 'familia'){
                if(isset($_POST)){
                    include_once 'classes/familia.class.php';
                    $id_ordem = $_POST['ordem'];
                    $nome = $_POST['nome'];
                    $nomeComum = $_POST['nomeComum'];
                    $caract = $_POST['caract'];
                    if(isset($_POST['controle'])){
                        $controle = $_POST['controle'];
                    }else{
                        $controle = null;
                    }

                    $familia = new Familia;
                    $familia->setIdOrdem($id_ordem);
                    $familia->setNome($nome);
                    $familia->setNomeComum($nomeComum);
                    $familia->setCaract($caract);
                    $familia->setControle($controle);

                    if(isset($_GET['alter'])){
                        $id = $_GET['alter'];
                        $familia->setId($id);
                        $retorno = $familia->alterar();
                    }else{
                        $retorno = $familia->adicionar();
                    }

                    if($retorno){
                        header('location: listar.php?conteudo=3&pesquisa');
                    }else{
                        echo 'erro!';
                        die();
                    }
                }else{
                    echo "Erro";
                }
            }

            if($_GET['t'] == 'usuario'){
                if(isset($_POST)){
                    include_once 'classes/usuario.class.php';
                    $usuario = new Usuario;
                    $id = $_GET['alter'];
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = md5($_POST['senha1']);
                    $coordenador = $_POST['coordenador'];

                    $usuario->setNome($nome);
                    $usuario->setEmail($email);
                    $usuario->setSenha($senha);
                    $usuario->setCoordenador($coordenador);
                    if(isset($_GET['alter'])){
                        $usuario->setId($id);
                        $retorno = $usuario->alterar();
                    }else{
                        $retorno = $usuario->adicionar();
                    }   
                    if($retorno){
                        header('location: usuarios.php');
                    }else{
                        echo 'erro';
                        die();
                    }
                }else{
                    echo "Erro";
                }
            }

            if($_GET['t'] == 'inseto'){
                if(isset($_POST)){
                    include_once 'classes/inseto.class.php';
                    $id_familia = $_POST['id_familia'];
                    $nomeC = $_POST['nomeCientifico'];
                    $nomeComum = $_POST['nomeComum'];
                    $caract = $_POST['caract'];
                    $controle = $_POST['controle'];
                    $inseto = new Inseto;
                    $inseto->setIdFamilia($id_familia);
                    $inseto->setNomeCientifico($nomeC);
                    $inseto->setNomeComum($nomeComum);
                    $inseto->setCaract($caract);
                    $inseto->setControle($controle);

                    if(isset($_GET['alter'])){
                        $id = $_GET['alter'];
                        $inseto->setId($id);
                        $retorno = $inseto->alterar();
                    }else{
                        $retorno = $inseto->adicionar();
                    }

                    if($retorno){
                        header('location: listar.php?conteudo=1&pesquisa');
                    }else{
                        echo 'erro!';
                        die();
                    }
                }
            }

            if($_GET['t'] == 'foto'){
                if($_POST){
                    require 'classes/fotos.class.php';
                    var_dump($_POST);
                    $id_inseto = $_POST['id_inseto'];
                    echo "<br>".$id_inseto."<br>";
                    $fotografo = $_POST['fotografo'];
                    $coletor = $_POST['coletor'];
                    $local = $_POST['local'];
                    $msg = false;

                    $foto = new Foto;
                    $foto->setIdInseto($id_inseto);
                    $foto->setFotografo($fotografo);
                    $foto->setColetor($coletor);
                    $foto->setLocal($local);

                    if(isset($_FILES['fotos'])){
                        $image = $_FILES['fotos']['name'];
                        $target = "uploaded/".$image;
                        $foto->setFotoNome($image);
                        if (move_uploaded_file($_FILES['fotos']['tmp_name'], $target)) {
                            $msg = "Image uploaded successfully";
                        }else{
                            $msg = "Failed to upload image";
                        }
                       
                    }else{
                        echo 'Arquivo grande demais';
                    }
                    if($foto->adicionar()){
                        header('location: detalhes.php?conteudo=1&id='.$id_inseto);
                    }else{
                        echo 'erro';
                        die();
                    }
                }
            }

        }else{
            echo "Parâmetros errados";
        }
    }else{
        echo "ALERTA! <br> Ocorreu um erro";
    }


?>