<!-- Basic dropdown -->
<button class="btn btn-primary mr-4" style="background-color:white; color:black;" type="button" data-toggle="dropdown"
aria-haspopup="true" aria-expanded="false"  id="user-menu"><img src="icones/user.png" id="user-img"><img src="icones/down.png" height="10"></button>

<div class="dropdown-menu" style="margin-right:35px;">
    <label class="dropdown-item"><?php echo "Olá ".$_SESSION['user']['nome']; ?></label>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="index.php">Página inicial</a>
    <a class="dropdown-item" href="cadOrdem.php">Cadastrar ordem</a>
    <a class="dropdown-item" href="cadFamilia.php">Cadastrar família</a>
    <a class="dropdown-item" href="usuarios.php">Gerenciar usuários</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="processa_login.php?logout=true">Logout</a>
</div>