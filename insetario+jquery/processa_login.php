<?php

    include_once 'classes/usuario.class.php';

    if(isset($_GET['logout'])){
        $usuario = new Usuario;
        $usuario->logout();
    }else{

        if(isset($_POST)){
            $email = $_POST['email'];
            $senha = md5($_POST['senha']);
            $usuario = new Usuario;

            $usuario->setEmail($email);
            $usuario->setSenha($senha);
            if($usuario->login()){
                header('location: index.php');
            }else{
                header('location: login.php?erro=1');
            }
        }
    }

?>