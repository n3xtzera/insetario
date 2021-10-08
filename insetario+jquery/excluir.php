<?php

    if(isset($_GET['c']) && isset($_GET['id'])){
        $c = $_GET['c'];
        $id = $_GET['id'];
        switch($c){
            case 1: 
                include 'classes/inseto.class.php';
                include 'classes/fotos.class.php';
                $foto = new Foto;
                $foto->excluir_u($id);
                $inseto = new Inseto;
                $inseto->excluir($id);
                header('location: listar.php?conteudo=1&pesquisa');
                break;

            case 2:
                // include 'classes/ordem.class.php';
                // include 'classes/familia.class.php';
                // include 'classes/inseto.class.php';
                // include 'classes/fotos.class.php';
                // $fam = new Familia;
                // $ins = new Inseto;
                // $fot = new Foto;
                // $ordem = new Ordem;
                // $ordem->excluir($id);
                header('location: listar.php?conteudo=2&pesquisa');
                break;

            case 3:
                // include 'classes/familia.class.php';
                // $familia = new Familia;
                // $familia->excluir($id);
                header('location: listar.php?conteudo=3&pesquisa');
                break;

            case 4:
                include 'classes/usuario.class.php';
                $usuario = new Usuario;
                $usuario->excluir($id);
                header('location: usuarios.php');
                break;

            case 5:
                include 'classes/fotos.class.php';
                $foto = new Foto;
                $foto->excluir($id);
                header('location: '.$_SERVER['HTTP_REFERER']);
                break;
        }
    }

?>