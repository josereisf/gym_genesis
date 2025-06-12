<?php
require_once __DIR__ .'/../code/funcao.php';
$acao = $_GET ['acao'];

switch ($acao){
    case 'cadastrar':
        cadastrarFuncionario();
    case 'editar':
        editarFuncionario();
    case 'listar':
        listarFuncionarios($idusuario);
    case 'deletar':
        deletarFuncionario($idusuario);
}