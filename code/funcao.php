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
  $id = $idusuario;
  $tipo = 1;
  deletarEndereco($id, $tipo);
  deletarAssinatura($idusuario);
  deletarAvaliacaoFisica($idusuario);
  deletarDieta($idusuario);
  deletarMetaPorIDUsuario($idusuario);
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
  $sql = " SELECT senha FROM usuario WHERE email = ?";
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
  $sql = ' INSERT INTO endereco (' . $tipoid . ', cep, rua, numero, complemento, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
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
  $id = $idfuncionario;
  $tipo = 2;
  deletarEndereco($id, $tipo);
  $sql = "DELETE FROM funcionario WHERE idfuncionario = ?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idfuncionario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarFuncionarioCargo($idcargo)
{
  $conexao = conectar();
  $sql = 'SELECT idfuncionario FROM funcionario WHERE cargo_id = ?';
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'i', $idcargo);
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  while ($idfuncionario = mysqli_fetch_assoc($resultados)) {
    deletarFuncionario($idfuncionario);
  }
  mysqli_stmt_close($comando);
  desconectar($conexao);
}
function editarCargo($idcargo, $nome, $descricao)
{
  $conexao = conectar();

  $sql = 'UPDATE cargo SET nome=?, descricao=? WHERE idcargo=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $nome, $descricao, $idcargo);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarCargo($idcargo)
{
  $conexao = conectar();
  deletarFuncionarioCargo($idcargo);
  $sql = "DELETE FROM cargo WHERE idcargo=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idcargo);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarAssinatura($data_inicio, $data_fim, $idusuario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO assinatura (data_inicio, data_fim, usuario_idusuario) VALUES (?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $data_inicio, $data_fim, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function renovarAssinatura($idusuario, $data_inicio, $data_fim)
{
  $conexao = conectar();

  $sql = 'UPDATE assinatura SET data_inicio=?, data_fim=? WHERE usuario_idusuario=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $data_inicio, $data_fim, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarAssinatura($idusuario)
{
  $conexao = conectar();
  $sql = "DELETE FROM assinatura WHERE usuario_idusuario=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarPlano($tipo, $duracao, $idassinatura)
{
  $conexao = conectar();

  $sql = 'INSERT INTO plano (tipo, duracao, assinatura_idassinatura) VALUES (?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $tipo, $duracao, $idassinatura);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarPlano($idplano, $tipo, $duracao)
{
  $conexao = conectar();

  $sql = 'UPDATE plano SET tipo=?, duracao=? WHERE idplano=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $tipo, $duracao, $idplano);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarPlanos($idplano)
{
  $conexao = conectar();
  if ($idplano != null) {
    $sql = 'SELECT * FROM plano WHERE idplano=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idplano);
  } else {
    $sql = 'SELECT * FROM plano';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_planos = [];
  while ($plano = mysqli_fetch_assoc($resultados)) {
    $lista_planos[] = $plano;
  }
  mysqli_stmt_close($comando);

  return $lista_planos;
}
function editarMetaUsuario($idmeta, $descricao, $data_inicio, $data_limite, $status)
{
  $conexao = conectar();

  $sql = 'UPDATE meta_usuario SET descricao=?, data_inicio=?, data_limite=?, status=? WHERE idmeta=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssssi', $descricao, $data_inicio, $data_limite, $status, $idmeta);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarMetaUsuario($idmeta)
{
  $conexao = conectar();

  $sql = 'DELETE FROM meta_usuario WHERE idmeta=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idmeta);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarMetaPorIDUsuario($idusuario)
{
  $conexao = conectar();

  $sql = 'DELETE FROM meta_usuario WHERE usuario_id=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarTreino($tipo, $horario, $descricao, $idusuario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO treino (tipo, horario, descricao, usuario_idusuario) VALUES (?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssi', $tipo, $horario, $descricao, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarTreino($tipo, $horario, $descricao, $idtreino)
{
  $conexao = conectar();

  $sql = ' UPDATE treino SET tipo=?, horario=?, descricao=? WHERE idtreino=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssi', $tipo, $horario, $descricao, $idtreino);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

function deletarAvaliacaoFisica($idusuario)
{
  $conexao = conectar();
  $sql = " DELETE FROM avaliacao_fisica WHERE usuario_idusuario=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarDieta($descricao, $data_inicio, $data_fim, $idusuario)
{
  $conexao = conectar();

  $sql = 'UPDATE dieta SET descricao=?, data_inicio=?, data_fim=? WHERE usuario_idusuario=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssi', $descricao, $data_inicio, $data_fim, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarDieta($idusuario)
{
  $conexao = conectar();
  $sql = "DELETE FROM dieta WHERE usuario_idusuario=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarDietas($idusuario)
{
  $conexao = conectar();
  if ($idusuario != null) {
    $sql = 'SELECT * FROM dieta WHERE usuario_idusuario=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
  } else {
    $sql = 'SELECT * FROM dieta';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_dietas = [];
  while ($dieta = mysqli_fetch_assoc($resultados)) {
    $lista_dietas[] = $dieta;
  }
  mysqli_stmt_close($comando);

  return $lista_dietas;
}
function deletarTreinoExercicio($idtreino2)
{
  $conexao = conectar();
  $sql = " DELETE FROM treino_exercicio WHERE idtreino2=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idtreino2);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarTreinoExercicio($idtreino2)
{
  $conexao = conectar();
  if ($idtreino2 != null) {
    $sql = ' SELECT * FROM treino_exercicio WHERE usuario_idusuario=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idtreino2);
  } else {
    $sql = ' SELECT * FROM treino_exercicio';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_treinos = [];
  while ($treino = mysqli_fetch_assoc($resultados)) {
    $lista_treinos[] = $treino;
  }
  mysqli_stmt_close($comando);

  return $lista_treinos;
}
function editarExercicio($idexercicio, $nome, $grupo_muscular, $descricao, $video_url)
{
  $conexao = conectar();

  $sql = ' UPDATE exercicio SET nome=?, grupo_muscular=?, descricao=?, video_url=? WHERE idexercicio=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssssi', $nome, $grupo_muscular, $descricao, $video_url, $idexercicio);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarRefeição($idrefeicao)
{
  $conexao = conectar();
  $sql = " DELETE FROM refeicao WHERE idrefeicao=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idrefeicao);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

///////////////////////////////////////////////////////////////////////////////////////// ultimo que o jose fez//////////////////////////////////////////////////////////////////////////////////////


function cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_idusuario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_idusuario) VALUES (?, ?, ?, ?, ?, ?)';

  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, "dddsdi", $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_idusuario);

  $funcionou = mysqli_stmt_execute($comando);

  mysqli_stmt_close($comando);

  desconectar($conexao);

  return $funcionou;
}


function cadastrarPagamentoDetalhe($pagamento_idpagamento, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto)
{
  $conexao = conectar();

  // Ajusta os campos de acordo com o tipo de pagamento
  switch ($tipo) {
    case 'cartao':
      $codigo_pix = null;
      $linha_digitavel_boleto = null;
      break;
    case 'pix':
      $bandeira_cartao = null;
      $ultimos_digitos = null;
      $linha_digitavel_boleto = null;
      break;
    case 'boleto':
      $bandeira_cartao = null;
      $ultimos_digitos = null;
      $codigo_pix = null;
      break;
  }

  $sql = 'INSERT INTO pagamento_detalhe 
            (pagamento_idpagamento, tipo, bandeira_cartao, ultimos_digitos, codigo_pix, linha_digitavel_boleto) 
            VALUES (?, ?, ?, ?, ?, ?)';

  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param(
    $comando,
    "isssss",
    $pagamento_idpagamento,
    $tipo,
    $bandeira_cartao,
    $ultimos_digitos,
    $codigo_pix,
    $linha_digitavel_boleto
  );

  $funcionou = mysqli_stmt_execute($comando);

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarTreinoExercicio($idtreino2, $treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos)
{
  $conexao = conectar();

  $sql = "UPDATE treino_exercicio 
          SET treino_id = ?, exercicio_id = ?, series = ?, repeticoes = ?, carga = ?, intervalo_segundos = ? 
          WHERE idtreino2 = ?";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "iiiidii", $treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos, $idtreino2);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function deletarForum($idtopico)
{
  $conexao = conectar();
  $sql = "DELETE FROM forum WHERE idtopico=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idtopico);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

function listarExercicio($idexercicio)
{
  $conexao = conectar();

  if ($idexercicio !== null) {
    $sql = " SELECT * FROM exercicio WHERE $idexercicio = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idexercicio);
  } else {
    $sql = " SELECT * FROM exercicio";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_exercicios = [];
  while ($exercicio = mysqli_fetch_assoc($resultados)) {
    $lista_exercicios[] = $exercicio;
  }

  mysqli_stmt_close($comando);

  return $lista_exercicios;
}
function cadastrarTreinoExercicio($treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos)
{
  $conexao = conectar();
  $sql = " INSERT INTO treino_exercicio (treino_id, exercicio_id, series, repeticoes, carga, intervalo_segundos) VALUES (?, ?, ?, ?, ?, ?)";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, "iiiidi", $treino_id, $exercicio_id, $series, $repeticoes, $carga, $intervalo_segundos);
  $funcionou = mysqli_stmt_execute($comando);

  $idInserido = null;
  if ($funcionou) {
    $idInserido = mysqli_insert_id($conexao);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $idInserido; // retorna o ID inserido, ou null se não funcionou
}
function deletarRespostaForum($idresposta)
{
  $conexao = conectar();
  $sql = "DELETE FROM resposta_forum WHERE idresposta =?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idresposta);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

function editarAvaliacaoFisica($idavaliacao, $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_idusuario)
{
  $conexao = conectar();

  $sql = "UPDATE avaliacao_fisica 
          SET peso = ?, altura = ?, imc = ?, percentual_gordura = ?, data_avaliacao = ?, usuario_idusuario = ? 
          WHERE idavaliacao = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "ddddssi", $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_idusuario, $idavaliacao);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarItemPedido($iditem, $pedido_idpedido, $produto_idproduto, $quantidade)
{
  $conexao = conectar();

  $sql = "UPDATE item_pedido 
            SET pedido_idpedido = ?, produto_idproduto = ?, quantidade = ?
            WHERE iditem = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "iiii", $iditem, $pedido_idpedido, $produto_idproduto, $quantidade);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarFuncionario($idfuncionario, $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id)
{
  $conexao = conectar();

  $sql = "UPDATE funcionario 
            SET nome = ?, email = ?, telefone = ?, data_contratacao = ?, salario = ?, cargo_id = ?
            WHERE idfuncionario = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Correção aqui:
  mysqli_stmt_bind_param($comando, "ssssdii", $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $idfuncionario);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function listarHorario($idhorario)
{
  $conexao = conectar();

  if ($idhorario !== null) {
    $sql = " SELECT * FROM horario WHERE $idhorario = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idhorario);
  } else {
    $sql = " SELECT * FROM horario";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_horarios = [];
  while ($horario = mysqli_fetch_assoc($resultados)) {
    $lista_horarios[] = $horario;
  }

  mysqli_stmt_close($comando);

  return $lista_horarios;
}

function listarTreino($idtreino)
{
  $conexao = conectar();

  if ($idtreino !== null) {
    $sql = " SELECT * FROM treino WHERE $idtreino = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idtreino);
  } else {
    $sql = " SELECT * FROM treino";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_treinos = [];
  while ($treino = mysqli_fetch_assoc($resultados)) {
    $lista_treinos[] = $treino;
  }

  mysqli_stmt_close($comando);

  return $lista_treinos;
}

function cadastrarHistoricoTreino($usuario_id, $treino_id, $data_execucao, $observacoes)
{
  $conexao = conectar();
  $sql = " INSERT INTO historico_treino (usuario_id, treino_id, data_execucao, observacoes) VALUES (?, ?, ?, ?)";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, "iiss", $usuario_id, $treino_id, $data_execucao, $observacoes);
  $funcionou = mysqli_stmt_execute($comando);

  $idInserido = null;
  if ($funcionou) {
    $idInserido = mysqli_insert_id($conexao);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $idInserido; // retorna o ID inserido, ou null se não funcionou
}

function listarAulaAgendada($idaula)
{
  $conexao = conectar();

  if ($idaula !== null) {
    $sql = " SELECT * FROM aula_agendada WHERE $idaula = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idaula);
  } else {
    $sql = " SELECT * FROM aula_agendada";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_aula_agendadas = [];
  while ($aula_agendada = mysqli_fetch_assoc($resultados)) {
    $lista_aula_agendadas[] = $aula_agendada;
  }

  mysqli_stmt_close($comando);

  return $lista_aula_agendadas;
}

function listarPagamentosDetalhados($idpagaemento2)
{
  $conexao = conectar();

  if ($idpagaemento2 !== null) {
    $sql = " SELECT * FROM pagamento_detalhado WHERE $idpagaemento2 = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idpagaemento2);
  } else {
    $sql = " SELECT * FROM pagamento_detalhado";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_pagamento_detalhados = [];
  while ($pagamento_detalhado = mysqli_fetch_assoc($resultados)) {
    $lista_pagamento_detalhados[] = $pagamento_detalhado;
  }

  mysqli_stmt_close($comando);

  return $lista_pagamento_detalhados;
}

function listarMetaUsuario($idmeta)
{
  $conexao = conectar();

  if ($idmeta !== null) {
    $sql = " SELECT * FROM meta_usuario WHERE $idmeta = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idmeta);
  } else {
    $sql = " SELECT * FROM meta_usuario";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_meta_usuarios = [];
  while ($meta_usuario = mysqli_fetch_assoc($resultados)) {
    $lista_meta_usuarios[] = $meta_usuario;
  }

  mysqli_stmt_close($comando);

  return $lista_meta_usuarios;
}

function listarAvaliacaoFisica($idavaliacao)
{
  $conexao = conectar();

  if ($idavaliacao !== null) {
    $sql = " SELECT * FROM avaliacao_fisica WHERE $idavaliacao = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idavaliacao);
  } else {
    $sql = " SELECT * FROM avaliacao_fisica";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_avaliacao_fisicas = [];
  while ($avaliacao_fisica = mysqli_fetch_assoc($resultados)) {
    $lista_avaliacao_fisicas[] = $avaliacao_fisica;
  }

  mysqli_stmt_close($comando);

  return $lista_avaliacao_fisicas;
}

function listarCargo($idcargo)
{
  $conexao = conectar();

  if ($idcargo !== null) {
    $sql = " SELECT * FROM cargo WHERE $idcargo = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idcargo);
  } else {
    $sql = " SELECT * FROM cargo";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_cargos = [];
  while ($cargo = mysqli_fetch_assoc($resultados)) {
    $lista_cargos[] = $cargo;
  }

  mysqli_stmt_close($comando);

  return $lista_cargos;
}

function listarRefeicoes($idrefeicao)
{
  $conexao = conectar();

  if ($idrefeicao !== null) {
    $sql = " SELECT * FROM refeicao WHERE $idrefeicao = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idrefeicao);
  } else {
    $sql = " SELECT * FROM refeicao";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_refeicaos = [];
  while ($refeicao = mysqli_fetch_assoc($resultados)) {
    $lista_refeicaos[] = $refeicao;
  }

  mysqli_stmt_close($comando);

  return $lista_refeicaos;
}

function listarAlimentos($idalimento)
{
  $conexao = conectar();

  if ($idalimento !== null) {
    $sql = " SELECT * FROM alimento WHERE $idalimento = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idalimento);
  } else {
    $sql = " SELECT * FROM alimento";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_alimentos = [];
  while ($alimento = mysqli_fetch_assoc($resultados)) {
    $lista_alimentos[] = $alimento;
  }

  mysqli_stmt_close($comando);

  return $lista_alimentos;
}

function listarCategoriaProduto($idcategoria)
{
  $conexao = conectar();

  if ($idcategoria !== null) {
    $sql = " SELECT * FROM categoria_produto WHERE $idcategoria = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idcategoria);
  } else {
    $sql = " SELECT * FROM categoria_produto";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_categoria_produtos = [];
  while ($categoria_produto = mysqli_fetch_assoc($resultados)) {
    $lista_categoria_produtos[] = $categoria_produto;
  }

  mysqli_stmt_close($comando);

  return $lista_categoria_produtos;
}



function listarRespostaForum($idresposta)
{
  $conexao = conectar();

  if ($idresposta !== null) {
    $sql = " SELECT * FROM resposta_forum WHERE $idresposta = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idresposta);
  } else {
    $sql = " SELECT * FROM resposta_forum";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_resposta_forums = [];
  while ($resposta_forum = mysqli_fetch_assoc($resultados)) {
    $lista_resposta_forums[] = $resposta_forum;
  }

  mysqli_stmt_close($comando);

  return $lista_resposta_forums;
}

function listarItensPedido($iditem)
{
  $conexao = conectar();

  if ($iditem !== null) {
    $sql = " SELECT * FROM item_pedido WHERE $iditem = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $iditem);
  } else {
    $sql = " SELECT * FROM item_pedido";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_item_pedidos = [];
  while ($item_pedido = mysqli_fetch_assoc($resultados)) {
    $lista_item_pedidos[] = $item_pedido;
  }

  mysqli_stmt_close($comando);

  return $lista_item_pedidos;
}

function listarUsuario($idusuario)
{
  $conexao = conectar();

  if ($idusuario !== null) {
    $sql = " SELECT * FROM usuario WHERE $idusuario = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idusuario);
  } else {
    $sql = " SELECT * FROM usuario";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_usuarios = [];
  while ($usuario = mysqli_fetch_assoc($resultados)) {
    $lista_usuarios[] = $usuario;
  }

  mysqli_stmt_close($comando);

  return $lista_usuarios;
}

function listarAssinaturas($idassinatura)
{
  $conexao = conectar();

  if ($idassinatura !== null) {
    $sql = " SELECT * FROM assinatura WHERE $idassinatura = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idassinatura);
  } else {
    $sql = " SELECT * FROM assinatura";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_assinaturas = [];
  while ($assinatura = mysqli_fetch_assoc($resultados)) {
    $lista_assinaturas[] = $assinatura;
  }

  mysqli_stmt_close($comando);

  return $lista_assinaturas;
}

function deletarDietaAlimento($iddieta_alimentar)
{
  $conexao = conectar();
  $sql = "DELETE FROM dieta_alimentar WHERE $iddieta_alimentar = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $iddieta_alimentar);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarPlano($idplano)
{
  $conexao = conectar();
  $sql = "DELETE FROM plano WHERE $idplano = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idplano);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarAlimento($idalimento)
{
  $conexao = conectar();
  $sql = "DELETE FROM alimento WHERE $idalimento = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idalimento);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarCategoriaProduto($idcategoria)
{
  $conexao = conectar();
  $sql = "DELETE FROM categoria_produto WHERE $idcategoria = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idcategoria);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarPagamentoDetalhe($idpagaemento2)
{
  $conexao = conectar();
  $sql = "DELETE FROM pagamento_detalhado WHERE $idpagaemento2 = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idpagaemento2);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarItemPedido($iditem)
{
  $conexao = conectar();
  $sql = "DELETE FROM item_pedido WHERE $iditem = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $iditem);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarAulaAgendada($idaula)
{
  $conexao = conectar();
  $sql = "DELETE FROM aula_agendada WHERE $idaula = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idaula);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarTreino($idtreino)
{
  $conexao = conectar();
  $sql = "DELETE FROM treino WHERE $idtreino = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idtreino);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarHistoricoTreino($idhistorico)
{
  $conexao = conectar();
  $sql = "DELETE FROM historico_treino WHERE $idhistorico = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idhistorico);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarPedido($idpedido)
{
  $conexao = conectar();
  $sql = "DELETE FROM pedido WHERE $idpedido = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idpedido);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function deletarExercicio($idexercicio)
{
  $conexao = conectar();
  $sql = "DELETE FROM exercicio WHERE $idexercicio = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idexercicio);
  mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
}

function cadastrarCategoriaProduto($nome, $descricao)
{
  $conexao = conectar();
  $sql = " INSERT INTO categoria_produto (nome, descricao) VALUES(?, ?)";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, "ss", $nome, $descricao);
  $funcionou = mysqli_stmt_execute($comando);

  $idInserido = null;
  if ($funcionou) {
    $idInserido = mysqli_insert_id($conexao);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $idInserido; // retorna o ID inserido, ou null se não funcionou
}

function editarProduto($idproduto, $nome, $descricao, $preco, $quantidade_estoque, $imagem)
{
  $conexao = conectar();

  $sql = "UPDATE produto 
          SET nome = ?, descricao = ?, preco = ?, quantidade_estoque = ?, imagem = ?
          WHERE idproduto = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "ssdisi", $nome, $descricao, $preco, $quantidade_estoque, $imagem, $idproduto);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarRespostaForum($idresposta, $mensagem, $data_resposta, $usuario_idusuario, $forum_idtopico)
{
  $conexao = conectar();

  $sql = "UPDATE resposta_forum 
          SET mensagem = ?, data_resposta = ?, usuario_idusuario = ?, forum_idtopico = ?
          WHERE idresposta = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "ssiii", $mensagem, $data_resposta, $usuario_idusuario, $forum_idtopico, $idresposta);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarProduto($nome, $descricao, $preco, $quantidade_estoque, $imagem)
{
  $conexao = conectar();

  $sql = " INSERT INTO produto (nome, descricao, preco, quantidade_estoque, imagem) VALUES (?,?,?,?,?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "ssdis", $nome, $descricao, $preco, $quantidade_estoque, $imagem);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarItemPedido($pedido_idpedido, $produto_idproduto, $quantidade)
{
  $conexao = conectar();

  $sql = " INSERT INTO item_pedido (pedido_idpedido, produto_idproduto, quantidade) VALUES (?,?,?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "iii", $pedido_idpedido, $produto_idproduto, $quantidade);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarPagamento($usuario_idusuario, $valor, $data_pagamento, $metodo, $status = 'sucesso')
{
  $conexao = conectar();

  $sql = "INSERT INTO pagamento (usuario_idusuario, valor, data_pagamento, metodo, status)
            VALUES (?, ?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "idsss", $usuario_idusuario, $valor, $data_pagamento, $metodo, $status);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function editarPedido($idpedido, $usuario_idusuario, $data_pedido, $status)
{
  $conexao = conectar();

  $sql = "UPDATE pedido 
          SET usuario_idusuario = ?, data_pedido = ?, status = ?
          WHERE idpedido = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "issi", $usuario_idusuario, $data_pedido, $status, $idpedido);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarAlimento($nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria)
{
  $conexao = conectar();

  $sql = " INSERT INTO alimento (nome, caloria, carboidratos, proteina, gordura, porcao, categoria)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "sddddss", $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarCargo($nome, $descricao){
  $conexao = conectar();

  $sql = " INSERT INTO cargo  (nome, descricao) VALUES (?, ?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "ss", $nome, $descricao);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function cadastrarExercicio($nome, $grupo_muscular, $descricao, $video_url){
  $conexao = conectar();

  $sql = " INSERT INTO exercicio  (nome, grupo_muscular, descricao,  video_url) VALUES (?, ?, ?,?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "ssss", $nome, $grupo_muscular, $descricao, $video_url );

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarAssinatura($idassinatura, $data_inicio, $data_fim, $usuario_idusuario)
{
  $conexao = conectar();

  $sql = "UPDATE assinatura 
            SET data_inicio = ?, data_fim = ?, usuario_idusuario = ?
            WHERE idassinatura = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros: data_inicio, data_fim, usuario_idusuario, idassinatura
  mysqli_stmt_bind_param($comando, "ssii", $data_inicio, $data_fim, $usuario_idusuario, $idassinatura);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function editarPagamentoDetalhe($idpagamento2, $pagamento_idpagamento, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto)
{
  $conexao = conectar();

  $sql = "UPDATE pagamento_detalhe 
            SET pagamento_idpagamento = ?, tipo = ?, bandeira_cartao = ?, ultimos_digitos = ?, codigo_pix = ?, linha_digitavel_boleto = ?
            WHERE idpagamento_detalhe = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem: pagamento_idpagamento (i), tipo (s), bandeira_cartao (s), ultimos_digitos (s), codigo_pix (s), linha_digitavel_boleto (s), idpagamento2 (i)
  mysqli_stmt_bind_param($comando, "isssssi", $pagamento_idpagamento, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto, $idpagamento2);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarDieta($descricao, $data_inicio, $data_fim, $usuario_idusuario)
{
  $conexao = conectar();

  $sql = "INSERT INTO dieta (descricao, data_inicio, data_fim, usuario_idusuario)
            VALUES (?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem dos parâmetros: descricao (s), data_inicio (s), data_fim (s), usuario_idusuario (i)
  mysqli_stmt_bind_param($comando, "sssi", $descricao, $data_inicio, $data_fim, $usuario_idusuario);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarDietaAlimento($refeicao_id, $alimento_id, $quantidade, $observacao)
{
  $conexao = conectar();

  $sql = "INSERT INTO dieta_alimento (refeicao_idrefeicao, alimento_idalimento, quantidade, observacao)
            VALUES (?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem dos parâmetros: refeicao_id (i), alimento_id (i), quantidade (d), observacao (s)
  mysqli_stmt_bind_param($comando, "iids", $refeicao_id, $alimento_id, $quantidade, $observacao);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
//

function cadastrarFuncionario($nome, $email, $telefone, $data_contratacao, $salario, $cargo_id)
{
  $conexao = conectar();

  $sql = "INSERT INTO funcionario (nome, email, telefone, data_contratacao, salario, cargo_idcargo)
            VALUES (?, ?, ?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "ssssdi", $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarRefeicao($idrefeicao, $dieta_id, $tipo, $horario)
{
  $conexao = conectar();

  $sql = "UPDATE refeicao 
            SET dieta_iddieta = ?, tipo = ?, horario = ?
            WHERE idrefeicao = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "issi", $dieta_id, $tipo, $horario, $idrefeicao);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarAlimento($idalimento, $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria)
{
  $conexao = conectar();

  $sql = "UPDATE alimento 
            SET nome = ?, calorias = ?, carboidratos = ?, proteinas = ?, gorduras = ?, porcao = ?, categoria = ?
            WHERE idalimento = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "sddddssi", $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $idalimento);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function cadastrarMetaUsuario($usuario_id, $descricao, $data_inicio, $data_limite, $status)
{
  $conexao = conectar();

  $sql = "INSERT INTO meta_usuario (usuario_idusuario, descricao, data_inicio, data_limite, status)
            VALUES (?, ?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "issss", $usuario_id, $descricao, $data_inicio, $data_limite, $status);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function cadastrarHorario($dia_semana, $hora_inicio, $hora_fim)
{
  $conexao = conectar();

  $sql = "INSERT INTO horario (dia_semana, hora_inicio, hora_fim)
            VALUES (?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "sss", $dia_semana, $hora_inicio, $hora_fim);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function cadastrarAulaAgendada($horario_idhorario, $data_aula, $usuario_idusuario)
{
  $conexao = conectar();

  $sql = "INSERT INTO aula_agendada (horario_idhorario, data_aula, usuario_idusuario)
            VALUES (?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "isi", $horario_idhorario, $data_aula, $usuario_idusuario);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
