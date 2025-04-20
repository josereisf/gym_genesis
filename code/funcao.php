<?php

function conectar()
{

  $servidor = "db";
  $user = "root";
  $password = "123";
  $banco = "gym_genesis";

  return mysqli_connect($servidor, $user, $password, $banco);
}

function desconectar($conexao)
{
  $conexao = conectar();

  mysqli_close($conexao);
}
function cadastrarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo)
{
  $conexao = conectar();
  $senhahash = password_hash($senha, PASSWORD_DEFAULT);
  $sql = 'INSERT INTO usuario (nome, senha, email, cpf, data_de_nascimento, telefone, foto_de_perfil, numero_matricula, tipo_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssssssssi', $nome, $senhahash, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarUsuario($nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo, $idusuario)
{
  $conexao = conectar();
  $sql = 'UPDATE usuario SET nome=?, senha=?, email=?, cpf=?, data_de_nascimento=?, telefone=?, foto_de_perfil=?, numero_matricula=?, tipo_usuario=? WHERE idusuario=?';
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'ssssssssii', $nome, $senha, $email, $cpf, $data_nasc, $telefone, $foto_perfil, $numero_matricula, $tipo, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarUsuario($idusuario)
{
  $conexao = conectar();
  $sql = "DELETE FROM usuario WHERE idusuario = ?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function loginUsuario($email, $senha)
{
  $conexao = conectar();
  $sql = "SELECT senha FROM usuario WHERE email = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 's', $email);
  mysqli_stmt_execute($comando);
  mysqli_stmt_bind_result($comando, $senhahash);
  mysqli_stmt_fetch($comando);
  $tf = password_verify($senha, $senhahash);
  if ($senhahash && password_verify($senha, $senhahash)) {
    $resul = 1;
  } else {
    $resul = 0;
  }
  return $resul;
}
function cadastrarEndereco($id, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo)
{
  $conexao = conectar();
  if ($tipo == 1) {
    $tipoid = "usuario_id";
  } else {
    $tipoid = "funcionario_id";
  }
  $sql = 'INSERT INTO endereco (' . $tipoid . ', cep, rua, numero, complemento, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'isssssss', $id, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarEndereco($cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo, $id)
{
  $conexao = conectar();
  if ($tipo == 1) {
    $tipoid = "usuario_id";
  } else {
    $tipoid = "funcionario_id";
  }
  $sql = 'UPDATE endereco SET cep=?, rua=?, numero=?, complemento=?, bairro=?, cidade=?, estado=? WHERE ' . $tipoid . '=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssssssi', $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $id);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarEndereco($id, $tipo)
{
  $conexao = conectar();
  if ($tipo == 1) {
    $tipoid = "usuario_id";
  } else {
    $tipoid = "funcionario_id";
  }
  $sql = "DELETE FROM endereco WHERE " . $tipoid . "= ?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $id);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarEnderecos($id, $tipo)
{
  $conexao = conectar();
  if ($id == null and $tipo == null) {
    $sql = 'SELECT * FROM endereco';
    $comando = mysqli_prepare($conexao, $sql);
  } else {
    if ($tipo == 1) {
      $tipoid = "usuario_id";
    } else {
      $tipoid = "funcionario_id";
    }
    if ($id == null) {
      $sql = 'SELECT * FROM endereco WHERE ' . $tipoid . ' IS NOT NULL';
      $comando = mysqli_prepare($conexao, $sql);
    } else {
      $sql = 'SELECT * FROM endereco WHERE ' . $tipoid . ' =?';
      $comando = mysqli_prepare($conexao, $sql);
      mysqli_stmt_bind_param($comando, 'i', $id);
    }
  }
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_enderecos = [];
    while ($endereco = mysqli_fetch_assoc($resultados)) {
      $lista_enderecos[] = $endereco;
    }
    mysqli_stmt_close($comando);

    return $lista_enderecos;
}
function listarFuncionarios($idfuncionario)
{
  $conexao = conectar();
  if ($idfuncionario != null) {
    $sql = 'SELECT * FROM funcionario WHERE idfuncionario=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idfuncionario);
  } else {
    $sql = 'SELECT * FROM funcionario';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_funcionarios = [];
  while ($funcionario = mysqli_fetch_assoc($resultados)) {
    $lista_funcionarios[] = $funcionario;
  }
  mysqli_stmt_close($comando);

  return $lista_funcionarios;
}
function deletarFuncionario($idfuncionario)
{
  $conexao = conectar();
  $sql = "DELETE FROM funcionario WHERE idfuncionario = ?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idfuncionario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarProdutos()
{
  $conexao = conectar();
  $sql = "SELECT * FROM `produtos` ORDER BY RAND() limit 4";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_execute($comando);

  $resultado = mysqli_stmt_get_result($comando);



  while ($row = mysqli_fetch_array($resultado)) {
    $nome = $row['nome'];
    $preco = $row['preco'];
    $descricao = $row['descricao'];
    $imagem = $row['imagem'];
    $link = $row['link'];

    echo " <a href = '$link' class='product-link'>
                     <div class='product-card'>
                    <img src='$imagem'
                        alt='Product Image'>
                    <div class='info'>
                        <h3>$nome</h3>
                        <p>$descricao</p>
                        <div class='price'>R$ $preco</div>
                    </div>
                    <div class='price-badge'>New</div>
                </div>
            </a>";
  }


  desconectar($conexao);
  // return $resultado;
}

function tabelaProdutos()
{
  echo "<h1>Listagem de Produtos</h1>";
  echo "<table id='tabelaProdutos'>"; // Adicione um ID à tabela
  echo "<thead>";
  echo "  <tr>";
  echo "    <th>#</th>";
  echo "    <th>Nome</th>";
  echo "    <th>Preço</th>";
  echo "    <th>Descrição</th>";
  echo "    <th>Imagem</th>";
  echo "    <th>Categoria</th>";
  echo "    <th>Link</th>";
  echo "    <th colspan='2'>Ações</th>";
  echo "  </tr>";
  echo "</thead>";
  echo "<tbody>";

  require_once '../php/funcao.php';

  $conexao = conectar();
  $sql = "SELECT * FROM `produtos`";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_execute($comando);
  $resultado = mysqli_stmt_get_result($comando);

  while ($row = mysqli_fetch_assoc($resultado)) {
    $id = $row['idproduto'];
    $nome = htmlspecialchars($row['nome']); // Evita XSS
    $preco = "R$ " . number_format($row['preco'], 2, ',', '.'); // Formatação BRL
    $descricao = htmlspecialchars($row['descricao']);
    $imagem = htmlspecialchars($row['imagem']);
    $categoria = htmlspecialchars($row['categoria']);
    $link = htmlspecialchars($row['link']);

    echo "<tr>";
    echo "  <td>$id</td>";
    echo "  <td>$nome</td>";
    echo "  <td>$preco</td>";
    echo "  <td>$descricao</td>";
    echo "  <td><img src='$imagem' alt='Imagem de $nome' width='80'></td>";
    echo "  <td>$categoria</td>";
    echo "  <td><a href='$link' target='_blank' class='btn-link'>Ver Produto</a></td>";
    echo "  <td><a href='../php/editar_produtos.php?id=$id' class='btn-editar'>Editar</a></td>";
    echo "  <td><a href='../php/excluir_produtos.php?id=$id' class='btn-excluir' onclick='return confirm(\"Tem certeza que deseja excluir este produto?\")'>Excluir</a></td>";
    echo "</tr>";
  }

  desconectar($conexao);

  echo "</tbody>";
  echo "</table>";
}


function formularioProdutos()
{
  echo "<h1>Cadastro de Produtos</h1>

    <form action='../php/cadastro_produtos.php' method='post' class='was-validated p-4 rounded shadow bg-light' enctype='multipart/form-data' novalidate>

        <!-- Nome do Produto -->
        <div class='mb-3'>
          <label for='validationNome' class='form-label fw-bold'>Nome do Produto</label>
          <input type='text' class='form-control' id='validationNome' name='nome' placeholder='Digite o nome do produto' required>
          <div class='invalid-feedback'>Por favor, insira um nome válido.</div>
        </div>

        <!-- Preço -->
        <div class='mb-3'>
          <label for='validationPreco' class='form-label fw-bold'>Preço (R$)</label>
          <input type='number' class='form-control' id='validationPreco' name='preco' step='0.01' min='0' pattern='^\d+(\.\d{1,2})?$' placeholder='Exemplo: 99.90' required>
          <div class='invalid-feedback'>Insira um preço válido no formato correto.</div>
        </div>

        <!-- Categoria -->
        <div class='mb-3'>
          <label for='validationCategoria' class='form-label fw-bold'>Categoria</label>
          <select class='form-control' id='validationCategoria' name='categoria' onchange='mostrarOutraCategoria(this)' required>
            <option value='' selected disabled>Escolha uma categoria...</option>
            <option value='Eletrônicos'>Eletrônicos</option>
            <option value='Roupas'>Roupas</option>
            <option value='Acessórios'>Acessórios</option>
            <option value='Casa e Decoração'>Casa e Decoração</option>
            <option value='Outros'>Outros</option>
          </select>
          <div class='invalid-feedback'>Selecione uma categoria.</div>
        </div>

        <!-- Campo para nova categoria -->
        <div class='mb-3' id='outraCategoriaDiv' style='display: none;'>
          <label for='outraCategoria' class='form-label fw-bold'>Outra Categoria</label>
          <input type='text' class='form-control' id='outraCategoria' name='outraCategoria' placeholder='Digite uma nova categoria'>
        </div>

        <!-- Descrição -->
        <div class='mb-3'>
          <label for='validationDescricao' class='form-label fw-bold'>Descrição</label>
          <textarea class='form-control' id='validationDescricao' name='descricao' placeholder='Descreva o produto em detalhes' rows='3' required></textarea>
          <div class='invalid-feedback'>A descrição é obrigatória.</div>
        </div>

        <!-- Link do Produto -->
        <div class='mb-3'>
          <label for='validationLink' class='form-label fw-bold'>Link do Produto</label>
          <input type='url' class='form-control' id='validationLink' name='link' placeholder='https://exemplo.com/produto' required>
          <div class='invalid-feedback'>Insira um link válido.</div>
        </div>

        <!-- Upload de Imagem -->
        <div class='mb-3'>
          <label for='validationImagem' class='form-label fw-bold'>Imagem do Produto</label>
          <input type='file' class='form-control' id='validationImagem' name='imagem' accept='image/*' required>
          <div class='invalid-feedback'>Por favor, envie uma imagem válida.</div>
        </div>

        <!-- Botão de Envio -->
        <div class='d-grid'>
          <button class='btn btn-success btn-lg' type='submit'>
            <i class='bi bi-check-circle'></i> Cadastrar Produto
          </button>
        </div>

      </form>

      <script>
        function mostrarOutraCategoria(select) {
          var outraCategoriaDiv = document.getElementById('outraCategoriaDiv');
          if (select.value === 'Outros') {
            outraCategoriaDiv.style.display = 'block';
          } else {
            outraCategoriaDiv.style.display = 'none';
          }
        }
      </script>";
}

function estatisticaProdutos()
{
  $conexao = conectar();

  // Consulta para contar o total de produtos
  $sqlTotal = "SELECT COUNT(*) as total FROM `produtos`";
  $comando = mysqli_prepare($conexao, $sqlTotal);
  mysqli_stmt_execute($comando);
  $resultadoTotal = mysqli_stmt_get_result($comando);
  $totalProdutos = $resultadoTotal->fetch_assoc()['total']; // Correção aqui

  // Consulta para encontrar o produto mais caro
  $sqlMaxPreco = "SELECT nome, preco FROM `produtos` ORDER BY preco DESC LIMIT 1";
  $stmt = mysqli_prepare($conexao, $sqlMaxPreco);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);
  $produtoMaisCaro = $resultado->fetch_assoc();


  // Consulta para encontrar o produto mais barato
  $sqlMinPreco = "SELECT nome, preco FROM `produtos` ORDER BY preco ASC LIMIT 1";
  $resultadoMinPreco = mysqli_query($conexao, $sqlMinPreco);
  $produtoMaisBarato = mysqli_fetch_assoc($resultadoMinPreco);

  // Consulta para calcular a média de preços
  $sqlMediaPreco = "SELECT AVG(preco) as media_preco FROM `produtos`";
  $resultadoMediaPreco = mysqli_query($conexao, $sqlMediaPreco);
  $mediaPreco = mysqli_fetch_assoc($resultadoMediaPreco)['media_preco'];

  // Exibindo os resultados
  echo "<div class='container-admin'>
              <div class='content'>
                <h1>Estatísticas de Produtos</h1>
                <div class='card-estatistica'>
                  <div class='card-body'>
                    <h2 class='card-title'>Total de Produtos</h2>
                    <p class='card-text'>$totalProdutos</p>
                  </div>
                </div>

                <div class='card-estatistica'>
                  <div class='card-body'>
                    <h2 class='card-title'>Produto Mais Caro</h2>
                    <p class='card-text text-success'>{$produtoMaisCaro['nome']} - R$ " . number_format($produtoMaisCaro['preco'], 2, ',', '.') . "</p>
                  </div>
                </div>

                <div class='card-estatistica'>
                  <div class='card-body'>
                    <h2 class='card-title'>Produto Mais Barato</h2>
                    <p class='card-text text-danger'>{$produtoMaisBarato['nome']} - R$ " . number_format($produtoMaisBarato['preco'], 2, ',', '.') . "</p>
                  </div>
                </div>

                <div class='card-estatistica'>
                  <div class='card-body'>
                    <h2 class='card-title'>Média de Preços</h2>
                    <p class='card-text text-info'>R$ " . number_format($mediaPreco, 2, ',', '.') . "</p>
                  </div>
                </div>
          </div>
      </div>";

  desconectar($conexao);

  return $totalProdutos;
}


function listarprodutosAdmin()
{

  $conexao = conectar();
  $sql = "SELECT * FROM `produtos`";
  $resultado = mysqli_query($conexao, $sql);

  echo "         <h1>Produtos</h1>

    <div class='container'>";
  while ($row = mysqli_fetch_array($resultado)) {
    $nome = $row['nome'];
    $preco = $row['preco'];
    $descricao = $row['descricao'];
    $imagem = $row['imagem'];
    $link = $row['link'];

    echo "

            <div class='card' style='width: 18rem;'>
  <img src='$imagem' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$nome</h5>
    <p class='card-text'>$descricao</p>
    <a href='$link' class='btn btn-primary'>Go somewhere</a>
  </div>
</div>";
  }
  echo "</div>";
  desconectar($conexao);
}

function editarProduto($id)
{
  $conexao = conectar();
  $sql = "SELECT * FROM `produtos` WHERE idproduto = $id";
  $resultado = mysqli_query($conexao, $sql);
  $produto = mysqli_fetch_assoc($resultado);

  echo "<h1>Edição de Produto</h1>

  <form action='../admin/index.php?pagina=atualizar' method='post' class='was-validated p-4 rounded shadow bg-light' enctype='multipart/form-data' novalidate>

      <input type='hidden' name='idproduto' value='{$produto['idproduto']}'>

      <!-- Nome do Produto -->
      <div class='mb-3'>
        <label for='validationNome' class='form-label fw-bold'>Nome do Produto</label>
        <input type='text' class='form-control' id='validationNome' name='nome' value='{$produto['nome']}' required>
        <div class='invalid-feedback'>Por favor, insira um nome válido.</div>
      </div>

      <!-- Preço -->
      <div class='mb-3'>
        <label for='validationPreco' class='form-label fw-bold'>Preço (R$)</label>
        <input type='number' class='form-control' id='validationPreco' name='preco' step='0.01' min='0' value='{$produto['preco']}' required>
        <div class='invalid-feedback'>Insira um preço válido.</div>
      </div>

      <!-- Categoria -->
      <div class='mb-3'>
        <label for='validationCategoria' class='form-label fw-bold'>Categoria</label>
        <select class='form-control' id='validationCategoria' name='categoria' onchange='mostrarOutraCategoria(this)' required>
          <option value='' disabled>Escolha uma categoria...</option>
          <option value='Eletrônicos' " . ($produto['categoria'] == 'Eletrônicos' ? 'selected' : '') . ">Eletrônicos</option>
          <option value='Roupas' " . ($produto['categoria'] == 'Roupas' ? 'selected' : '') . ">Roupas</option>
          <option value='Acessórios' " . ($produto['categoria'] == 'Acessórios' ? 'selected' : '') . ">Acessórios</option>
          <option value='Casa e Decoração' " . ($produto['categoria'] == 'Casa e Decoração' ? 'selected' : '') . ">Casa e Decoração</option>
          <option value='Outros' " . ($produto['categoria'] == 'Outros' ? 'selected' : '') . ">Outros</option>
        </select>
        <div class='invalid-feedback'>Selecione uma categoria.</div>
      </div>

      <!-- Campo para nova categoria -->
      <div class='mb-3' id='outraCategoriaDiv' style='display: " . ($produto['categoria'] == 'Outros' ? 'block' : 'none') . ";'>
        <label for='outraCategoria' class='form-label fw-bold'>Outra Categoria</label>
        <input type='text' class='form-control' id='outraCategoria' name='outraCategoria' value='" . ($produto['categoria'] == 'Outros' ? $produto['categoria'] : '') . "' placeholder='Digite uma nova categoria'>
      </div>

      <!-- Descrição -->
      <div class='mb-3'>
        <label for='validationDescricao' class='form-label fw-bold'>Descrição</label>
        <textarea class='form-control' id='validationDescricao' name='descricao' rows='3' required>{$produto['descricao']}</textarea>
        <div class='invalid-feedback'>A descrição é obrigatória.</div>
      </div>

      <!-- Link do Produto -->
      <div class='mb-3'>
        <label for='validationLink' class='form-label fw-bold'>Link do Produto</label>
        <input type='url' class='form-control' id='validationLink' name='link' value='{$produto['link']}' required>
        <div class='invalid-feedback'>Insira um link válido.</div>
      </div>

      <!-- Upload de Imagem -->
      <div class='mb-3'>
        <label for='validationImagem' class='form-label fw-bold'>Imagem do Produto</label>
        <input type='file' class='form-control' id='validationImagem' name='imagem' accept='image/*'>
        <div class='invalid-feedback'>Por favor, envie uma imagem válida.</div>
      </div>

      <!-- Botão de Envio -->
      <div class='d-grid'>
        <button class='btn btn-success btn-lg' type='submit'>
          <i class='bi bi-check-circle'></i> Atualizar Produto
        </button>
      </div>

    </form>

    <script>
      function mostrarOutraCategoria(select) {
        var outraCategoriaDiv = document.getElementById('outraCategoriaDiv');
        if (select.value === 'Outros') {
          outraCategoriaDiv.style.display = 'block';
        } else {
          outraCategoriaDiv.style.display = 'none';
        }
      }
    </script>";

  desconectar($conexao);
}

function atualizarProduto($id, $nome, $preco, $descricao, $link, $imagem, $categoria, $outraCategoria = "ada")
{
  $conexao = conectar();

  // Verifica se a categoria é "Outros" e se foi fornecida uma nova categoria
  if ($categoria === 'Outros' && !empty($outraCategoria)) {
    $categoria = $outraCategoria; // Usa a nova categoria digitada pelo usuário
  }

  // Atualiza o produto no banco de dados
  $sql = "UPDATE `produtos`
          SET `nome` = '$nome',
              `preco` = '$preco',
              `descricao` = '$descricao',
              `link` = '$link',
              `imagem` = '$imagem',
              `categoria` = '$categoria'
          WHERE `produtos`.`idproduto` = $id";

  $resultado = mysqli_query($conexao, $sql);

  if (!$resultado) {
    die("Erro ao atualizar o produto: " . mysqli_error($conexao));
  }

  desconectar($conexao);

  // Redireciona para a página da tabela de produtos
  echo "<script>window.location.href = '../admin/index.php?pagina=tabela';</script>";
  exit();
}

function excluirProduto($id)
{
  $conexao = conectar();

  $id = $_GET['id'];
  $sql = "DELETE FROM `produtos` WHERE idproduto = $id";
  $resultado = mysqli_query($conexao, $sql);

  if (!$resultado) {
    die("Erro ao excluir o produto: " . mysqli_error($conexao));
  }

  desconectar($conexao);

  // Redireciona para a página da tabela de produtos
  echo "<script>window.location.href = '../admin/index.php?pagina=tabela';</script>";
  exit();
}


function listarProdutos2()
{
  $conexao = conectar();
  $sql = "SELECT * FROM `produtos` ORDER BY RAND() limit 3";
  $resultado = mysqli_query($conexao, $sql);


  while ($row = mysqli_fetch_array($resultado)) {
    $nome = $row['nome'];
    $preco = $row['preco'];
    $descricao = $row['descricao'];
    $imagem = $row['imagem'];
    $link = $row['link'];

    echo " <a href = '$link' class='product-link'>
                     <div class='product-card'>
                    <img src='$imagem'
                        alt='Product Image'>
                    <div class='info'>
                        <h3>$nome</h3>
                        <p>$descricao</p>
                        <div class='price'>R$ $preco</div>
                    </div>
                    <div class='price-badge'>New</div>
                </div>
            </a>";
  }


  desconectar($conexao);
  // return $resultado;
}
function listarCategorias(): void
{
  $conexao = conectar();
  $sql = "SELECT DISTINCT `categoria` FROM `produtos`"; // Busca categorias únicas
  $resultado = mysqli_query($conexao, $sql);

  if (mysqli_num_rows($resultado) > 0) {
    echo "<div class='category-selector'>
              <h2>Escolha uma Categoria</h2>
              <form method='get' action='index.php'>
                  <select name='categoria' id='categoriaSelect'>
                      <option value=''>Selecione uma categoria</option>";

    while ($row = mysqli_fetch_array($resultado)) {
      $categoria = $row['categoria'];
      echo "<option value='$categoria'>$categoria</option>";
    }

    echo "</select>
            <button type='submit' name='confirmar' class='confirm-button'>Confirmar</button>
            </form>
            </div>";
  } else {
    echo "<p>Nenhuma categoria encontrada.</p>";
  }

  desconectar($conexao);
}

function listarProdutosPorCategoria($categoria): void
{
  $conexao = conectar();
  $sql = "SELECT * FROM `produtos` WHERE `categoria` = '$categoria' ORDER BY RAND() LIMIT 3"; // Seleciona 3 produtos da mesma categoria
  $resultado = mysqli_query($conexao, $sql);

  if (mysqli_num_rows($resultado) > 0) {
    echo "<div class='featured-collections'>
              <h2>Produtos da Categoria: $categoria</h2>
              <div class='collections-grid'>";

    while ($row = mysqli_fetch_array($resultado)) {
      $nome = $row['nome'];
      $descricao = $row['descricao'];
      $imagem = $row['imagem'];
      $link = $row['link'];

      echo "<div class='collection-card'>
                  <img src='$imagem' alt='$nome'>
                  <div class='info'>
                      <h3>$nome</h3>
                      <p>$descricao</p>
                      <a href='$link' class='cta-button'>Ver Produto</a>
                  </div>
                </div>";
    }

    echo "</div></div>";
  } else if ($categoria == null) {
    echo "";
  } else {
    echo "<p>Nenhum produto encontrado para a categoria: $categoria</p>";
  }

  desconectar($conexao);
}
