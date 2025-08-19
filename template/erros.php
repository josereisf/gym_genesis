<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/erros.log');

// Handler de erros
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

// Handler de exceções não capturadas
set_exception_handler(function($e) {
    echo "Ops! Algo deu errado. Tente novamente mais tarde.";
    error_log("Exceção não tratada: " . $e->getMessage());
});

// Handler de fatal errors
register_shutdown_function(function() {
    $erro = error_get_last();
    if ($erro) {
        error_log("Fatal error: " . print_r($erro, true));
    }
});

// Teste
try {
    echo 10 / 0; // gera Warning -> capturado como exceção
} catch (Exception $e) {
    echo "Erro capturado: " . $e->getMessage();
}
