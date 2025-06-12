<?php
require_once __DIR__ .'/../code/funcao.php';
$acao = $_GET ['acao'];

switch ($acao){
    case 'cadastrar':
        cadastrarUsuario();
    case 'editar':
        editarUsuario();
    case 'listar':
        listarUsuario($idusuario);
    case 'deletar':
        deletarUsuario($idusuario);
}