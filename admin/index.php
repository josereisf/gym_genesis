<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard com Sidebar</title>
  <link rel="stylesheet" href="../css/admin.css" />
  <link id="bootstrap-css" rel="stylesheet" href="../css/bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="logo">Meu Dashboard</div>
    <nav class="nav">
      <a href="index.php?pagina=tabela" id="tabela-admin"><i class="fas fa-table"></i> Tabela</a>
      <a href="index.php?pagina=card" id="card-admin"><i class="fas fa-th-large"></i> Cards</a>
      <a href="index.php?pagina=formulario_produtos" id="formulario-admin"><i class="fas fa-edit"></i> Formulário</a>
      <a href="index.php?pagina=estatistica" id="estatistica-admin"><i class="fas fa-chart-line"></i> Estatísticas</a>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </nav>
  </div>

  <!-- Botão para abrir/fechar o sidebar em dispositivos móveis -->
  <button class="sidebar-toggle" id="sidebarToggle">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Conteúdo Principal -->
  <div class="main-content" id="mainContent">
    <div class="container-admin">
      <div class="content" id="principal-admin">
        <!-- Conteúdo dinâmico aqui -->
        <?php
        require_once '../php/funcao.php';

        if (isset($_GET['pagina']) && ($_GET['pagina'] == 'tabela')) {
          tabelaProdutos();
        } else if (isset($_GET['pagina']) && ($_GET['pagina'] == 'card')) {
          listarprodutosAdmin();
        } else if (isset($_GET['pagina']) && ($_GET['pagina'] == 'formulario_produtos')) {
          formularioProdutos();
        } else if (isset($_GET['pagina']) && ($_GET['pagina'] == 'estatistica')) {
          estatisticaProdutos();
        }else if (isset($_GET['pagina']) && ($_GET['pagina'] == 'atualizar')) {
          $id = $_POST['id'];
          $nome = $_POST['nome'];
          $preco = $_POST['preco'];
          $descricao = $_POST['descricao'];
          $link = $_POST['link'];
          $imagem = $_POST['imagem'];
          $categoria = $_POST['categoria'];

          atualizarProduto($id, $nome, $preco, $descricao, $link, $imagem, $categoria);
        }else {
          echo "<p class='info'>Clique no botão para carregar o conteúdo.</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2025 Meu Dashboard. Todos os direitos reservados.</p>
  </footer>

  <script src="../js/admin.js"></script>
  <script src="../js/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
