<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idrecuperacao_senha = $_POST['idrecuperacao_senha'] ?? 0;
$codigo = $_POST['codigo'] ?? null;
$usuario_idusuario = $_POST['usuario_idusuario'] ?? null;
$tempo_expiracao = $_POST['tempo_expiracao'] ?? null;

switch ($acao) {
    case 'cadastrar':
        // cadastrarRecuperacaoSenha($codigo, $usuario_idusuario, $tempo_expiracao);
        break;
    case 'editar':
        // editarRecuperacaoSenha($idrecuperacao_senha, $codigo, $usuario_idusuario, $tempo_expiracao);
        break;
    case 'listar':
        // listarRecuperacaoSenha($idrecuperacao_senha);
        break;
    case 'deletar':
        // deletarRecuperacaoSenha($idrecuperacao_senha);
        break;
}