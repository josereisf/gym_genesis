<?php
require_once __DIR__ . '/../code/funcao.php';
$acao = $_GET['acao'];

$idprofessor_aluno = $_POST['idprofessor_aluno'] ?? 0;
$idprofessor = $_POST['idprofessor'] ?? null;
$idaluno = $_POST['idaluno'] ?? null;

// Funções não encontradas, sugestão de nomes e parâmetros:
switch ($acao) {
    case 'cadastrar':
        // cadastrarProfessorAluno($idprofessor, $idaluno);
        break;
    case 'editar':
        // editarProfessorAluno($idprofessor_aluno, $idprofessor, $idaluno);
        break;
    case 'listar':
        // listarProfessorAluno($idprofessor_aluno);
        break;
    case 'deletar':
        // deletarProfessorAluno($idprofessor_aluno);
        break;
}