<head>
    <?php
        include 'cabecalho.php';
        include 'links.php';
    ?>
    <script>
        function redirect(){
            window.location.href='cadUser.php';
        }
        function excluir(c, id){
				Swal.fire({
					title: 'Você tem certeza?',
					text: "Ao deletar esse elemento, todos componentes que o compõem serão deletados também!",
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
    </script>
    <style>
        #se:hover{
            cursor:pointer;
        }
    </style>
</head>
<body style='background-color:#464f59;'>
    <div style='margin-top:100px; padding:20px; text-align:center;'>
    <h1 style='color:white;'>Gerenciamento de Usuários</h1><br>
    <?php

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['user']['coordenador'])){
            if($_SESSION['user']['coordenador'] != 1){
                header('location: index.php');
            }
                include 'classes/usuario.class.php';
                $usuario = new Usuario;
                $usuarios = $usuario->getDadosTable();
                if(count($usuarios) >= 1){
                    $table = "<table class='table table-borderless table-dark'><tr><td>Nome</td><td>email</td><td>Cargo</td><td id='options'></td></tr>";
                    for($i = 0; $i < count($usuarios) ; $i++){
                        $table .= "<tr><td style='text-align:left;'>{$usuarios[$i]['nome']}</td><td>{$usuarios[$i]['email']}</td>";
                        if($usuarios[$i]['coordenador'] == 1){
                            $table .= "<td>Coordenador</td>";
                        }else{
                            $table .= "<td>Bolsista</td>";
                        }
                        $table .= "<td style='text-align:right;'><a href='cadUser.php?alter=".$usuarios[$i]['id']."' class='btn btn-outline-info'>Alterar</a>&nbsp<button onclick='excluir(4, {$usuarios[$i]['id']})' class='btn btn-outline-danger'>Excluir</button></td></tr>";
                    }
                    $table .= "<tr id='se' style='background-color:54d370;'><td colspan='4' style='text-align:center;' onclick='redirect()'>ADICIONAR USUÁRIO</td></tr>";
                    $table .= "</table>";
                    echo $table;
                }else{
                    echo "Nenhum usuário cadastrado";
                }
        }else{
            header('location: index.php');
        }

    ?>
    </div>
</body>