<head>
    <?php
        include 'links.php';
    ?>
</head>
<body>
    <div class="s013">
        <div align="center">
            <?php

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    include 'classes/fotos.class.php';
                    $foto = new Foto;
                    $dados = $foto->selectById($id);
                    echo "<img class='show' style='padding-bottom:5px; width:800px;' src='uploaded/".$dados[0]['foto_nome']."'/><br>";
                    echo "<a class='btn btn-info' href='".$_SERVER['HTTP_REFERER']."'>Voltar</a>";      
                } 

            ?>
        </div>
    </div>
</body>