<?php

    session_start();
    if(isset($_SESSION['logado'])){
        if($_SESSION['logado'] == true){
            if(isset($_SESSION['user']['coordenador'])){
            }else{
                header('location: index.php');
            }
        }else{
            header('location: index.php');    
        }
    }else{
        header('location: index.php');
    }

?>