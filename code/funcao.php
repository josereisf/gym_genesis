<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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
function listarEnderecos($tipo)
{
  $conexao = conectar();
  if ($tipo == null) {
    $sql = ' SELECT
    u.nome AS nome_usuario,
    f.nome AS nome_funcionario,
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado 
    FROM endereco AS e 
    LEFT JOIN usuario AS u ON e.usuario_id = u.idusuario 
    LEFT JOIN funcionario AS f ON e.funcionario_id = f.idfuncionario;';
    $comando = mysqli_prepare($conexao, $sql);
  } elseif ($tipo == 1) {
    $sql = ' SELECT
    u.nome AS nome_usuario,
    e.cep, e.rua, e.numero,
    e.complemento, e.bairro,
    e.cidade,
    e.estado
    FROM endereco AS e
    LEFT JOIN usuario AS u ON e.usuario_id = u.idusuario
    WHERE e.usuario_id IS NOT NULL;';
    $comando = mysqli_prepare($conexao, $sql);
  } else {
    $sql = ' SELECT f.nome AS nome_funcionario,
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado FROM endereco AS e
    LEFT JOIN funcionario AS f ON e.funcionario_id = f.idfuncionario
    WHERE e.funcionario_id IS NOT NULL;';
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_enderecos = [];
  while ($endereco = mysqli_fetch_assoc($resultados)) {
    $lista_enderecos[] = $endereco;
  }
  mysqli_stmt_close($comando);

  return $lista_enderecos; // agora retorna array puro
}
function listarEnderecosID($id, $tipo)
{
  $conexao = conectar();
  if ($tipo == 1) {
    $sql = ' SELECT u.nome AS nome_usuario,
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado
    FROM endereco AS e
    LEFT JOIN usuario AS u ON e.usuario_id = u.idusuario
    WHERE e.usuario_id=?;';
  } else {
    $sql = ' SELECT f.nome AS nome_funcionario,
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado FROM endereco AS e
    LEFT JOIN funcionario AS f ON e.funcionario_id = f.idfuncionario
    WHERE e.funcionario_id=?;';
  }
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'i', $id);
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
    $sql = ' SELECT
    f.nome,
    f.email,
    f.telefone,
    f.data_contratacao,
    f.salario,
    c.nome
    FROM funcionario AS f
    JOIN cargo AS c ON c.idcargo = f.cargo_id
    WHERE f.idfuncionario=?;';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idfuncionario);
  } else {
    $sql = ' SELECT
    f.nome,
    f.email,
    f.telefone,
    f.data_contratacao,
    f.salario,
    c.nome
    FROM funcionario AS f
    JOIN cargo AS c ON c.idcargo = f.cargo_id';
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
  $sql = " DELETE FROM funcionario WHERE idfuncionario = ?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idfuncionario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
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
    $sql = ' SELECT
    u.nome AS nome_usuario,
    d.descricao,
    d.data_inicio,
    d.data_fim
    FROM dieta AS d
    JOIN usuario AS u ON d.usuario_idusuario = u.idusuario
    WHERE d.usuario_idusuario=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
  } else {
    $sql = ' SELECT
    u.nome AS nome_usuario,
    d.descricao,
    d.data_inicio,
    d.data_fim
    FROM dieta AS d
    JOIN usuario AS u ON d.usuario_idusuario = u.idusuario

    ';
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
    $sql = ' SELECT
    e.nome,
    t.tipo,
    te.series,
    te.repeticoes,
    te.carga,
    te.intervalo_segundos
    FROM treino_exercicio AS te
    JOIN treino AS t ON te.treino_id = t.idtreino
    JOIN exercicio AS e ON te.exercicio_id = e.idexercicio
    WHERE te.idtreino2=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idtreino2);
  } else {
    $sql = ' SELECT
    e.nome,
    t.tipo,
    te.series,
    te.repeticoes,
    te.carga,
    te.intervalo_segundos
    FROM treino_exercicio AS te
    JOIN treino AS t ON te.treino_id = t.idtreino
    JOIN exercicio AS e ON te.exercicio_id = e.idexercicio';
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
function deletarProduto($idproduto)
{
  $conexao = conectar();
  $sql = " DELETE FROM produto WHERE idproduto=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idproduto);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function gerenciarVencimento($idusuario, $data_fim)
{
  $conexao = conectar();

  $sql = ' UPDATE assinatura SET data_fim=? WHERE usuario_idusuario=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'si', $data_fim, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarCupomDesconto($idusuario)
{
  $conexao = conectar();
  if ($idusuario != null) {
    $sql = 'SELECT * FROM cupom_desconto WHERE usuario_idusuario=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
  } else {
    $sql = 'SELECT * FROM cupom_desconto';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_cupons = [];
  while ($cupom = mysqli_fetch_assoc($resultados)) {
    $lista_cupons[] = $cupom;
  }
  mysqli_stmt_close($comando);

  return $lista_cupons;
}
function editarCategoriaProduto($idcategoria, $nome, $descricao)
{
  $conexao = conectar();

  $sql = ' UPDATE categoria_produto SET nome=?, descricao=? WHERE usuario_idusuario=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'si', $nome, $descricao, $idcategoria);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarPedidos($idpedido)
{
  $conexao = conectar();
  if ($idpedido != null) {
    $sql = ' SELECT
    u.nome AS nome_usuario,
    p.data_pedido,
    p.status,
    pa.valor
    FROM pedido AS p
    JOIN usuario AS u ON p.usuario_idusuario = u.idusuario
    JOIN pagamento AS pa ON p.pagamento_idpagamento = pa.idpagamento
    WHERE p.idpedido=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idpedido);
  } else {
    $sql = ' SELECT
    u.nome AS nome_usuario,
    p.data_pedido,
    p.status,
    pa.valor
    FROM pedido AS p
    JOIN usuario AS u ON p.usuario_idusuario = u.idusuario
    JOIN pagamento AS pa ON p.pagamento_idpagamento = pa.idpagamento';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_pedidos = [];
  while ($pedido = mysqli_fetch_assoc($resultados)) {
    $lista_pedidos[] = $pedido;
  }
  mysqli_stmt_close($comando);

  return $lista_pedidos;
}
function listarProdutos($idproduto)
{
  $conexao = conectar();
  if ($idproduto != null) {
    $sql = 'SELECT * FROM produto WHERE idproduto=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idproduto);
  } else {
    $sql = 'SELECT * FROM produto';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_produtos = [];
  while ($produto = mysqli_fetch_assoc($resultados)) {
    $lista_produtos[] = $produto;
  }
  mysqli_stmt_close($comando);

  return $lista_produtos;
}
function editarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idaula)
{
  $conexao = conectar();

  $sql = ' UPDATE aula_agendada SET data_aula=?, dia_semana=?, hora_inicio=?, hora_fim=? WHERE idaula=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssssi', $data_aula, $dia_semana, $hora_inicio, $hora_fim, $idaula);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarRefeicao($iddieta, $tipo, $horario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO refeicao (dieta_id, tipo, horario) VALUES (?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'isss', $iddieta, $tipo, $horario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarCupomDesconto($codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo)
{
  $conexao = conectar();

  $sql = 'INSERT INTO cupom_desconto (codigo, percentual_desconto, valor_desconto, data_validade, quantidade_uso, tipo) VALUES (?, ?, ?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sddsis', $codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarPedido($idusuario, $data_pedido, $status, $idpagamento)
{
  $conexao = conectar();

  $sql = 'INSERT INTO pedido (usuario_idusuario, data_pedido, status, pagamento_idpagamento) VALUES (?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'isssi', $idusuario, $data_pedido, $status, $idpagamento);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarRespostaForum($mensagem, $idusuario, $idtopico)
{
  $conexao = conectar();

  $sql = 'INSERT INTO resposta_forum (mensagem, usuario_idusuario, forum_idtopico) VALUES (?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sii', $mensagem, $idusuario, $idtopico);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarForum($idtopico)
{
  $conexao = conectar();
  if ($idtopico != null) {
    $sql = ' SELECT
    u.nome AS nome_usuario,
    f.titulo,
    f.descricao,
    f.data_criacao,
    FROM forum AS f
    JOIN usuario AS u, f.usuario_idusuario = u.idusuario
    WHERE f.idtopico=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idtopico);
  } else {
    $sql = 'SELECT * FROM forum';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_foruns = [];
  while ($forum = mysqli_fetch_assoc($resultados)) {
    $lista_foruns[] = $forum;
  }
  mysqli_stmt_close($comando);

  return $lista_foruns;
}
function cadastrarForum($titulo, $descricao, $data_criacao, $usuario_idusuario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO forum (titulo, descricao, data_criacao, usuario_idusuario) VALUES (?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssi', $titulo, $descricao, $data_criacao, $usuario_idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarHistoricoTreino($idhistorico)
{
  $conexao = conectar();
  if ($idhistorico != null) {
    $sql = 'SELECT
    u.nome,
    t.nome,
    ht.data_execucao,
    ht.observacoes
    FROM historico_treino AS ht
    JOIN usuario AS u ON ht.usuario_id = u.idusuario
    JOIN treino AS t ON ht.treino_id = t.idtreino
    WHERE idhistorico=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idtopico);
  } else {
    $sql = 'SELECT
    u.nome,
    t.nome,
    ht.data_execucao,
    ht.observacoes
    FROM historico_treino AS ht
    JOIN usuario AS u ON ht.usuario_id = u.idusuario
    JOIN treino AS t ON ht.treino_id = t.idtreino';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_historicos = [];
  while ($historico = mysqli_fetch_assoc($resultados)) {
    $lista_historicos[] = $historico;
  }
  mysqli_stmt_close($comando);

  return $lista_historicos;
}
function editarHistoricoTreino($idhistorico, $data_execucao, $observacoes)
{
  $conexao = conectar();

  $sql = ' UPDATE historico_treino SET data_execucao=?, observacoes=? WHERE idhistorico=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $data_execucao, $observacoes, $idhistorico);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarForum($idtopico, $titulo, $descricao, $data_criacao)
{
  $conexao = conectar();

  $sql = ' UPDATE forum SET titulo=?, descricao=?, data_criacao=? WHERE idhistorico=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssi', $titulo, $descricao, $data_criacao, $idtopico);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarCupomDesconto($idcupom, $codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo)
{
  $conexao = conectar();

  $sql = ' UPDATE cupom_desconto SET codigo=?, percentual_desconto=?, valor_desconto=?, data_validade=?, quantidade_uso=?, tipo=? WHERE idcupom=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sddsisi', $codigo, $percentual_desconto, $valor_desconto, $data_validade, $quantidade_uso, $tipo, $idcupom);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarPagamentos($idpagamento)
{
  $conexao = conectar();
  if ($idpagamento != null) {
    $sql = 'SELECT * FROM pagamento WHERE idpagamento=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idpagamento);
  } else {
    $sql = 'SELECT * FROM pagamento';
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_pagamentos = [];
  while ($pagamento = mysqli_fetch_assoc($resultados)) {
    $lista_pagamentos[] = $pagamento;
  }
  mysqli_stmt_close($comando);

  return $lista_pagamentos;
}
function editarPagamento($idpagamento, $valor, $data_pagamento, $metodo, $status)
{
  $conexao = conectar();

  $sql = ' UPDATE cupom_desconto SET valor=?, data_pagamento=?, metodo=?, status=? WHERE idpagamento=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'dsssi', $valor, $data_pagamento, $metodo, $status, $idpagamento);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarDietaAlimento($iddieta_alimentar, $quantidade, $observacao)
{
  $conexao = conectar();

  $sql = ' UPDATE dieta_alimento SET quantidade=?, observacao=? WHERE iddieta_alimentar=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'dsi', $quantidade, $observacao, $iddieta_alimentar);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function gerarCodigoDeSeguranca($email_destinatario, $idusuario)
{
  $codigo = random_int(100000, 999999);
  $expiracao = date('Y-m-d H:i:s', strtotime('+10 minutes'));

  $email = new PHPMailer(true);

  try {
    // Configurações do servidor SMTP do Gmail
    $email->isSMTP();
    $email->Host = 'smtp.gmail.com';
    $email->SMTPAuth = true;
    $email->Username = 'smtpemaile@gmail.com'; // Seu Gmail
    $email->Password = 'xjqc orkg ckls fant'; // Senha gerada no passo 2
    $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $email->Port = 587;

    // Remetente e destinatário
    $email->setFrom('smtpemaile@gmail.com', 'Jozinho');
    $email->addAddress($email_destinatario, 'Destinatário');

    // Conteúdo do e-mail em HTML
    $email->isHTML(true); // Alterado para permitir HTML
    $email->Subject = 'Recuperacao de e-mail';

    // Corpo do e-mail com HTML e CSS
    $email->Body = '
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Recuperação de Senha</title>
          <style>
            * {
              box-sizing: border-box;
              margin: 0;
              padding: 0;
            }

            body {
              font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
              background: linear-gradient(135deg, #e0f7fa, #e1bee7);
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
              animation: fadeInBody 1.2s ease-in;
            }

            @keyframes fadeInBody {
              from { opacity: 0; }
              to { opacity: 1; }
            }

            .container {
              background-color: #ffffff;
              padding: 30px;
              border-radius: 12px;
              box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
              width: 100%;
              max-width: 400px;
              text-align: center;
              animation: slideIn 0.8s ease;
            }

            @keyframes slideIn {
              from {
                transform: translateY(-40px);
                opacity: 0;
              }
              to {
                transform: translateY(0);
                opacity: 1;
              }
            }

            h2 {
              color: #4a148c;
              margin-bottom: 20px;
            }

            p {
              color: #555;
              font-size: 16px;
              margin-bottom: 10px;
            }

            .codigo {
              font-size: 32px;
              font-weight: bold;
              color: #2e7d32;
              background-color: #e8f5e9;
              padding: 15px;
              border-radius: 8px;
              margin: 20px 0;
              letter-spacing: 2px;
              animation: pulse 1.5s infinite;
            }

            @keyframes pulse {
              0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(46, 125, 50, 0.4); }
              70% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(46, 125, 50, 0); }
              100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(46, 125, 50, 0); }
            }

            .expiracao {
              font-size: 13px;
              color: #888;
            }

            @media (max-width: 480px) {
              .container {
                padding: 20px;
              }

              .codigo {
                font-size: 28px;
              }
            }
          </style>
        </head>
        <body>
          <div class="container">
            <h2>Recuperação de Senha</h2>
            <p>Esse é o seu código de segurança:</p>
            <div class="codigo">' . $codigo . '</div>
            <p class="expiracao">O código expira em: ' . $expiracao . '</p>
          </div>
        </body>
        </html>

    ';

    $email->send();
    echo 'A mensagem foi enviada com sucesso!';

    // Inserção no banco de dados
    $conexao = conectar();
    $sql = 'INSERT INTO recuperacao_senha (codigo, tempo_expiracao, usuario_idusuario) VALUES (?, ?, ?)';
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'isi', $codigo, $expiracao, $idusuario);

    mysqli_stmt_execute($comando);
    mysqli_stmt_close($comando);
    desconectar($conexao);
  } catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$email->ErrorInfo}";
  }
}

function gerarCodigosDeSegurancaa(array $emails_destinatarios, $idusuario)
{
  $resultados = [];

  foreach ($emails_destinatarios as $email_destinatario) {
    $codigo = random_int(100000, 999999);
    $expiracao = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    $email = new PHPMailer(true);

    try {
      // Configurações do servidor SMTP
      $email->isSMTP();
      $email->Host = 'smtp.gmail.com';
      $email->SMTPAuth = true;
      $email->Username = 'smtpemaile@gmail.com'; // Seu Gmail
      $email->Password = 'xjqc orkg ckls fant';  // Senha de app
      $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $email->Port = 587;

      // Remetente e destinatário
      $email->setFrom('smtpemaile@gmail.com', 'Jozinho');
      $email->addAddress($email_destinatario);

      // Conteúdo do e-mail
      $email->isHTML(true);
      $email->Subject = 'Recuperacao de e-mail';

      $email->Body = '
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
        <meta charset="UTF-8" />
        <style>
          body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background: #f4f4f4; padding: 20px; }
          .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 400px; margin: auto; }
          .codigo { font-size: 28px; font-weight: bold; color: #2e7d32; background: #e8f5e9; padding: 15px; border-radius: 6px; margin: 15px 0; text-align: center; }
          .expiracao { font-size: 14px; color: #888; text-align: center; }
        </style>
        </head>
        <body>
        <div class="container">
          <h2>Recuperação de Senha</h2>
          <p>Seu código de segurança:</p>
          <div class="codigo">' . $codigo . '</div>
          <p class="expiracao">Expira em: ' . $expiracao . '</p>
        </div>
        </body>
        </html>
      ';

      $email->send();

      // Inserir no banco de dados
      $conexao = conectar();
      $sql = 'INSERT INTO recuperacao_senha (codigo, tempo_expiracao, usuario_idusuario) VALUES (?, ?, ?)';
      $comando = mysqli_prepare($conexao, $sql);
      mysqli_stmt_bind_param($comando, 'isi', $codigo, $expiracao, $idusuario);
      mysqli_stmt_execute($comando);
      mysqli_stmt_close($comando);
      desconectar($conexao);

      $resultados[] = [
        'email' => $email_destinatario,
        'codigo' => $codigo,
        'expira' => $expiracao,
        'status' => 'enviado'
      ];
    } catch (Exception $e) {
      $resultados[] = [
        'email' => $email_destinatario,
        'status' => 'erro',
        'mensagem' => $email->ErrorInfo
      ];
    }
  }

  return $resultados;
}

function VerificarCodigo($codigoInserido, $idusuario)
{
  $conexao = conectar();

  $sql = 'SELECT codigo, tempo_expiracao FROM recuperacao_senha WHERE usuario_idusuario = ? ORDER BY tempo_expiracao DESC LIMIT 1';
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'i', $idusuario);
  mysqli_stmt_execute($comando);

  $resultados = mysqli_stmt_get_result($comando);
  $resultado = mysqli_fetch_assoc($resultados);

  mysqli_stmt_close($comando);
  desconectar($conexao);

  if (!$resultado) {
    return false; // Usuário não tem código de recuperação
  }

  $codigoArmazenado = $resultado['codigo'];
  $expiracaoArmazenada = $resultado['tempo_expiracao'];

  if ($codigoInserido !== $codigoArmazenado) {
    return false; // Código incorreto
  }

  if (strtotime($expiracaoArmazenada) <= time()) {
    return false; // Código expirado
  }

  return true; // Código correto e válido
}


function aplicarDesconto($idpagamento, $idcupom)
{
  $conexao = conectar();
  $sql = 'SELECT percentual_desconto, valor_desconto, quantidade_uso FROM cupom_desconto WHERE idcupom=?';
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'i', $idcupom);
  mysqli_stmt_execute($comando);
  $valor_desconto = mysqli_stmt_get_result($comando);
  $resultado = mysqli_fetch_assoc($valor_desconto);
  $sql2 = 'SELECT valor FROM pagamento WHERE idpagamento=?';
  $comando2 = mysqli_prepare($conexao, $sql2);
  mysqli_stmt_bind_param($comando2, 'i', $idpagamento);
  mysqli_stmt_execute($comando2);
  $valor_da_compra = mysqli_stmt_get_result($comando2);
  $valor2 = mysqli_fetch_assoc($valor_da_compra);
  $valor = (float)$valor2['valor'];

  if ($resultado['percentual_desconto'] != null) {
    $desconto = (float)$resultado['percentual_desconto'];
    $valor_com_desconto = $valor - $valor * ($desconto / 100);
  } elseif ($resultado['valor_desconto'] != null) {
    $desconto = (float)$resultado['valor_desconto'];
    $valor_com_desconto = $valor - $desconto;
  }
  $sql3 = 'UPDATE pagamento SET valor=? WHERE idpagamento=?';
  $comando3 = mysqli_prepare($conexao, $sql3);
  mysqli_stmt_bind_param($comando3, 'di', $valor_com_desconto, $idpagamento);
  mysqli_stmt_execute($comando3);
  $usos_restantes = (int)$resultado['quantidade_uso'];
  $usos_restantes--;
  $sql4 = 'UPDATE cupom_desconto SET quantidade_uso=? WHERE idcupom=?';
  $comando4 = mysqli_prepare($conexao, $sql4);
  mysqli_stmt_bind_param($comando4, 'ii', $usos_restantes, $idcupom);
  mysqli_stmt_execute($comando4);
  mysqli_stmt_close($comando);
  mysqli_stmt_close($comando2);
  mysqli_stmt_close($comando3);
  mysqli_stmt_close($comando4);
}
function ajustarDataHora($DataeHora)
{

  $DataeHoraUTC = strtotime($DataeHora . ' UTC');
  $DataeHoraLocal = $DataeHoraUTC - (3 * 3600);
  $DataeHoraConvertido = gmdate('d-m-Y H:i:s', $DataeHoraLocal);
  return $DataeHoraConvertido;
}

function uploadImagem($foto, $target_dir)
{
  $resposta = "";
  $uploadOk = 1;

  // Verifica se o arquivo foi enviado
  if (!isset($foto) || !isset($foto["tmp_name"]) || empty($foto["tmp_name"])) {
    return ['erro' => "Nenhum arquivo foi enviado."];
  }

  // Verifica se é uma imagem
  $check = getimagesize($foto["tmp_name"]);
  if ($check === false) {
    $resposta .= "O arquivo não é uma imagem. ";
    $uploadOk = 0;
  }

  // Gera nome único para o arquivo
  $imageFileType = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));
  $nomeUnico = uniqid("img_", true) . "." . $imageFileType;
  $target_file = rtrim($target_dir, "/") . "/" . $nomeUnico;

  // Verifica o tipo de arquivo
  if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
    $resposta .= "Apenas arquivos JPG, PNG ou JPEG são permitidos. ";
    $uploadOk = 0;
  }

  // Verifica o tamanho do arquivo
  if ($foto["size"] > 500000) {
    $resposta .= "Esse arquivo é muito grande (máx: 500 KB). ";
    $uploadOk = 0;
  }

  // Verifica se o diretório existe e é gravável
  if (!is_dir($target_dir)) {
    $resposta .= "Diretório de destino não existe. ";
    $uploadOk = 0;
  } elseif (!is_writable($target_dir)) {
    chmod($target_dir, 0775);
    if (!is_writable($target_dir)) {
      $resposta .= "Diretório de destino não é gravável. ";
      $uploadOk = 0;
    }
  }

  // Tentativa final de upload
  if ($uploadOk == 0) {
    return ['erro' => trim($resposta)];
  } else {
    if (move_uploaded_file($foto["tmp_name"], $target_file)) {
      return ['nome' => basename($target_file)];
    } else {
      return ['erro' => "Erro ao mover o arquivo para o diretório de destino."];
    }
  }
}


function mostrarImagem($target_file)
{
  $target_file = rtrim($target_file, "/");

  if (!file_exists($target_file)) {
    http_response_code(404);
    echo "Imagem não encontrada.";
    exit;
  }

  $mime = mime_content_type($target_file);
  header("Content-Type: $mime");
  header("Content-Length: " . filesize($target_file));
  readfile($target_file);
  exit;
}
function mostrarImagemSimples($arquivo) {
    if (file_exists($arquivo)) {
        readfile($arquivo);
    } else {
        echo "Imagem não encontrada.";
    }
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
function editarItemPedido($pedido_idpedido, $produto_idproduto, $quantidade, $preco_unitario)
{
  $conexao = conectar();

  $sql = "UPDATE item_pedido 
            SET quantidade = ?, preco_unitario = ?
            WHERE pedido_idpedido = ? AND produto_idproduto = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // "i" para int, "d" para double
  mysqli_stmt_bind_param($comando, "idii", $quantidade, $preco_unitario, $pedido_idpedido, $produto_idproduto);

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


function listarTreino($idtreino)
{
  $conexao = conectar();

  if ($idtreino !== null) {
    $sql = " SELECT * FROM treino WHERE $idtreino = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idtreino);
  } else {
    $sql = " SELECT 
    u.nome,
    t.tipo,
    t.horario,
    t.descricao
    FROM treino as t
    JOIN usuario as u ON u.idusuario = t.usuario_idusuario
    
    
    ";
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
    $sql = " SELECT
    u.nome,
    ag.data_aula,
    ag.dia_semana,
    ag.hora_inicio,
    ag.hora_fim 
    FROM aula_agendada AS ag
    JOIN usuario AS u ON ag.usuario_idusuario = u.idusuario
    WHERE $idaula = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idaula);
  } else {
    $sql = " SELECT  u.nome,
    ag.data_aula,
    ag.dia_semana,
    ag.hora_inicio,
    ag.hora_fim 
    FROM aula_agendada AS ag
    JOIN usuario AS u ON ag.usuario_idusuario = u.idusuario";
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

function listarPagamentosDetalhados($idpagamento2)
{
  $conexao = conectar();

  if ($idpagamento2 !== null) {
    $sql = " SELECT 
    p.idpagamento, 
    p.valor, 
    p.data_pagamento, 
    p.metodo, 
    p.status AS pagamento_status,
    pd.tipo AS pagamento_tipo, 
    pd.bandeira_cartao, 
    pd.ultimos_digitos, 
    pd.codigo_pix, 
    pd.linha_digitavel_boleto,
    ped.idpedido,
    ped.data_pedido,
    ped.status AS pedido_status,
    u.idusuario,
    u.nome AS usuario_nome,
    u.email AS usuario_email,
    u.telefone AS usuario_telefone,
    prod.idproduto,
    prod.nome AS produto_nome,
    prod.preco AS produto_preco,
    prod.quantidade_estoque
    FROM 
    pagamento p
JOIN 
    pagamento_detalhe pd ON p.idpagamento = pd.pagamento_idpagamento
JOIN 
    pedido ped ON p.idpagamento = ped.pagamento_idpagamento
JOIN 
    usuario u ON ped.usuario_idusuario = u.idusuario
JOIN 
    produto prod ON ped.idpedido = prod.idproduto -- Esse JOIN pode variar dependendo de como os produtos estão relacionados aos pedidos


WHERE p.idpagamento = ?;  -- Aqui você pode passar um ID específico de pagamento
";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idpagamento2);
  } else {
    $sql = " SELECT 
    p.idpagamento, 
    p.valor, 
    p.data_pagamento, 
    p.metodo, 
    p.status AS pagamento_status,
    pd.tipo AS pagamento_tipo, 
    pd.bandeira_cartao, 
    pd.ultimos_digitos, 
    pd.codigo_pix, 
    pd.linha_digitavel_boleto,
    ped.idpedido,
    ped.data_pedido,
    ped.status AS pedido_status,
    u.idusuario,
    u.nome AS usuario_nome,
    u.email AS usuario_email,
    u.telefone AS usuario_telefone,
    prod.idproduto,
    prod.nome AS produto_nome,
    prod.preco AS produto_preco,
    prod.quantidade_estoque
FROM 
    pagamento p
JOIN 
    pagamento_detalhe pd ON p.idpagamento = pd.pagamento_idpagamento
JOIN 
    pedido ped ON p.idpagamento = ped.pagamento_idpagamento
JOIN 
    usuario u ON ped.usuario_idusuario = u.idusuario
JOIN 
    produto prod ON ped.idpedido = prod.idproduto -- Esse JOIN pode variar dependendo de como os produtos estão relacionados aos pedidos

  -- Aqui você pode passar um ID específico de pagamento
";
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
    $sql = " SELECT 
     u.nome,
     m.descricao,
     m.data_inicio,
     m.data_limite,
     m.status
    FROM meta_usuario AS M
    JOIN usuario AS u ON m.usuario_id = u.idusuario
    WHERE $idmeta = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idmeta);
  } else {
    $sql = " SELECT 
     u.nome,
     m.descricao,
     m.data_inicio,
     m.data_limite,
     m.status
    FROM meta_usuario AS M
    JOIN usuario AS u ON m.usuario_id = u.idusuario";
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
    $sql = " SELECT
    u.nome,
    a.peso,
    a.altura,
    a.imc,
    a.percentual_gordura,
    a.data_avaliacao
    FROM avaliacao_fisica AS a
    JOIN usuario AS u ON a.usuario_idusuario = u.idusuario
    WHERE $idavaliacao = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idavaliacao);
  } else {
    $sql = " SELECT
    u.nome,
    a.peso,
    a.altura,
    a.imc,
    a.percentual_gordura,
    a.data_avaliacao
    FROM avaliacao_fisica AS a
    JOIN usuario AS u ON a.usuario_idusuario = u.idusuario";
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
    $sql = " SELECT 


    FROM cargo 
    WHERE $idcargo = ?";
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
    $sql = " SELECT 
    u.nome,
    d.descricao,
    d.data_inicio,
    d.data_fim,
    r.tipo,
    r.horario
    FROM refeicao AS r
    JOIN dieta AS d ON r.dieta_id = d.iddieta
    JOIN usuario AS u ON d.usuario_idusuario = u.idusuario
    WHERE $idrefeicao = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idrefeicao);
  } else {
    $sql = " SELECT 
    u.nome,
    d.descricao,
    d.data_inicio,
    d.data_fim,
    r.tipo,
    r.horario
    FROM refeicao AS r
    JOIN dieta AS d ON r.dieta_id = d.iddieta
    JOIN usuario AS u ON d.usuario_idusuario = u.idusuario";
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

  // Verifica se $idresposta não é nulo
  if ($idresposta !== null) {
    // Consulta com junção para pegar o nome do usuário ao invés do id
    $sql = "
     SELECT rf.idresposta, rf.mensagem, rf.data_resposta, u.nome AS nome_usuario, rf.forum_idtopico, f.descricao
      FROM resposta_forum rf
      JOIN usuario u ON rf.usuario_idusuario = u.idusuario
            JOIN forum AS f ON rf.forum_idtopico = f.idtopico
      WHERE rf.idresposta = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idresposta);
  } else {
    // Consulta para pegar todas as respostas com os nomes dos usuários
    $sql = "
     SELECT rf.idresposta, rf.mensagem, rf.data_resposta, u.nome AS nome_usuario, rf.forum_idtopico, f.descricao
      FROM resposta_forum rf
      JOIN usuario u ON rf.usuario_idusuario = u.idusuario
            JOIN forum AS f ON rf.forum_idtopico = f.idtopico";
    $comando = mysqli_prepare($conexao, $sql);
  }

  // Executa a consulta
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  // Cria um array para armazenar as respostas do fórum
  $lista_resposta_forums = [];
  while ($resposta_forum = mysqli_fetch_assoc($resultados)) {
    $lista_resposta_forums[] = $resposta_forum;
  }

  // Fecha a preparação do comando
  mysqli_stmt_close($comando);

  return $lista_resposta_forums;
}

function listarItemPedido($usuario_id): array
{
  $conexao = conectar();

  if ($usuario_id != null) {
    $sql = "
        SELECT 
            ped.idpedido, 
            u.nome AS usuario_nome, 
            p.nome AS produto_nome, 
            ip.quantidade, 
            ip.preco_unitario, 
            ped.status, 
            ped.data_pedido
        FROM pedido ped
        JOIN item_pedido ip ON ped.idpedido = ip.pedido_idpedido
        JOIN produto p ON ip.produto_idproduto = p.idproduto
        JOIN usuario u ON ped.usuario_idusuario = u.idusuario
        WHERE ped.usuario_idusuario = ?
        ORDER BY ped.data_pedido DESC
    ";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $usuario_id);
  } else {
    $sql = "    SELECT 
            ped.idpedido, 
            u.nome AS usuario_nome, 
            p.nome AS produto_nome, 
            ip.quantidade, 
            ip.preco_unitario, 
            ped.status, 
            ped.data_pedido
        FROM pedido ped
        JOIN item_pedido ip ON ped.idpedido = ip.pedido_idpedido
        JOIN produto p ON ip.produto_idproduto = p.idproduto
        JOIN usuario u ON ped.usuario_idusuario = u.idusuario";
    $comando = mysqli_prepare($conexao, $sql);
  }
  mysqli_stmt_execute($comando);
  $resultado = mysqli_stmt_get_result($comando);

  $pedidos = [];
  while ($pedido = mysqli_fetch_assoc($resultado)) {
    $pedidos[] = $pedido;
  }

  mysqli_stmt_close($comando);
  return $pedidos;
}


function listarItemPedidosComFiltros($usuario_id, $status = null, $data_inicio = null, $data_fim = null, $produto_nome = null, $preco_min = null, $preco_max = null)
{
  $conexao = conectar();

  // Montar a consulta base com os filtros
  $sql = "
    SELECT 
        ped.idpedido, 
        u.nome AS usuario_nome, 
        p.nome AS produto_nome, 
        ip.quantidade, 
        ip.preco_unitario, 
        ped.status, 
        ped.data_pedido
    FROM pedido ped
    JOIN item_pedido ip ON ped.idpedido = ip.pedido_idpedido
    JOIN produto p ON ip.produto_idproduto = p.idproduto
    JOIN usuario u ON ped.usuario_idusuario = u.idusuario
    WHERE ped.usuario_idusuario = ?
    ";

  // Filtros dinâmicos para status, data, produto e preço
  if ($status !== null) {
    $sql .= " AND ped.status = ?";
  }
  if ($data_inicio !== null && $data_fim !== null) {
    $sql .= " AND ped.data_pedido BETWEEN ? AND ?";
  }
  if ($produto_nome !== null) {
    $sql .= " AND p.nome LIKE ?";
  }
  if ($preco_min !== null && $preco_max !== null) {
    $sql .= " AND ip.preco_unitario BETWEEN ? AND ?";
  }

  $sql .= " ORDER BY ped.data_pedido DESC";

  // Preparar a consulta
  $comando = mysqli_prepare($conexao, $sql);

  // Bind dos parâmetros dinamicamente
  $bind_types = "i"; // Inicia com o tipo do ID do usuário (inteiro)
  $params = [$usuario_id];

  // Adicionar parâmetros conforme os filtros fornecidos
  if ($status !== null) {
    $bind_types .= "s"; // Tipo string para o status
    $params[] = $status;
  }
  if ($data_inicio !== null && $data_fim !== null) {
    $bind_types .= "ss"; // Tipo string para as datas
    $params[] = $data_inicio;
    $params[] = $data_fim;
  }
  if ($produto_nome !== null) {
    $bind_types .= "s"; // Tipo string para o nome do produto
    $params[] = "%" . $produto_nome . "%";
  }
  if ($preco_min !== null && $preco_max !== null) {
    $bind_types .= "dd"; // Tipo decimal para os preços
    $params[] = $preco_min;
    $params[] = $preco_max;
  }

  // Bind dos parâmetros
  mysqli_stmt_bind_param($comando, $bind_types, ...$params);

  // Executar a consulta
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $pedidos = [];
  while ($pedido = mysqli_fetch_assoc($resultados)) {
    $pedidos[] = $pedido;
  }

  mysqli_stmt_close($comando);
  return $pedidos;
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
    $sql = " SELECT 
    u.nome,
    p.tipo,
    p.duracao,
    a.data_inicio,
    a.data_fim
    FROM assinatura AS a
    JOIN plano AS p ON a.plano_idplano = p.idplano
    JOIN usuario AS u ON a.usuario_idusuario = u.idusuario
    WHERE $idassinatura = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idassinatura);
  } else {
    $sql = " SELECT 
    u.nome,
    p.tipo,
    p.duracao,
    a.data_inicio,
    a.data_fim
    FROM assinatura AS a
    JOIN plano AS p ON a.plano_idplano = p.idplano
    JOIN usuario AS u ON a.usuario_idusuario = u.idusuario";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_assinaturas = [];
  while ($assinatura = mysqli_fetch_assoc($resultados)) {
    $lista_assinaturas[] = $assinatura;
  }

  mysqli_stmt_close($comando);

  return json_encode($lista_assinaturas);
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

function cadastrarItemPedido($pedido_idpedido, $produto_idproduto, $quantidade, $preco_unitario)
{
  $conexao = conectar();

  $sql = " INSERT INTO item_pedido (pedido_idpedido, produto_idproduto, quantidade, preco_unitario) VALUES (?,?,?,?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "iiid", $pedido_idpedido, $produto_idproduto, $quantidade, $preco_unitario);

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
function cadastrarCargo($nome, $descricao)
{
  $conexao = conectar();

  $sql = " INSERT INTO cargo  (nome, descricao) VALUES (?, ?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "ss", $nome, $descricao);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function cadastrarExercicio($nome, $grupo_muscular, $descricao, $video_url)
{
  $conexao = conectar();

  $sql = " INSERT INTO exercicio  (nome, grupo_muscular, descricao,  video_url) VALUES (?, ?, ?,?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "ssss", $nome, $grupo_muscular, $descricao, $video_url);

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
