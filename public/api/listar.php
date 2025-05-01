<?php
require_once '../../code/funcao.php';

// Ações e parâmetros a serem passados para as funções
$acoes = [
    "listarEnderecos" => ["tipo" => null],
    "listarEnderecosID" => ["id" => null, "tipo" => null],
    "listarFuncionarios" => ["idfuncionario" => null],
    "listarPlanos" => ["idplano" => null],
    "listarDietas" => ["idusuario" => null],
    "listarTreinoExercicio" => ["idtreino2" => null],
    "listarCupomDesconto" => ["idusuario" => null],
    "listarPedidos" => ["idpedido" => null],
    "listarProdutos" => ["idproduto" => null],
    "listarForum" => ["idtopico" => null],
    "listarHistoricoTreino" => ["idhistorico" => null],
    "listarPagamentos" => ["idpagamento" => null],
    "listarExercicio" => ["idexercicio" => null],
    "listarTreino" => ["idtreino" => null],
    "listarAulaAgendada" => ["idaula" => null],
    "listarPagamentosDetalhados" => ["idpagamento2" => null],
    "listarMetaUsuario" => ["idmeta" => null],
    "listarAvaliacaoFisica" => ["idavaliacao" => null],
    "listarCargo" => ["idcargo" => null],
    "listarRefeicoes" => ["idrefeicao" => null],
    "listarAlimentos" => ["idalimento" => null],
    "listarCategoriaProduto" => ["idcategoria" => null],
    "listarRespostaForum" => ["idresposta" => null],
    "listarItemPedido" => ["usuario_id" => null],
    "listarItemPedidosComFiltros" => [
        "usuario_id" => null, "status" => null, "data_inicio" => null, "data_fim" => null,
        "produto_nome" => null, "preco_min" => null, "preco_max" => null
    ],
    "listarUsuario" => ["idusuario" => null],
    "listarAssinaturas" => ["idassinatura" => null]
];

// Ação que o usuário enviou
$action = $_GET['action'] ?? '';

// Verifica se a ação existe no array de funções
if (array_key_exists($action, $acoes)) {
    // Obtém a função e os parâmetros
    $parametros = $acoes[$action];

    // Verifica se a função existe no arquivo de funções
    if (function_exists($action)) {
        // Preenche os parâmetros com os valores passados pela URL, se existirem
        foreach ($parametros as $key => $value) {
            if (isset($_GET[$key])) {
                $parametros[$key] = $_GET[$key];  // Atualiza o valor do parâmetro com o valor da URL
            }
        }

        // Chama a função com os parâmetros
        $dados = call_user_func_array($action, array_values($parametros));

        // Retorna os dados em formato JSON
        echo json_encode($dados);
    } else {
        http_response_code(400);
        echo json_encode(['erro' => "Função '$action' não encontrada."]);
    }
} else {
    http_response_code(400);
    echo json_encode(['erro' => 'Ação inválida']);
}
?>
