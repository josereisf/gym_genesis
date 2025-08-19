<?php
// ===============================
// CONFIGURAÇÃO DE ERROS
// ===============================
error_reporting(E_ALL);
ini_set('display_errors', 1); // Em DEV: mostrar na tela
ini_set('log_errors', 1);     // Sempre logar
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
    // 1️⃣ Aviso (Warning): arquivo inexistente
    echo "<h3>1. Warning</h3>";
    include("nao_existe.php");

} catch (Exception $e) {
    echo "<p style='color:orange'>Warning capturado: " . $e->getMessage() . "</p>";
}

try {
    // 2️⃣ Divisão por zero
    echo "<h3>2. Divisão por Zero</h3>";
    $res = 10 / 10; // Isso gera um Warning, mas não uma Exceção
    echo $res;

} catch (Exception $e) {
    echo "<p style='color:orange'>Erro capturado: " . $e->getMessage() . "</p>";
}

try {
    // 3️⃣ Exceção manual
    echo "<h3>3. Exceção manual</h3>";
    throw new Exception("Erro lançado manualmente!");

} catch (Exception $e) {
    echo "<p style='color:orange'>Exceção capturada: " . $e->getMessage() . "</p>";
}

// 4️⃣ Fatal Error: chamar função inexistente
echo "<h3>4. Fatal Error</h3>";
naoExisteFuncao();
