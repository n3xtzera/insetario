<div id="cabecalho" style="color:white">
		<script>
			function redirect(){
        		window.location.href = 'login.php';
      		}
		</script>
      <div id="content">
        <div id="for_logo" style="float:left">
          	<a href='index.php'><img id="logo" class="pad" src="icones/logo.png"></a> 
          	<span id="cabecalho_title"> Insetário virtual </span>
        </div>
        <div id="login" style="float: right;">
			<?php
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				if(isset($_SESSION['logado'])){
					if($_SESSION['logado'] == true){
						if($_SESSION['user']['coordenador'] == true){
							include 'coordenador_menu.php';
						}else{
							include 'bolsista_menu.php';
						}
					}else{
						echo '<button id="white" type="button" style="border-radius:3px;" class="btn btn-success blable" onclick="redirect()"><span id="login_text"> LOGIN </span></button>';
					}
				}else{
					echo '<button id="white" type="button" style="border-radius:3px;" class="btn btn-success blable" onclick="redirect()"><span id="login_text"> LOGIN </span></button>';
				}
			?>
        </div>
      </div>
</div>