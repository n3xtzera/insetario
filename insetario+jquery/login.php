<!DOCTYPE html>
<html lang="en" >
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
    <title>Login</title>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/insetario.css">
    <link href="https://fonts.googleapis.com/css?family=Mansalva&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  </head>
  <body>
    <div id="cabecalho" style="color:white">
      <div id="content">
        <div id="for_logo" style="float:left">
          <img id="logo" class="pad" src="icones/logo.png"> 
          <span id="cabecalho_title"> Insetário virtual </span>
        </div>
      </div>
    </div>
    <div class="login-page">
      <div class="form">
        <form class="login-form" method="POST" action="processa_login.php">
          <label style="margin:0; padding:0; top:-20px; color:red;<?php if(isset($_GET['erro'])){echo 'display:block;';}else{echo 'display:none;';} ?>">e-mail ou senha incorretos!</label>
          <input type="email" placeholder="email" name="email"/>
          <input type="password" placeholder="senha" name="senha"/>
          <button>login</button>
          <p class="message"><a href="index.php">voltar</a></p>
        </form>
      </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  </body>
</html>