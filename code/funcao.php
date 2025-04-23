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
function cadastrarTreino($tipo, $horario, $descricao, $idusuario){
  $conexao = conectar();

  $sql = 'INSERT INTO treino (tipo, horario, descricao, usuario_idusuario) VALUES (?, ?, ?, ?)';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'sssi', $tipo, $horario, $descricao, $idusuario);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function editarTreino($idtreino, $tipo, $horario, $descricao){
  $conexao = conectar();

  $sql = 'UPDATE treino SET descricao=?, data_inicio=?, data_limite=?, status=? WHERE idmeta=?';
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_bind_param($comando, 'ssssi', $descricao, $data_inicio, $data_limite, $status, $idmeta);

  $funcionou = mysqli_stmt_execute($comando);
  mysqli_stmt_close($comando);
  desconectar($conexao);
  return $funcionou;
}
function deletarAvaliacaoFisica($idusuario)
{
  $conexao = conectar();
  $sql = "DELETE FROM avaliacao_fisica WHERE usuario_idusuario=?";
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


function listarDietaAlimentos($iddieta_alimentar = null)
{
  $conexao = conectar();

  if ($iddieta_alimentar !== null) {
    $sql = "SELECT * FROM dieta_alimento WHERE iddieta_alimentar = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $iddieta_alimentar);
  } else {
    $sql = "SELECT * FROM dieta_alimento";
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



    mysqli_stmt_bind_param($comando, "isssss", 
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
