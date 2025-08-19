<?php
// ===============================
// CONFIGURAÇÃO DE ERROS
// ===============================
error_reporting(E_ALL);
ini_set('display_errors', 1); // Em DEV: mostrar na tela
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
echo "<h2>DEMO DE ERROS EM PHP</h2>";

/* -------------------------
   1. Warning (arquivo não existe)
------------------------- */
try {
    echo "<h3>1. Warning - Arquivo</h3>";
    $conteudo = file_get_contents("arquivo_inexistente.txt");
} catch (Exception $e) {
    echo "<p style='color:orange'>Warning capturado: " . $e->getMessage() . "</p>";
}

/* -------------------------
   2. Arquivo sem permissão
------------------------- */
try {
    echo "<h3>2. Arquivo sem permissão</h3>";
    // Tentando abrir um diretório como se fosse arquivo
    $fp = fopen(__DIR__, "r");
} catch (Exception $e) {
    echo "<p style='color:orange'>Erro de arquivo capturado: " . $e->getMessage() . "</p>";
}

/* -------------------------
   3. Banco de Dados inválido
------------------------- */
try {
    echo "<h3>3. Conexão com MySQL inválida</h3>";
    $con = mysqli_connect("localhost", "usuario_fake", "senha_errada", "banco_fake");
    if (!$con) {
        throw new Exception("Falha na conexão: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    echo "<p style='color:orange'>Erro de conexão capturado: " . $e->getMessage() . "</p>";
}

/* -------------------------
   4. Query inválida
------------------------- */
try {
    echo "<h3>4. Query inválida</h3>";
    if (isset($con) && $con) {
        $sql = "SELECT * FROM tabela_que_nao_existe";
        $res = mysqli_query($con, $sql);
        if (!$res) {
            throw new Exception("Erro na query: " . mysqli_error($con));
        }
    } else {
        throw new Exception("Sem conexão para executar query.");
    }
} catch (Exception $e) {
    echo "<p style='color:orange'>Erro na query capturado: " . $e->getMessage() . "</p>";
}

/* -------------------------
   5. Exceção manual
------------------------- */
try {
    echo "<h3>5. Exceção manual</h3>";
    throw new Exception("Lançando uma exceção proposital!");
} catch (Exception $e) {
    echo "<p style='color:orange'>Exceção capturada: " . $e->getMessage() . "</p>";
}

/* -------------------------
   6. Fatal Error
------------------------- */
echo "<h3>6. Fatal Error</h3>";
naoExisteFuncao(); // gera fatal error
