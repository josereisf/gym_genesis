<?php
require_once 'funcao.php';

$conexao = conectar();

// Recebe os dados do formulário
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$link = $_POST['link'];
$categoria = $_POST['categoria'];
$outraCategoria = isset($_POST['outraCategoria']) ? $_POST['outraCategoria'] : null;

// Verifica se a categoria é "Outros" e se foi fornecida uma nova categoria
if ($categoria === 'Outros' && !empty($outraCategoria)) {
    $categoria = $outraCategoria;
}

// Processamento do upload da imagem
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $diretorio_destino = '/var/www/html/code/img/'; // Caminho absoluto

    // Verifica se o diretório existe e tem permissão de escrita
    if (!is_dir($diretorio_destino)) {
        if (!mkdir($diretorio_destino, 0755, true)) {
            die("Erro: Não foi possível criar o diretório de destino.");
        }
    }

    if (!is_writable($diretorio_destino)) {
        die("Erro: O diretório de destino não tem permissão de escrita.");
    }

    // Sanitiza o nome do arquivo
    $nome_arquivo = $_FILES['imagem']['name'];
    $nome_arquivo = preg_replace('/[^a-zA-Z0-9._-]/', '_', $nome_arquivo); // Remove caracteres inválidos
    $nome_arquivo = uniqid() . '_' . $nome_arquivo; // Adiciona um ID único ao nome do arquivo
    $caminho_destino = $diretorio_destino . $nome_arquivo;

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_destino)) {
        $imagem = $caminho_destino; // Salva o caminho da imagem no banco de dados
    } else {
        die("Erro ao fazer upload da imagem.");
    }
} else {
    die("Erro: Nenhuma imagem foi enviada ou ocorreu um erro no upload.");
}
// // Insere o produto no banco de dados
$sql = "INSERT INTO `produtos`(`nome`, `preco`, `descricao`, `imagem`, `link`, `categoria`)
         VALUES ('{$nome}', '{$preco}', '{$descricao}', '{$imagem}', '{$link}', '{$categoria}')";

$resultado = mysqli_query($conexao, $sql);

if (!$resultado) {
    die("Erro ao cadastrar o produto: " . mysqli_error($conexao));
}

desconectar($conexao);

//Exibe uma mensagem de sucesso e redireciona
echo "<script>alert('Cadastro realizado com sucesso!')</script>";
echo "<script>location.href='../admin/index.php?pagina=tabela'</script>";
exit;
