<html>
  <head>
    <title>Página principal</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php
      include 'links.php';
    ?>
  </head>
  <body>
    <?php
      include 'cabecalho.php'
    ?>
    <div class="s013">
      <form method="get" action='listar.php'>
        <div align="center">
          <h1 id="titulo">INSETÁRIO IFRS</h1>
        </div>
        <div class="inner-form">
          <div class="left">
            <div class="input-wrap first">
              <div class="input-field first">
                <label>pesquisa...</label>
                <input name="pesquisa" type="text" placeholder="ex: joaninha, besouro, borboleta" />
              </div>
            </div>
            <div class="input-wrap second">
              <div class="input-field second">
                <label>pesquisar por...</label>
                <div class="input-select">
                  <select data-trigger="" name="conteudo">
                    <option value='1' selected>Inseto</option>
                    <option value='2'>Ordem</option>
                    <option value='3'>Família</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn-search" type="button">PESQUISAR</button>
        </div>
        <br>
        <br>
      </form>
      <footer id="footer">
        <h6>Contato: <a href="#">regina.borba@ifrs.edu.br</a></h6>
      </footer>
    </div>
    <script src="js/extention/choices.js"></script>
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>
  </body>
</html>
