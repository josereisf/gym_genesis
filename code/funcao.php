<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dom\Mysql;
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
function cadastrarUsuario($senha, $email, $tipo)
{
  $conexao = conectar();
  $senhahash = password_hash($senha, PASSWORD_DEFAULT);
  $sql = 'INSERT INTO usuario (senha, email, tipo_usuario) VALUES (?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi',  $senhahash, $email, $tipo);

  $funcionou = mysqli_stmt_execute($comando);
  $id_usuario = mysqli_insert_id($conexao);

  mysqli_stmt_close($comando);
  desconectar($conexao);
  return [
    'success' => $funcionou,
    'id' => $id_usuario
  ];
}

function editarUsuario($senha, $email, $tipo, $idusuario)
{
  $conexao = conectar();
  $sql = 'UPDATE usuario SET senha=?, email=?, tipo_usuario=? WHERE idusuario=?';
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'ssii', $senha, $email, $tipo, $idusuario);

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

 try {
        $funcionou = mysqli_stmt_execute($comando);
    } catch (mysqli_sql_exception $e) {
        // Usa a função traduzirErroMySQL para mostrar mensagem amigável
        echo "❌ " . traduzirErroMySQL($e->getCode());
        $funcionou = false;
    }  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function loginUsuario($email, $senha)
{
  $conexao = conectar();
  $sql = "SELECT idusuario, email, senha FROM usuario WHERE email = ?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 's', $email);

  mysqli_stmt_execute($comando);

  mysqli_stmt_bind_result($comando, $id, $emailDb, $senhahash);

  if (mysqli_stmt_fetch($comando)) {
    if (password_verify($senha, $senhahash)) {
      return [
        'id' => $id,
        'email' => $emailDb
      ];
    }
  }

  return false;
}

function cadastrarEndereco($id, $cep, $rua, $numero, $complemento, $bairro, $cidade, $estado, $tipo)
{
  $conexao = conectar();
  if ($tipo == 1 or $tipo == 2) {
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
  if ($tipo == 1 or $tipo == 2) {
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
    pf.nome AS nome_usuario,
    f.nome AS nome_funcionario,
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado 
    FROM endereco AS e 
    LEFT JOIN perfil_usuario AS pf ON e.usuario_id = pf.usuario_id 
    LEFT JOIN funcionario AS f ON e.funcionario_id = f.idfuncionario;';
    $comando = mysqli_prepare($conexao, $sql);
  } elseif ($tipo == 1) {
    $sql = ' SELECT
    pf.nome AS nome_usuario,
    e.cep, e.rua, e.numero,
    e.complemento, e.bairro,
    e.cidade,
    e.estado
    FROM endereco AS e
    LEFT JOIN perfil_usuario AS pf ON e.usuario_id = pf.usuario_id
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
    $sql = ' SELECT pf.nome AS nome_usuario,
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado
    FROM endereco AS e
    LEFT JOIN perfil_usuario AS pf ON e.usuario_id = pf.usuario_id
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
    f.cargo_id,
    c.nome AS nome_cargo,
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
    f.cargo_id,
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

  return json_encode($lista_funcionarios, JSON_UNESCAPED_UNICODE);
}


function deletarFuncionario($idfuncionario)
{
  $conexao = conectar();
  $sql = " DELETE FROM funcionario WHERE idfuncionario = ?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idfuncionario);

   try {
        $funcionou = mysqli_stmt_execute($comando);
    } catch (mysqli_sql_exception $e) {
        // Usa a função traduzirErroMySQL para mostrar mensagem amigável
        echo "❌ " . traduzirErroMySQL($e->getCode());
        $funcionou = false;
    }
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
function deletarCargo($idcargo): bool
{
    $conexao = conectar();

    $sql = "DELETE FROM cargo WHERE idcargo = ?";
    $comando = mysqli_prepare($conexao, $sql);

    if (!$comando) {
        echo "Erro na preparação: " . mysqli_error($conexao);
        return false;
    }

    mysqli_stmt_bind_param($comando, "i", $idcargo);

    try {
        $funcionou = mysqli_stmt_execute($comando);
    } catch (mysqli_sql_exception $e) {
        // Código 1451 = erro de chave estrangeira (Cannot delete or update parent row)
        if ($e->getCode() == 1451) {
            echo "❌ Não é possível excluir: este cargo está associado a outros registros.";
            $funcionou = false;
        } else {
            echo "Erro inesperado: " . $e->getMessage();
            $funcionou = false;
        }
    }

    mysqli_stmt_close($comando);
    desconectar($conexao);

    return $funcionou;
}

function cadastrarAssinatura($data_inicio, $data_fim, $idplano, $idusuario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO assinatura (data_inicio, data_fim, usuario_id, plano_id) VALUES (?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  // CORRETO: $idusuario vem antes de $idplano
  mysqli_stmt_bind_param($comando, 'ssii', $data_inicio, $data_fim, $idusuario, $idplano);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

function renovarAssinatura($idusuario, $data_inicio, $data_fim)
{
  $conexao = conectar();

  $sql = 'UPDATE assinatura SET data_inicio=?, data_fim=? WHERE usuario_id=?';
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
  $sql = "DELETE FROM assinatura WHERE usuario_id=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarPlano($tipo, $duracao)
{
  $conexao = conectar();

  $sql = 'INSERT INTO plano (tipo, duracao) VALUES (?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ss', $tipo, $duracao);

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
    $sql = 'SELECT * FROM plano WHERE idplano = ?';
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

  return $lista_planos; // agora retorna array puro

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
function cadastrarTreino($tipo, $horario, $descricao, $idfuncionario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO treino (tipo, horario, descricao, funcionario_id) VALUES (?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssi', $tipo, $horario, $descricao, $idfuncionario);

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
  $sql = " DELETE FROM avaliacao_fisica WHERE usuario_id=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarDieta($descricao, $data_inicio, $data_fim, $idusuario, $iddieta)
{
  $conexao = conectar();

  $sql = 'UPDATE dieta SET descricao=?, data_inicio=?, data_fim=?, usuario_id=? WHERE iddieta=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssii', $descricao, $data_inicio, $data_fim, $idusuario, $iddieta);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarDieta($idusuario)
{
  $conexao = conectar();
  $sql = "DELETE FROM dieta WHERE usuario_id=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarDietas($iddieta)
{
  $conexao = conectar();
  if ($iddieta != null) {
    $sql = 'SELECT
    pf.usuario_id,
    pf.nome AS nome_usuario,
    d.descricao,
    d.data_inicio,
    d.data_fim
    FROM dieta AS d
    JOIN perfil_usuario AS pf ON d.usuario_id = pf.usuario_id
    WHERE d.iddieta=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $iddieta);
  } else {
    $sql = ' SELECT
    pf.usuario_id,
    pf.nome AS nome_usuario,
    d.descricao,
    d.data_inicio,
    d.data_fim
    FROM dieta AS d
    JOIN perfil_usuario AS pf ON d.usuario_id = pf.usuario_id';
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

function listarDietasUsuario($idusuario)
{
  $conexao = conectar();
  if ($idusuario != null) {
    $sql = ' SELECT
    pf.nome AS nome_usuario,
    d.descricao,
    d.data_inicio,
    d.data_fim
    FROM dieta AS d
    JOIN perfil_usuario AS pf ON d.usuario_id = pf.usuario_id
    WHERE d.usuario_id=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idusuario);
  } else {
    $sql = ' SELECT
    pf.nome AS nome_usuario,
    d.descricao,
    d.data_inicio,
    d.data_fim
    FROM dieta AS d
    JOIN perfil_usuario AS pf ON d.usuario_id = pf.usuario_id';
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
function listarTreinoExercicioTreino($idtreino)
{
  $conexao = conectar();
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
  WHERE t.idtreino=?';
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'i', $idtreino);
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
function deletarRefeicao($idrefeicao)
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

  $sql = ' UPDATE assinatura SET data_fim=? WHERE usuario_id=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'si', $data_fim, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function listarCupomDesconto($idcupom)
{
  $conexao = conectar();
  if ($idcupom != null) {
    $sql = 'SELECT * FROM cupom_desconto WHERE idcupom=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idcupom);
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

  $sql = ' UPDATE categoria_produto SET nome=?, descricao=? WHERE usuario_id=?';
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
    pf.nome AS nome_usuario,
    p.data_pedido,
    p.status,
    pa.valor
    FROM pedido AS p
    JOIN perfil_usuario AS pf ON p.usuario_id = pf.usuario_id
    JOIN pagamento AS pa ON p.pagamento_id = pa.idpagamento
    WHERE p.idpedido=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idpedido);
  } else {
    $sql = ' SELECT
    pf.nome AS nome_usuario,
    p.data_pedido,
    p.status,
    pa.valor
    FROM pedido AS p
    JOIN perfil_usuario AS pf ON p.usuario_id = pf.usuario_id
    JOIN pagamento AS pa ON p.pagamento_id = pa.idpagamento';
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
  $lista_produtos = array_values($lista_produtos);
  $lista = json_encode($lista_produtos, JSON_UNESCAPED_UNICODE);
  return $lista;
}

function editarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idtreino,$funcionario_id, $idaula)
{
  $conexao = conectar();

  $sql = ' UPDATE aula_agendada SET data_aula=?, dia_semana=?, hora_inicio=?, hora_fim=?, treino_id=?, funcionario_id=? WHERE idaula=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssssiiii', $data_aula, $dia_semana, $hora_inicio, $hora_fim, $idtreino,$funcionario_id, $idaula);

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

  mysqli_stmt_bind_param($comando, 'iss', $iddieta, $tipo, $horario);

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

  $sql = 'INSERT INTO pedido (usuario_id, data_pedido, status, pagamento_id) VALUES (?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'issi', $idusuario, $data_pedido, $status, $idpagamento);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function cadastrarRespostaForum($mensagem, $idusuario, $idtopico)
{
  $conexao = conectar();

  $sql = 'INSERT INTO resposta_forum (mensagem, usuario_id, forum_id) VALUES (?, ?, ?)';
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
    pf.nome AS nome_usuario,
    f.titulo,
    f.descricao,
    f.data_criacao
    FROM forum AS f
    JOIN perfil_usuario AS pf ON f.usuario_id = pf.usuario_id
    WHERE f.idtopico=?;';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idtopico);
  } else {
    $sql = 'SELECT
    pf.nome AS nome_usuario,
    f.titulo,
    f.descricao,
    f.data_criacao
    FROM forum AS f
    JOIN perfil_usuario AS pf ON f.usuario_id = idusuario;';
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
function cadastrarForum($titulo, $descricao, $usuario_id)
{
  $conexao = conectar();

  $sql = 'INSERT INTO forum (titulo, descricao, usuario_id) VALUES (?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $titulo, $descricao, $usuario_id);

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
    pf.nome,
    t.tipo,
    ht.data_execucao,
    ht.observacoes
    FROM historico_treino AS ht
    JOIN perfil_usuario AS pf ON ht.usuario_id = pf.usuario_id
    JOIN treino AS t ON ht.treino_id = t.idtreino
    WHERE idhistorico=?';
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $idhistorico);
  } else {
    $sql = 'SELECT
    pf.nome,
    t.tipo,
    ht.data_execucao,
    ht.observacoes
    FROM historico_treino AS ht
    JOIN perfil_usuario AS pf ON ht.usuario_id = pf.usuario_id
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
function editarForum($idtopico, $titulo, $descricao)
{
  $conexao = conectar();

  $sql = ' UPDATE forum SET titulo=?, descricao=? WHERE idtopico=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssi', $titulo, $descricao, $idtopico);

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

  $sql = ' UPDATE pagamento SET valor=?, data_pagamento=?, metodo=?, status=? WHERE idpagamento=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'dsssi', $valor, $data_pagamento, $metodo, $status, $idpagamento);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarDietaAlimentar($idalimento, $idrefeicao, $quantidade, $observacao)
{
  $conexao = conectar();

  $sql = ' UPDATE dieta_alimentar SET quantidade=?, observacao=? WHERE alimento_id=? and refeicao_id=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'dsii', $quantidade, $observacao, $idalimento, $idrefeicao);

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
    $sql = 'INSERT INTO recuperacao_senha (codigo, tempo_expiracao, usuario_id) VALUES (?, ?, ?)';
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
      $sql = 'INSERT INTO recuperacao_senha (codigo, tempo_expiracao, usuario_id) VALUES (?, ?, ?)';
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

  $sql = 'SELECT codigo, tempo_expiracao FROM recuperacao_senha WHERE usuario_id = ? ORDER BY tempo_expiracao DESC LIMIT 1';
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

function uploadImagem($foto)
{
  $resposta = "";
  $uploadOk = 1;
  $target_dir = __DIR__ . '/../public/uploads/';

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
  $tipo = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));
  $nomeUnico = uniqid("img_", true) . "." . $tipo;
  $target_file = rtrim($target_dir, "/") . "/" . $nomeUnico;

  // Verifica o tipo de arquivo
  if (!in_array($tipo, ['jpg', 'jpeg', 'png'])) {
    $resposta .= "Apenas arquivos JPG, PNG ou JPEG são permitidos. ";
    $uploadOk = 0;
  }

  // Tentativa final de upload
  if ($uploadOk == 0) {
    return ['erro' => trim($resposta)];
  } else {
    if (move_uploaded_file($foto["tmp_name"], $target_file)) {
      return $nomeUnico;
    } else {
      return ['erro' => "Erro ao mover o arquivo para o diretório de destino."];
    }
  }
}


function mostrarImagem($caminhoImagem)
{
  if (!file_exists($caminhoImagem)) {
    http_response_code(404);
    echo "Imagem não encontrada.";
    exit;
  }

  header("Content-Type: " . mime_content_type($caminhoImagem));
  header("Content-Length: " . filesize($caminhoImagem));
  readfile($caminhoImagem);
  exit;
}

function deletarPagamento($idpagamento)
{
  $conexao = conectar();
  $sql = " DELETE FROM pagamento WHERE idpagamento=?";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'i', $idpagamento);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
///////////////////////////////////////////////////////////////////////////////////////// ultimo que o jose fez//////////////////////////////////////////////////////////////////////////////////////


function cadastrarAvaliacaoFisica($peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario)
{
  $conexao = conectar();

  $sql = 'INSERT INTO avaliacao_fisica (peso, altura, imc, percentual_gordura, data_avaliacao, usuario_id) VALUES (?, ?, ?, ?, ?, ?)';

  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, "ddddsi", $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);

  mysqli_stmt_close($comando);

  desconectar($conexao);

  return $funcionou;
}


function cadastrarPagamentoDetalhe($pagamento_id, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto): bool
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
            (pagamento_id, tipo, bandeira_cartao, ultimos_digitos, codigo_pix, linha_digitavel_boleto) 
            VALUES (?, ?, ?, ?, ?, ?)';

  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param(
    $comando,
    "isssss",
    $pagamento_id,
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

function editarAvaliacaoFisica($idavaliacao, $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_id)
{
  $conexao = conectar();

  $sql = "UPDATE avaliacao_fisica 
          SET peso = ?, altura = ?, imc = ?, percentual_gordura = ?, data_avaliacao = ?, usuario_id = ? 
          WHERE idavaliacao = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "ddddssi", $peso, $altura, $imc, $percentual_gordura, $data_avaliacao, $usuario_id, $idavaliacao);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function editarItemPedido($pedido_id, $produto_id, $quantidade, $preco_unitario): bool
{
  $conexao = conectar();

  $sql = "UPDATE item_pedido 
            SET quantidade = ?, preco_unitario = ?
            WHERE pedido_id = ? AND produto_id = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // "i" para int, "d" para double
  mysqli_stmt_bind_param($comando, "idii", $quantidade, $preco_unitario, $pedido_id, $produto_id);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function editarFuncionario($idfuncionario, $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem)
{
  $conexao = conectar();

  $sql = "UPDATE funcionario 
            SET nome = ?, email = ?, telefone = ?, data_contratacao = ?, salario = ?, cargo_id = ?, usuario_id=?
            WHERE idfuncionario = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Correção aqui:
  mysqli_stmt_bind_param($comando, "ssssdisi", $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem, $idfuncionario);

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

  if ($idtreino != null) {
    $sql = " SELECT 
    pf.nome,
    t.tipo,
    t.horario,
    t.descricao
    FROM treino as t
    JOIN perfil_usuario AS pf ON pf.usuario_id = t.funcionario_id 
    WHERE idtreino = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idtreino);
  } else {
    $sql = " SELECT 
    pf.nome,
    t.tipo,
    t.horario,
    t.descricao
    FROM treino as t
    JOIN perfil_usuario AS pf ON pf.usuario_id = t.funcionario_id
    
    
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
function listarTreinoUsuario($idusuario)
{
  $conexao = conectar();

  $sql = " SELECT 
  idtreino,
  pf.nome AS nome,
  t.tipo,
  t.horario,
  t.descricao
  FROM treino as t
  JOIN perfil_usuario AS pf ON pf.usuario_id = t.usuario_id 
  WHERE idusuario = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idusuario);
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_treinos = [];
  while ($treino = mysqli_fetch_assoc($resultados)) {
    $lista_treinos[] = $treino;
  }

  mysqli_stmt_close($comando);
  return $lista_treinos;
}
function listarTreinoTipo($tipo)
{
  $conexao = conectar();
  $sql = "SELECT 
  pf.nome,
  t.tipo,
  t.horario,
  t.descricao
  FROM treino as t
  JOIN perfil_usuario AS pf ON pf.usuario_id = t.usuario_id
  WHERE t.tipo = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "s", $tipo);
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);

  $lista_treinos = [];
  while ($treino = mysqli_fetch_assoc($resultados)) {
    $lista_treinos[] = $treino;
  }

  mysqli_stmt_close($comando);
  return $lista_treinos;
}

function cadastrarHistoricoTreino($idusuario, $idtreino, $data_execucao, $observacoes)
{
  $conexao = conectar();
  $sql = " INSERT INTO historico_treino (usuario_id, treino_id, data_execucao, observacoes) VALUES (?, ?, ?, ?)";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, "iiss", $idusuario, $idtreino, $data_execucao, $observacoes);
  $funcionou = mysqli_stmt_execute($comando);

  $idInserido = null;
  if ($funcionou) {
    $idInserido = mysqli_insert_id($conexao);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $idInserido; // retorna o ID inserido, ou null se não funcionou
}

function listarAulaAgendada($idaula = null)
{
    $conexao = conectar();

    $sql = "SELECT
                ag.idaula,
                ag.data_aula,
                ag.dia_semana,
                ag.hora_inicio,
                ag.hora_fim,
                t.tipo AS treino_tipo,
                t.descricao AS treino_desc,
                f.idfuncionario,
                f.nome AS professor_nome
            FROM aula_agendada AS ag
            LEFT JOIN treino AS t ON ag.treino_id = t.idtreino
            LEFT JOIN funcionario AS f ON ag.funcionario_id = f.idfuncionario";

    if ($idaula !== null) {
        $sql .= " WHERE ag.idaula = ?";
    }

    $sql .= " GROUP BY ag.idaula, ag.data_aula, ag.hora_inicio, ag.hora_fim, ag.treino_id, t.tipo, t.descricao, f.idfuncionario, f.nome";

    $comando = mysqli_prepare($conexao, $sql);
    if (!$comando) {
        echo "Erro na preparação: " . mysqli_error($conexao);
        return [];
    }

    if ($idaula !== null) {
        mysqli_stmt_bind_param($comando, "i", $idaula);
    }

    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    $lista = [];
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $lista[] = $linha;
    }

    mysqli_stmt_close($comando);
    desconectar($conexao);

    return $lista;
}


function listarAulaAgendadaUsuario($idusuario)
{
    $conexao = conectar();

    $sql = "SELECT
                ag.idaula,
                ag.data_aula,
                ag.dia_semana,
                ag.hora_inicio,
                ag.hora_fim,
                t.tipo AS treino_tipo,
                t.descricao AS treino_desc,
                f.idfuncionario,
                f.nome AS professor_nome
            FROM aula_usuario AS au
            JOIN aula_agendada AS ag ON au.idaula = ag.idaula
            LEFT JOIN treino AS t ON ag.treino_id = t.idtreino
            LEFT JOIN funcionario AS f ON ag.funcionario_id = f.idfuncionario
            WHERE au.usuario_id = ?";

    $comando = mysqli_prepare($conexao, $sql);
    if (!$comando) {
        echo "Erro na preparação: " . mysqli_error($conexao);
        return [];
    }

    mysqli_stmt_bind_param($comando, "i", $idusuario);

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_aula_agendadas = [];
    while ($aula_agendada = mysqli_fetch_assoc($resultados)) {
        $lista_aula_agendadas[] = $aula_agendada;
    }

    mysqli_stmt_close($comando);
    desconectar($conexao);

    return $lista_aula_agendadas;
}

function listarPagamentosDetalhados($idpagamento = null)
{
    $conexao = conectar();

    $sql = "SELECT 
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
                pf.usuario_id,
                pf.nome AS usuario_nome,
                u.email AS usuario_email,
                pf.telefone AS usuario_telefone,
                prod.idproduto,
                prod.nome AS produto_nome,
                prod.preco AS produto_preco,
                prod.quantidade_estoque,
                pp.quantidade AS quantidade_produto
            FROM pagamento p
            JOIN pagamento_detalhe pd ON p.idpagamento = pd.pagamento_id
            JOIN pedido ped ON p.idpagamento = ped.pagamento_id
            JOIN usuario u ON ped.usuario_id = u.idusuario
            JOIN perfil_usuario pf ON u.idusuario = pf.usuario_id
            JOIN item_pedido pp ON ped.idpedido = pp.pedido_id
            JOIN produto prod ON pp.produto_id = prod.idproduto";

    if ($idpagamento !== null) {
        $sql .= " WHERE p.idpagamento = ?";
    }

    $sql .= " ORDER BY p.idpagamento, ped.idpedido";

    $comando = mysqli_prepare($conexao, $sql);
    if (!$comando) {
        echo "Erro na preparação: " . mysqli_error($conexao);
        desconectar($conexao);
        return [];
    }

    if ($idpagamento !== null) {
        mysqli_stmt_bind_param($comando, "i", $idpagamento);
    }

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_pagamento_detalhados = [];
    while ($pagamento_detalhado = mysqli_fetch_assoc($resultados)) {
        $lista_pagamento_detalhados[] = $pagamento_detalhado;
    }

    mysqli_stmt_close($comando);
    desconectar($conexao);

    return $lista_pagamento_detalhados;
}

function listarMetaUsuario($idmeta = null)
{
  $conexao = conectar();

  if ($idmeta !== null) {
    // Busca apenas a meta específica
    $sql = "SELECT 
              pf.nome,
              m.idmeta,
              m.descricao,
              m.data_inicio,
              m.data_limite,
              m.status
            FROM meta_usuario AS m
            JOIN perfil_usuario AS pf ON m.usuario_id = pf.usuario_id
            WHERE pf.usuario_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idmeta);
  } else {
    // Busca todas as metas
    $sql = "SELECT 
              pf.nome,
              m.idmeta,
              m.descricao,
              m.data_inicio,
              m.data_limite,
              m.status
            FROM meta_usuario AS m
            JOIN perfil_usuario AS pf ON m.usuario_id = pf.usuario_id";
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


function listarAvaliacaoFisica($usuarioId)
{
  $conexao = conectar();

  // Se não passou usuário, já retorna falso
  if ($usuarioId == null) {
    return false;
  }

  $sql = "SELECT
                pf.nome AS nome_usuario,
                a.peso,
                a.altura,
                a.imc,
                a.percentual_gordura,
                a.data_avaliacao
            FROM avaliacao_fisica AS a
            JOIN perfil_usuario AS pf ON a.usuario_id = pf.usuario_id
            WHERE a.usuario_id = ?
            ORDER BY a.data_avaliacao DESC";  // só pega a avaliação mais recente

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $usuarioId);
  if (!$comando) {
    // Erro na preparação, pode tratar ou retornar false
    return false;
  }
  mysqli_stmt_execute($comando);
  $resultados = mysqli_stmt_get_result($comando);
  $lista_avaliacoes = [];
  while ($avaliacao = mysqli_fetch_assoc($resultados)) {
    $lista_avaliacoes[] = $avaliacao;
  }

  mysqli_stmt_close($comando);
  mysqli_close($conexao);

  // Retorna o array da avaliação ou false caso não tenha
  return $lista_avaliacoes ;
}


function listarCargo($idcargo)
{
  $conexao = conectar();

  if ($idcargo != null) {
    $sql = " SELECT *
    FROM cargo 
    WHERE idcargo = ?";
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
    pf.nome,
    d.descricao,
    d.data_inicio,
    d.data_fim,
    r.tipo,
    r.horario
    FROM refeicao AS r
    JOIN dieta AS d ON r.dieta_id = d.iddieta
    JOIN perfil_usuario AS pf ON d.usuario_id = pf.usuario_id
    WHERE idrefeicao = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idrefeicao);
  } else {
    $sql = " SELECT 
    pf.nome,
    d.descricao,
    d.data_inicio,
    d.data_fim,
    r.tipo,
    r.horario
    FROM refeicao AS r
    JOIN dieta AS d ON r.dieta_id = d.iddieta
    JOIN perfil_usuario AS pf ON d.usuario_id = pf.usuario_id";
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

function listarAlimentos($idalimento = null)
{
    $conexao = conectar();

    if ($idalimento !== null) {
        $sql = "SELECT * FROM alimento WHERE idalimento = ?";
        $comando = mysqli_prepare($conexao, $sql);
        if (!$comando) {
            echo "Erro na preparação: " . mysqli_error($conexao);
            return [];
        }
        mysqli_stmt_bind_param($comando, "i", $idalimento);
    } else {
        $sql = "SELECT * FROM alimento";
        $comando = mysqli_prepare($conexao, $sql);
        if (!$comando) {
            echo "Erro na preparação: " . mysqli_error($conexao);
            return [];
        }
    }

    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    $lista_alimentos = [];
    while ($alimento = mysqli_fetch_assoc($resultados)) {
        $lista_alimentos[] = $alimento;
    }

    mysqli_stmt_close($comando);
    desconectar($conexao);

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
    SELECT 
     rf.idresposta, 
     rf.mensagem, 
     rf.data_resposta, 
     pf.nome AS nome_usuario, 
     rf.forum_id, 
     f.descricao
    FROM resposta_forum rf
    JOIN perfil_usuario AS pf ON rf.usuario_id = pf.usuario_id
    JOIN forum AS f ON rf.forum_id = f.idtopico
    WHERE rf.idresposta = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idresposta);
  } else {
    // Consulta para pegar todas as respostas com os nomes dos usuários
    $sql = "
    SELECT 
     rf.idresposta, 
     rf.mensagem, 
     rf.data_resposta, 
     pf.nome AS nome_usuario, 
     rf.forum_id, f.descricao
    FROM resposta_forum rf
    JOIN usuario u ON rf.usuario_id = pf.usuario_id
    JOIN forum AS f ON rf.forum_id = f.idtopico";
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
            pf.nome AS usuario_nome, 
            p.nome AS produto_nome, 
            ip.quantidade, 
            ip.preco_unitario, 
            ped.status, 
            ped.data_pedido
        FROM pedido ped
        JOIN item_pedido ip ON ped.idpedido = ip.pedido_id
        JOIN produto p ON ip.produto_id = p.idproduto
        JOIN perfil_usuario pf ON ped.usuario_id = pf.usuario_id
        WHERE ped.usuario_id = ?
        ORDER BY ped.data_pedido DESC
    ";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $usuario_id);
  } else {
    $sql = "    SELECT 
            ped.idpedido, 
            pf.nome AS usuario_nome, 
            p.nome AS produto_nome, 
            ip.quantidade, 
            ip.preco_unitario, 
            ped.status, 
            ped.data_pedido
        FROM pedido ped
        JOIN item_pedido ip ON ped.idpedido = ip.pedido_id
        JOIN produto p ON ip.produto_id = p.idproduto
        JOIN perfil_usuario pf ON ped.usuario_id = pf.usuario_id
        ORDER BY ped.data_pedido DESC";
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
        pf.nome AS usuario_nome, 
        p.nome AS produto_nome, 
        ip.quantidade, 
        ip.preco_unitario, 
        ped.status, 
        ped.data_pedido
    FROM pedido ped
    JOIN item_pedido ip ON ped.idpedido = ip.pedido_id
    JOIN produto p ON ip.produto_id = p.idproduto
    JOIN usuario u ON ped.usuario_id = pf.usuario_id
    WHERE ped.usuario_id = ?
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
    $sql = " SELECT * FROM usuario WHERE idusuario = ?";
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
function listarUsuarioTipo($tipo)
{
  $conexao = conectar();


  $sql = " SELECT * FROM usuario WHERE tipo_usuario = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $tipo);

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
    $sql = "SELECT 
      pf.nome,
      p.tipo,
      p.duracao,
      a.data_inicio,
      a.data_fim
    FROM assinatura AS a
    JOIN plano AS p ON a.plano_id = p.idplano
    JOIN perfil_usuario AS pf ON a.usuario_id = pf.usuario_id
    WHERE a.idassinatura = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idassinatura);
  } else {
    $sql = "SELECT 
      pf.nome,
      p.tipo,
      p.duracao,
      a.data_inicio,
      a.data_fim
    FROM assinatura AS a
    JOIN plano AS p ON a.plano_id = p.idplano
    JOIN perfil_usuario AS pf ON a.usuario_id = pf.usuario_id";
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


function deletarDietaAlimentar($iddieta, $idalimento)
{
  $conexao = conectar();
  $sql = "DELETE FROM dieta_alimentar WHERE $iddieta = ? and $idalimento = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "ii", $iddieta, $alimento);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarPlano($idplano)
{
  $conexao = conectar();
  $sql = "DELETE FROM plano WHERE $idplano = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idplano);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou;
}

function deletarAlimento($idalimento)
{
  $conexao = conectar();
  $sql = "DELETE FROM alimento WHERE $idalimento = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idalimento);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarCategoriaProduto($idcategoria)
{
  $conexao = conectar();
  $sql = "DELETE FROM categoria_produto WHERE $idcategoria = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idcategoria);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarPagamentoDetalhe($idpagaemento2)
{
  $conexao = conectar();
  $sql = "DELETE FROM pagamento_detalhe WHERE idpagamento2 = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idpagamento2);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarItemPedido($iditem)
{
  $conexao = conectar();
  $sql = "DELETE FROM item_pedido WHERE $iditem = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $iditem);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarAulaAgendada($idaula)
{
  $conexao = conectar();
  $sql = "DELETE FROM aula_agendada WHERE $idaula = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idaula);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarTreino($idtreino)
{
  $conexao = conectar();
  $sql = "DELETE FROM treino WHERE $idtreino = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idtreino);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarHistoricoTreino($idhistorico)
{
  $conexao = conectar();
  $sql = "DELETE FROM historico_treino WHERE $idhistorico = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idhistorico);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarPedido($idpedido)
{
  $conexao = conectar();
  $sql = "DELETE FROM pedido WHERE $idpedido = ?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idpedido);
  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  return $funcionou; // Retorna true se a exclusão foi bem-sucedida, false caso contrário
}

function deletarExercicio($idexercicio): bool
{
    $conexao = conectar();

    // Corrigindo o SQL: o campo da tabela deve estar à esquerda
    $sql = "DELETE FROM exercicio WHERE idexercicio = ?";
    $comando = mysqli_prepare($conexao, $sql);

    if (!$comando) {
        echo "Erro na preparação: " . mysqli_error($conexao);
        return false;
    }

    mysqli_stmt_bind_param($comando, "i", $idexercicio);

    try {
        $funcionou = mysqli_stmt_execute($comando);
    } catch (mysqli_sql_exception $e) {
        // Usa a função traduzirErroMySQL para mostrar mensagem amigável
        echo "❌ " . traduzirErroMySQL($e->getCode());
        $funcionou = false;
    }

    mysqli_stmt_close($comando);
    desconectar($conexao);

    return $funcionou;
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

function editarRespostaForum($idresposta, $mensagem, $usuario_id, $forum_id)
{
  $conexao = conectar();

  $sql = "UPDATE resposta_forum 
          SET mensagem = ?, usuario_id = ?, forum_id = ?
          WHERE idresposta = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "siii", $mensagem, $usuario_id, $forum_id, $idresposta);

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

function cadastrarItemPedido($pedido_id, $produto_id, $quantidade, $preco_unitario): bool
{
  $conexao = conectar();

  $sql = " INSERT INTO item_pedido (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?,?,?,?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "iiid", $pedido_id, $produto_id, $quantidade, $preco_unitario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function cadastrarPagamento($usuario_id, $valor, $data_pagamento, $metodo, $status = 'sucesso')
{
  $conexao = conectar();

  $sql = "INSERT INTO pagamento (valor, data_pagamento, metodo, status)
            VALUES (?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "dsss", $valor, $data_pagamento, $metodo, $status);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function editarPedido($idpedido, $usuario_id, $data_pedido, $status)
{
  $conexao = conectar();

  $sql = "UPDATE pedido 
          SET usuario_id = ?, data_pedido = ?, status = ?
          WHERE idpedido = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros
  mysqli_stmt_bind_param($comando, "issi", $usuario_id, $data_pedido, $status, $idpedido);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarAlimento($nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem)
{
  $conexao = conectar();

  $sql = " INSERT INTO alimento (nome, calorias, carboidratos, proteinas, gorduras, porcao, categoria, foto_de_perfil)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "sddddsss", $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);

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

function editarAssinatura($idassinatura, $data_inicio, $data_fim, $usuario_id)
{
  $conexao = conectar();

  $sql = "UPDATE assinatura 
            SET data_inicio = ?, data_fim = ?, usuario_id = ?
            WHERE idassinatura = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem correta dos parâmetros: data_inicio, data_fim, usuario_id, idassinatura
  mysqli_stmt_bind_param($comando, "ssii", $data_inicio, $data_fim, $usuario_id, $idassinatura);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function editarPagamentoDetalhe($idpagamento2, $pagamento_id, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto): bool
{
    $conexao = conectar();

    $sql = "UPDATE pagamento_detalhe 
               SET pagamento_id = ?, 
                   tipo = ?, 
                   bandeira_cartao = ?, 
                   ultimos_digitos = ?, 
                   codigo_pix = ?, 
                   linha_digitavel_boleto = ?
             WHERE idpagamento2 = ?";

    $comando = mysqli_prepare($conexao, $sql);

    if (!$comando) {
        echo "Erro na preparação: " . mysqli_error($conexao);
        return false;
    }

    // Ordem: pagamento_id (i), tipo (s), bandeira_cartao (s), ultimos_digitos (s), codigo_pix (s), linha_digitavel_boleto (s), idpagamento2 (i)
    mysqli_stmt_bind_param(
        $comando,
        "isssssi",
        $pagamento_id,
        $tipo,
        $bandeira_cartao,
        $ultimos_digitos,
        $codigo_pix,
        $linha_digitavel_boleto,
        $idpagamento2
    );

    $funcionou = mysqli_stmt_execute($comando);

    if (!$funcionou) {
        echo "Erro na execução: " . mysqli_stmt_error($comando);
    }

    mysqli_stmt_close($comando);
    desconectar($conexao);

    return $funcionou;
}

function cadastrarDieta($descricao, $data_inicio, $data_fim, $usuario_id)
{
  $conexao = conectar();

  $sql = "INSERT INTO dieta (descricao, data_inicio, data_fim, usuario_id)
            VALUES (?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem dos parâmetros: descricao (s), data_inicio (s), data_fim (s), usuario_id (i)
  mysqli_stmt_bind_param($comando, "sssi", $descricao, $data_inicio, $data_fim, $usuario_id);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
function cadastrarDietaAlimentar($idrefeicao, $idalimento, $quantidade, $observacao): bool
{
  $conexao = conectar();

  $sql = "INSERT INTO dieta_alimentar (refeicao_id, alimento_id, quantidade, observacao)
            VALUES (?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  // Ordem dos parâmetros: refeicao_id (i), alimento_id (i), quantidade (d), observacao (s)
  mysqli_stmt_bind_param($comando, "iids", $idrefeicao, $idalimento, $quantidade, $observacao);

  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}
//

function cadastrarFuncionario($nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem): bool
{
  $conexao = conectar();

  $sql = "INSERT INTO funcionario (nome, email, telefone, data_contratacao, salario, cargo_id, usuario_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "ssssdii", $nome, $email, $telefone, $data_contratacao, $salario, $cargo_id, $imagem);

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

function editarAlimento($idalimento, $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem)
{
  $conexao = conectar();

  $sql = "UPDATE alimento 
            SET nome = ?, calorias = ?, carboidratos = ?, proteinas = ?, gorduras = ?, porcao = ?, categoria = ?, foto_de_perfil = ?
            WHERE idalimento = ?";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }

  mysqli_stmt_bind_param($comando, "sddddsssi", $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem, $idalimento);

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

  $sql = "INSERT INTO meta_usuario (usuario_id, descricao, data_inicio, data_limite, status) VALUES (?, ?, ?, ?, ?)";

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

function cadastrarAulaAgendada($data_aula, $dia_semana, $hora_inicio, $hora_fim, $idtreino,$funcionario_id)
{
  $conexao = conectar();

  $sql = "INSERT INTO aula_agendada (data_aula, dia_semana, hora_inicio, hora_fim, treino_id, funcionario_id)
            VALUES (?, ?, ?, ?, ?, ?)";

  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    echo "Erro na preparação: " . mysqli_error($conexao);
    return false;
  }
  mysqli_stmt_bind_param($comando, 'ssssii', $data_aula, $dia_semana, $hora_inicio, $hora_fim,  $idtreino, $funcionario_id);
  $funcionou = mysqli_stmt_execute($comando);

  if (!$funcionou) {
    echo "Erro na execução: " . mysqli_stmt_error($comando);
  }

  mysqli_stmt_close($comando);
  desconectar($conexao);

  return $funcionou;
}

function gerarCodigoPix($tamanho = 32)
{
  $caracteres = array_merge(range('a', 'z'), range('0', '9'));
  $codigo = '';

  for ($i = 0; $i < $tamanho; $i++) {
    $codigo .= $caracteres[array_rand($caracteres)];
  }

  return $codigo;
}
// numeração do adms[0], aluno[1] e funcionário(Professores)[2]
function gerarNumeroMatriculaPorTipo($tipo)
{
  // Define o comprimento desejado por tipo
  switch ($tipo) {
    case 0: // ADM
      $comprimento = 5;
      break;
    case 1: // Aluno
      $comprimento = 15;
      break;
    case 2: // Funcionário
      $comprimento = 10;
      break;
    default:
      return "Tipo inválido";
  }

  // Gera um número aleatório com o comprimento certo
  $min = (int)str_pad('1', $comprimento, '0');     // Ex: 10000
  $max = (int)str_pad('', $comprimento, '9');      // Ex: 99999

  return strval(rand($min, $max));
}

function verificarTipoUsuario($email)
{
  $conexao = conectar(); // usa sua função de conexão
  $sql = "SELECT tipo_usuario FROM usuario WHERE email = ?";
  $comando = mysqli_prepare($conexao, $sql);

  if (!$comando) {
    die("Erro ao preparar: " . mysqli_error($conexao));
  }

  mysqli_stmt_bind_param($comando, 's', $email);
  mysqli_stmt_execute($comando);
  mysqli_stmt_bind_result($comando, $tipo);

  if (mysqli_stmt_fetch($comando)) {
    return $tipo;
  } else {
    return false; // email não encontrado
  }
}

function listarUsuarioCompleto($id)
{

  // Cria conexão
  $conexao = conectar();

  // Checa conexão
  if ($conexao->connect_error) {
    die(json_encode(['error' => 'Erro na conexão: ' . $conexao->connect_error]));
  }

  // Sua query enorme - aqui só exibe 1 campo pra exemplo, substitui pela sua completa depois
  $sql = "
SELECT

    -- USUÁRIO
    u.idusuario,
    u.email,
    u.senha,
    u.tipo_usuario,

    -- PERFIL USUÁRIO
    pf.nome,
    pf.cpf,
    pf.data_nascimento,
    pf.numero_matricula,
    pf.foto_perfil,

    -- ENDEREÇO
    e.cep,
    e.rua,
    e.numero,
    e.complemento,
    e.bairro,
    e.cidade,
    e.estado,

    -- ASSINATURA
    a.idassinatura,
    a.data_inicio,
    a.data_fim,

    -- PLANO
    p.idplano,
    p.tipo AS tipo_plano,
    p.duracao,

    -- AVALIAÇÃO FÍSICA
    af.idavaliacao,
    af.peso,
    af.altura,
    af.imc,
    af.percentual_gordura,
    af.data_avaliacao,

    -- DIETA
    d.iddieta,
    d.descricao AS descricao_dieta,
    d.data_inicio,
    d.data_fim,

    -- REFEIÇÃO
    r.idrefeicao,
    r.tipo AS tipo_refeicao,
    r.horario,

    -- ALIMENTO
    al.idalimento,
    al.nome AS nome_alimento,
    al.calorias,
    al.carboidratos,
    al.proteinas,
    al.gorduras,

    -- DIETA_ALIMENTAR
    da.quantidade,
    da.observacao,

    -- TREINO
    t.idtreino,
    t.tipo AS tipo_treino,
    t.horario AS horario_treino,
    t.descricao AS descricao_treino,

    -- TREINO_EXERCÍCIO
    te.idtreino2,
    te.series,
    te.repeticoes,
    te.carga,
    te.intervalo_segundos,

    -- EXERCÍCIO
    ex.idexercicio,
    ex.nome AS nome_exercicio,
    ex.grupo_muscular,

    -- HISTÓRICO DE TREINO
    ht.idhistorico,
    ht.data_execucao,
    ht.observacoes,

    -- METAS DO USUÁRIO
    mu.idmeta,
    mu.descricao AS descricao_meta,
    mu.data_inicio,
    mu.data_limite,
    mu.status,

    -- FÓRUM
    f.idtopico,
    f.titulo,
    f.descricao AS descricao_topico,
    f.data_criacao,

    -- RESPOSTAS DO FÓRUM
    rf.idresposta,
    rf.mensagem,
    rf.data_resposta,

    -- PEDIDO
    pd.idpedido,
    pd.data_pedido,
    pd.status AS status_pedido,

    -- ITEM DO PEDIDO
    ip.quantidade AS quantidade_produto,
    ip.preco_unitario,

    -- PRODUTO
    pr.idproduto,
    pr.nome AS nome_produto,
    pr.descricao AS descricao_produto,
    pr.preco,

    -- PAGAMENTO
    pg.idpagamento,
    pg.valor,
    pg.data_pagamento,
    pg.metodo,
    pg.status AS status_pagamento,

    -- DETALHE DE PAGAMENTO
    pd2.tipo AS tipo_pagamento,
    pd2.bandeira_cartao,
    pd2.ultimos_digitos,


    -- RECUPERAÇÃO DE SENHA
    rs.idrecuperacao_senha,
    rs.codigo,
    rs.tempo_expiracao

FROM gym_genesis.usuario u

    LEFT JOIN gym_genesis.perfil_usuario pf on pf.usuario_id = pf.usuario_id
    
    LEFT JOIN gym_genesis.endereco e 
        ON pf.usuario_id = e.usuario_id

    LEFT JOIN gym_genesis.assinatura a 
        ON pf.usuario_id = a.usuario_id

    LEFT JOIN gym_genesis.plano p 
        ON a.plano_id = p.idplano

    LEFT JOIN gym_genesis.avaliacao_fisica af 
        ON pf.usuario_id = af.usuario_id

    LEFT JOIN gym_genesis.dieta d 
        ON pf.usuario_id = d.usuario_id

    LEFT JOIN gym_genesis.refeicao r 
        ON d.iddieta = r.dieta_id

    LEFT JOIN gym_genesis.dieta_alimentar da 
        ON r.idrefeicao = da.refeicao_id

    LEFT JOIN gym_genesis.alimento al 
        ON da.alimento_id = al.idalimento

    LEFT JOIN gym_genesis.treino t 
        ON pf.usuario_id = t.funcionario_id

    LEFT JOIN gym_genesis.treino_exercicio te 
        ON t.idtreino = te.treino_id

    LEFT JOIN gym_genesis.exercicio ex 
        ON te.exercicio_id = ex.idexercicio


    LEFT JOIN gym_genesis.historico_treino ht 
        ON pf.usuario_id = ht.usuario_id

    LEFT JOIN gym_genesis.meta_usuario mu 
        ON pf.usuario_id = mu.usuario_id

    LEFT JOIN gym_genesis.forum f 
        ON pf.usuario_id = f.usuario_id

    LEFT JOIN gym_genesis.resposta_forum rf 
        ON pf.usuario_id = rf.usuario_id

    LEFT JOIN gym_genesis.pedido pd 
        ON pf.usuario_id = pd.usuario_id

    LEFT JOIN gym_genesis.item_pedido ip 
        ON pd.idpedido = ip.pedido_id

    LEFT JOIN gym_genesis.produto pr 
        ON ip.produto_id = pr.idproduto

    LEFT JOIN gym_genesis.pagamento pg 
        ON pd.pagamento_id = pg.idpagamento

    LEFT JOIN gym_genesis.pagamento_detalhe pd2 
        ON pg.idpagamento = pd2.pagamento_id

    LEFT JOIN gym_genesis.recuperacao_senha rs 
        ON pf.usuario_id = rs.usuario_id

WHERE
    pf.usuario_id = $id
LIMIT 1;
";


  // Executa a query
  $resultado = mysqli_query($conexao, $sql);

  if (!$resultado) {
    die(json_encode(['error' => 'Erro na query: ' . $conexao->error]));
  }

  // Cria array pra armazenar resultados
  $dados = [];

  while ($linha = mysqli_fetch_assoc($resultado)) {
    $dados[] = $linha;
  }

  // Fecha conexão
  $conexao = mysqli_close($conexao);


  return $dados;
}
function atualizarFotoUsuario($imagem, $idusuario)
{
  $conexao = conectar();
  $sql = 'UPDATE perfil_usuario SET foto_perfil = ? WHERE usuario_id = ?';
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, 'si', $imagem, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

function calcularDataFinal($tipoPlano, $dataInicio = null): string
{
  if (!$dataInicio) {
    $dataInicio = date('Y-m-d'); // se não for passado, pega a data atual
  }

  $data = new DateTime($dataInicio);

  switch (strtolower($tipoPlano)) {
    case 'mensal':
      $data->modify('+1 month');
      break;
    case 'trimestral':
      $data->modify('+3 months');
      break;
    case 'semestral':
      $data->modify('+6 months');
      break;
    case 'anual':
      $data->modify('+1 year');
      break;
    default:
      throw new Exception("Tipo de plano inválido.");
  }

  return $data->format('Y-m-d');
}



function enviarResposta($sucesso, $mensagem, $dados = []): never
{
  echo json_encode([
    'sucesso' => $sucesso,
    'mensagem' => $mensagem,
    'dados' => $dados

  ], JSON_UNESCAPED_UNICODE);
  exit;
}

function calcularIMC($pesoKg, $alturaCm): string
{
  $alturaMetros = $alturaCm / 100;

  // Validação básica
  if ($pesoKg <= 0 || $alturaMetros <= 0) {
    return "Peso e altura devem ser maiores que zero.";
  }

  // Cálculo do IMC
  $imc = $pesoKg / ($alturaMetros * $alturaMetros);

  // Retorna o IMC com duas casas decimais
  return number_format($imc, 2);
}


function cadastrarHistoricoPeso($idusuario, $peso)
{
  $conexao = conectar();
  $sql = "INSERT INTO historico_peso (peso, usuario_id) VALUES (?, ?)";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "di", $peso, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

function listarHistoricoPeso($idusuario)
{
  $conexao = conectar();

  if ($idusuario != null) {
    $sql = "SELECT * FROM historico_peso WHERE usuario_id = ? ORDER BY data_registro DESC";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $idusuario);
  } else {
    $sql = "SELECT * FROM historico_peso ORDER BY data_registro DESC";
    $comando = mysqli_prepare($conexao, $sql);
  }

  mysqli_stmt_execute($comando);
  $resultado = mysqli_stmt_get_result($comando);
  $dados = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $dados;
}

function editarHistoricoPeso($idhistorico_peso, $peso)
{
  $conexao = conectar();
  $sql = "UPDATE historico_peso SET peso=? WHERE idhistorico_peso=?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "di", $peso, $idhistorico_peso);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}

function deletarHistoricoPeso($idhistorico_peso)
{
  $conexao = conectar();
  $sql = "DELETE FROM historico_peso WHERE idhistorico_peso=?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idhistorico_peso);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarCupomDesconto($idcupom)
{
  $conexao = conectar();
  $sql = "DELETE FROM cupom_desconto WHERE idcupom=?";
  $comando = mysqli_prepare($conexao, $sql);
  mysqli_stmt_bind_param($comando, "i", $idcupom);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}


function traduzirErroMySQL(int $codigoErro): string
{
    $erros = [
        // Erros de conexão e autenticação
        1044 => "Acesso negado: usuário não tem permissão para acessar o banco de dados especificado.",
        1045 => "Falha na autenticação: usuário ou senha do banco de dados inválidos.",
        1049 => "Banco de dados não encontrado. Verifique o nome no arquivo de configuração.",
        2002 => "Erro de conexão: servidor MySQL não encontrado ou inacessível.",
        2003 => "Não foi possível conectar ao servidor MySQL na porta especificada.",
        2005 => "Servidor MySQL desconhecido. Verifique o endereço do host.",
        2006 => "Servidor MySQL desconheceu a conexão.",
        2013 => "Conexão perdida com o servidor MySQL durante a consulta.",
        2017 => "O servidor MySQL foi reiniciado e a conexão foi perdida.",
        
        // Erros de sintaxe e consulta
        1054 => "Coluna desconhecida na consulta. Confirme se os nomes das colunas estão corretos.",
        1064 => "Erro de sintaxe SQL. Verifique a consulta para erros de digitação.",
        1146 => "Tabela não encontrada. Verifique se a tabela existe no banco.",
        1051 => "Tabela desconhecida. A tabela referenciada não existe.",
        1052 => "Coluna ambígua na cláusula WHERE/ORDER BY.",
        1053 => "Servidor desligado durante a consulta.",
        
        // Erros de integridade e constraints
        1062 => "Tentativa de inserir um valor duplicado em um campo único (UNIQUE).",
        1216 => "Não é possível adicionar ou atualizar: chave estrangeira violada.",
        1217 => "Não é possível excluir ou atualizar: chave estrangeira violada.",
        1364 => "Campo obrigatório não informado. Preencha todos os campos obrigatórios.",
        1451 => "Não é possível excluir: existem registros relacionados em outra tabela.",
        1452 => "Não é possível inserir/atualizar: chave estrangeira inválida (registro pai não existe).",
        
        // Erros de dados e tamanhos
        1406 => "Valor muito grande para a coluna. Reduza o tamanho do texto ou número.",
        1264 => "Valor fora do intervalo para a coluna. Número muito grande ou pequeno.",
        1265 => "Dados truncados para a coluna. Valor não corresponde ao tipo esperado.",
        1366 => "Valor incorreto para a coluna. Tipo de dado incompatível.",
        
        // Erros de privilégios e permissões
        1044 => "Acesso negado ao banco de dados para o usuário.",
        1142 => "Acesso negado: usuário não tem privilégios para executar esta operação.",
        1227 => "Acesso negado: você precisa do privilégio SUPER para esta operação.",
        
        // Erros de deadlock e transações
        1205 => "Timeout de lock excedido. Tente a operação novamente.",
        1213 => "Deadlock encontrado. Transação foi revertida.",
        1317 => "Consulta abortada durante a execução.",
        
        // Erros de servidor e configuração
        1040 => "Muitas conexões. Servidor atingiu o limite máximo de conexões.",
        2002 => "Não foi possível conectar ao servidor MySQL.",
        2003 => "Servidor MySQL não está respondendo.",
        2017 => "Conexão com o servidor MySQL foi perdida.",
        
        // Erros de armazenamento e tabelas
        1016 => "Não é possível abrir o arquivo da tabela.",
        1030 => "Erro de armazenamento: disco cheio ou problema de permissões.",
        1037 => "Memória insuficiente. Servidor está sem memória.",
        1038 => "Memória insuficiente para ordenação.",
        
        // Erros de grupo e replicação
        1041 => "Memória insuficiente no servidor.",
        1042 => "Endereço do host inválido.",
        1043 => "Protocolo de comunicação inválido.",
        
        // Outros erros comuns
        1292 => "Valor de data/hora incorreto.",
        1365 => "Divisão por zero na consulta.",
        1396 => "Operação falhou para o usuário. Pode não existir ou ter privilégios insuficientes.",
    ];

    return $erros[$codigoErro] ?? "Erro inesperado no banco de dados (código: $codigoErro).";
}