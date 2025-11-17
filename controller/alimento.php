<?php
require_once __DIR__ . '/../code/funcao.php';
$tabela = $_REQUEST['entidade'] ?? null;
$acao = $_REQUEST['acao'] ?? null;

// Detectar se é AJAX/fetch enviando JSON
$isJson = isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false;

// Ler inputs
if ($isJson) {
    header('Content-Type: application/json; charset=utf-8');
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
} else {
    $input = $_POST;

    $redir = header("Location: /public/sucesso.php?tabela=$tabela");
}

$idalimento = $input['idalimento'] ?? null;
$nome = $input['nome'] ?? null;
$calorias = $input['calorias'] ?? null;
$carboidratos = $input['carboidratos'] ?? null;
$proteinas = $input['proteinas'] ?? null;
$gorduras = $input['gorduras'] ?? null;
$porcao = $input['porcao'] ?? null;
$categoria = $input['categoria'] ?? null;
$imagem = $_FILES['foto_de_perfil'] ?? null;

if (isset($_FILES['foto_de_perfil']) && $_FILES['foto_de_perfil']['error'] === UPLOAD_ERR_OK) {
    $imagem = uploadImagem($_FILES['foto_de_perfil']);
} elseif (isset($input['foto_de_perfil']) && (!isset($_FILES['foto_de_perfil']) || $_FILES['foto_de_perfil']['error'] !== UPLOAD_ERR_OK)) {
    $imagem = $input['foto_de_perfil'];
} else {
    $imagem = null;
}

if (!$acao) {
    enviarResposta(false, 'Ação não informada');
}
print_r($imagem);
switch ($acao) {
    case 'cadastrar':
        if (
            !$nome || !$calorias || !$carboidratos ||
            !$proteinas || !$gorduras || !$porcao || !$categoria
        ) {
            // Cria um array com todos os campos e seus valores
            $campos = [
                'Nome' => $nome,
                'Calorias' => $calorias,
                'Carboidratos' => $carboidratos,
                'Proteínas' => $proteinas,
                'Gorduras' => $gorduras,
                'Porção' => $porcao,
                'Categoria' => $categoria
            ];

            // Filtra os que estão vazios
            $vazios = [];
            foreach ($campos as $campo => $valor) {
                if (empty($valor) && $valor !== '0') { // '0' é válido
                    $vazios[] = $campo;
                }
            }

            // Monta a mensagem de erro
            $msgErro = 'Os seguintes campos estão vazios: ' . implode(', ', $vazios);

            enviarResposta(false, $msgErro);
        }

        $ok = cadastrarAlimento($nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);
        if ($ok) {
            enviarResposta(true, 'Alimento cadastrado com sucesso');
                    if ($input === $_POST) {
                header('Location: ../listar.php');
        }
        } else {
            enviarResposta(false, 'Erro ao cadastrar alimento');
        }
        $redir;
        break;

    case 'editar':
        if (
            !$idalimento || !$nome || !$calorias || !$carboidratos ||
            !$proteinas || !$gorduras || !$porcao || !$categoria
        ) {
            // Cria um array com todos os campos e seus valores
            $campos = [
                'ID do alimento' => $idalimento,
                'Nome' => $nome,
                'Calorias' => $calorias,
                'Carboidratos' => $carboidratos,
                'Proteínas' => $proteinas,
                'Gorduras' => $gorduras,
                'Porção' => $porcao,
                'Categoria' => $categoria
            ];

            // Filtra os que estão vazios
            $vazios = [];
            foreach ($campos as $campo => $valor) {
                if (empty($valor) && $valor !== '0') { // '0' é válido
                    $vazios[] = $campo;
                }
            }

            // Monta a mensagem de erro
            $msgErro = 'Os seguintes campos estão vazios: ' . implode(', ', $vazios);

            enviarResposta(false, $msgErro);
        }
        $ok = editarAlimento($idalimento, $nome, $calorias, $carboidratos, $proteinas, $gorduras, $porcao, $categoria, $imagem);
        if ($ok) {
            enviarResposta(true, 'Alimento editado com sucesso');
                if ($input === $_POST) {
                header('Location: ../listar.php');
                }
        } else {
            enviarResposta(false, 'Erro ao editar alimento');
        }
        $redir;
        break;

    case 'listar':
        $dados = listarAlimentos($idalimento);
        if ($dados) {
            enviarResposta(true, 'Alimentos listados com sucesso', $dados);
        } else {
            enviarResposta(false, 'Erro ao listar alimentos');
        }
        $redir;
        break;

    case 'deletar':
        if (!$idalimento) {
            enviarResposta(false, 'ID do alimento não informado');
        }
        $ok = deletarAlimento($idalimento);
        if ($ok) {
            enviarResposta(true, 'Alimento deletado com sucesso');
        } else {
            enviarResposta(false, 'Erro ao deletar alimento');
        }
        $redir;
        break;

    default:
        enviarResposta(false, 'Ação i
        $redir;nválida');
        break;
}
