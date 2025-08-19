<?php
// ===============================
// CONFIGURAÇÃO DE ERROS
// ===============================
error_reporting(E_ALL);
ini_set('display_errors', 1); // mostrar na tela em DEV
ini_set('log_errors', 1);     
ini_set('error_log', __DIR__ . '/erros.log');

// ===============================
// HANDLERS
// ===============================
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

set_exception_handler(function($e) {
    echo "<p style='color:red'>⚠️ Exceção capturada: " . $e->getMessage() . "</p>";
    error_log("Exceção não tratada: " . $e->getMessage());
});

register_shutdown_function(function() {
    $erro = error_get_last();
    if ($erro) {
        error_log("Fatal error: " . print_r($erro, true));
        echo "<p style='color:purple'>🔥 Fatal Error capturado no shutdown: " . $erro['message'] . "</p>";
    }
});

// ===============================
// TESTES DE ERROS
// ===============================
echo "<h2>Teste de erros em PHP</h2>";

try {
    // 1️⃣ Conexão com banco inválida
    echo "<h3>1. Conexão com MySQL inválida</h3>";
    $con = mysqli_connect("localhost", "usuario_invalido", "senha_errada", "banco_fake");
    if (!$con) {
        throw new Exception("Falha na conexão: " . mysqli_connect_error());
    }

} catch (Exception $e) {
    echo "<p style='color:orange'>Erro de conexão capturado: " . $e->getMessage() . "</p>";
}

try {
    // 2️⃣ Query em conexão inválida
    echo "<h3>2. Query inválida</h3>";
    $sql = "SELECT * FROM tabela_que_nao_existe";
    $res = mysqli_query($con, $sql); // vai dar erro pq a conexão falhou
    if (!$res) {
        throw new Exception("Erro na consulta: " . mysqli_error($con));
    }

} catch (Exception $e) {
    echo "<p style='color:orange'>Erro na query capturado: " . $e->getMessage() . "</p>";
}

// 3️⃣ Fatal Error proposital
echo "<h3>3. Fatal Error</h3>";
naoExisteFuncao();
