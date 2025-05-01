<?php
require_once '../../code/funcao.php';

$rotas = [
    'listarEnderecos' => 'teste_listarEnderecos.php', // nao esta funcionando
    'listarEnderecosID' => 'teste_listarEnderecos.php',
    'listarFuncionarios' => 'teste_listarFuncionarios.php',// nao esta funcionando
    'listarPlanos' => 'teste_listarPlanos.php',
    'listarDietas' => 'teste_listarDietas.php',// nao esta funcionando
    'listarTreinoExercicio' => 'teste_listarTreinoExercicio.php',// nao esta funcionando
    'listarCupomDesconto' => 'teste_listarCupomDesconto.php',
    'listarPedidos' => 'teste_listarPedidos.php',// nao esta funcionando
    'listarProdutos' => 'teste_listarProdutos.php', // nao esta funcionando
    'listarForum' => 'teste_listarForum.php', // nao esta funcionando
    'listarPagamentos' => 'teste_listarPagamentos.php', // nao esta funcionando
    'listarExercicio' => 'teste_listarExercicio.php', // nao esta funcionando
    'listarHorario' => 'teste_listarHorario.php', // nao esta funcionando
    'listarTreino' => 'teste_listarTreino.php',
    'listarAulaAgendada' => 'teste_listarAulaAgendada.php', // nao esta funcionando
    'listarMetaUsuario' => 'teste_listarMetaUsuario.php', // nao esta funcionando
    'listarPagamentosDetalhados' => 'teste_listarPagamentosDetalhados.php', // nao esta funcionando
    'listarAvaliacaoFisica' => 'teste_listarAvaliacaoFisica.php', // nao esta funcionando
    'listarCargo' => 'teste_listarCargo.php', // nao esta funcionando
    'listarRefeicoes' => 'teste_listarRefeicoes.php', // nao esta funcionando
    'listarAlimentos' => 'teste_listarAlimentos.php', // nao esta funcionando
    'listarCategoriaProduto' => 'teste_listarCategoriaProduto.php', // nao esta funcionando
    'listarRespostaForum' => 'teste_listarRespostaForum.php', // nao esta funcionando
    'listarItensPedido' => 'teste_listarItensPedido.php', // nao esta funcionando
    'listarUsuario' => 'teste_listarUsuario.php', // nao esta funcionando
    'listarAssinaturas' => 'teste_listarAssinaturas.php', // nao esta funcionando
];

$action = $_GET['action'] ?? '';

if (array_key_exists($action, $rotas)) {
    require_once "../../code/tests/{$rotas[$action]}";
    exit;
}

http_response_code(400);
echo json_encode(['erro' => 'Ação inválida']);
