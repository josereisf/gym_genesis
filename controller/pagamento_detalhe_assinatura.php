<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idpagamento2 = $_POST['idpagamento2'] ?? 0;
$pagamento_idpagamento = $_POST['pagamento_idpagamento'] ?? null;
$tipo = $_POST['tipo'] ?? null;
$bandeira_cartao = $_POST['bandeira_cartao'] ?? null;
$ultimos_digitos = $_POST['ultimos_digitos'] ?? null;
$codigo_pix = $_POST['codigo_pix'] ?? null;
$linha_digitavel_boleto = $_POST['linha_digitavel_boleto'] ?? null;

switch ($acao) {
    case 'cadastrar':
        // cadastrarPagamentoDetalheAssinatura($pagamento_idpagamento, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto);
        break;
    case 'editar':
        // editarPagamentoDetalheAssinatura($idpagamento2, $pagamento_idpagamento, $tipo, $bandeira_cartao, $ultimos_digitos, $codigo_pix, $linha_digitavel_boleto);
        break;
    case 'listar':
        // listarPagamentoDetalheAssinatura($idpagamento2);
        break;
    case 'deletar':
        // deletarPagamentoDetalheAssinatura($idpagamento2);
        break;
}