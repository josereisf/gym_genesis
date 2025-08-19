<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Tratamento de Erros em PHP — Guia Visual</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    pre { white-space: pre-wrap; }
    code { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, "Roboto Mono", "Courier New", monospace; }
    .glass { background: rgba(255,255,255,0.06); backdrop-filter: blur(6px); }
  </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-sky-900 text-slate-100 antialiased leading-relaxed">
  <div class="min-h-screen container mx-auto p-6 lg:p-12">
    <!-- HERO -->
    <header class="max-w-5xl mx-auto text-center mb-10">
      <div class="inline-flex items-center gap-4 mb-6">
        <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 flex items-center justify-center shadow-lg">💥</div>
        <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight">Tratamento de Erros em <span class="text-indigo-400">PHP</span></h1>
      </div>
      <p class="text-slate-300 max-w-3xl mx-auto">Página prática e visual que explica tipos de erro, configuração, captura com handlers, conversão em exceções, logs e como redirecionar o usuário com segurança — tudo pronto para copiar e usar.</p>
      <div class="mt-6 flex justify-center gap-3">
        <a href="#exemplos" class="px-5 py-3 bg-indigo-500 hover:bg-indigo-600 rounded-md shadow-md">Ver exemplos</a>
        <a href="#boas-praticas" class="px-5 py-3 border border-indigo-400/30 rounded-md">Boas práticas</a>
      </div>
    </header>

    <!-- GRID -->
    <main class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Left column: Menu -->
      <nav class="glass p-6 rounded-2xl border border-white/6 shadow-md lg:sticky lg:top-6">
        <h3 class="text-xl font-semibold mb-4">Índice Rápido</h3>
        <ul class="space-y-3 text-slate-200">
          <li><a href="#tipos" class="hover:text-indigo-300">• Tipos de Erro</a></li>
          <li><a href="#config" class="hover:text-indigo-300">• Configuração de Erros</a></li>
          <li><a href="#handlers" class="hover:text-indigo-300">• Handlers Globais</a></li>
          <li><a href="#converter" class="hover:text-indigo-300">• Converter Erros em Exceções</a></li>
          <li><a href="#exemplos" class="hover:text-indigo-300">• Exemplos Práticos</a></li>
          <li><a href="#redirecionar" class="hover:text-indigo-300">• Redirecionar Usuário</a></li>
          <li><a href="#boas-praticas" class="hover:text-indigo-300">• Boas Práticas & Logs</a></li>
        </ul>
      </nav>

      <!-- Middle column: Content -->
      <section class="lg:col-span-2 space-y-8">
        <!-- Tipos de Erro -->
        <article id="tipos" class="glass p-8 rounded-2xl border border-white/6 shadow-md">
          <h2 class="text-2xl font-bold mb-3">Tipos principais de erro em PHP</h2>
          <div class="grid sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-md bg-gradient-to-r from-slate-900 to-slate-800 border border-white/3">
              <h4 class="font-semibold">Parse Error <span class="text-sm text-slate-400">(E_PARSE)</span></h4>
              <p class="text-slate-300 mt-2">Erro de sintaxe — o interpretador não consegue compilar o script. O código não chega a executar.</p>
            </div>
            <div class="p-4 rounded-md bg-gradient-to-r from-slate-900 to-slate-800 border border-white/3">
              <h4 class="font-semibold">Fatal Error <span class="text-sm text-slate-400">(E_ERROR)</span></h4>
              <p class="text-slate-300 mt-2">Erros graves que interrompem o script (ex.: chamar função inexistente).</p>
            </div>
            <div class="p-4 rounded-md bg-gradient-to-r from-slate-900 to-slate-800 border border-white/3">
              <h4 class="font-semibold">Warning <span class="text-sm text-slate-400">(E_WARNING)</span></h4>
              <p class="text-slate-300 mt-2">Avisos que não derrubam o script (ex.: include de arquivo ausente).</p>
            </div>
            <div class="p-4 rounded-md bg-gradient-to-r from-slate-900 to-slate-800 border border-white/3">
              <h4 class="font-semibold">Notice / Deprecated</h4>
              <p class="text-slate-300 mt-2">Informações ou avisos de código obsoleto — ajudam a manter compatibilidade.</p>
            </div>
          </div>
        </article>

        <!-- Configuração -->
        <article id="config" class="glass p-8 rounded-2xl border border-white/6 shadow-md">
          <h2 class="text-2xl font-bold mb-3">Como configurar exibição e logs</h2>
          <p class="text-slate-300 mb-4">A configuração muda entre <strong>desenvolvimento</strong> e <strong>produção</strong>. Em produção, nunca mostre stack traces ao usuário — apenas registre nos logs.</p>
          <pre class="bg-slate-900 p-4 rounded-md text-sm"><code>&lt;?php
// Mostrar todos os erros (DEV)
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/erros.log');

// Em PRODUÇÃO
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);
// ini_set('error_log', '/var/log/app_errors.log');
?&gt;</code></pre>
        </article>

        <!-- Handlers -->
        <article id="handlers" class="glass p-8 rounded-2xl border border-white/6 shadow-md">
          <h2 class="text-2xl font-bold mb-3">Handlers globais (capturar erros e exceções)</h2>
          <p class="text-slate-300">Use handlers para centralizar tratamento: <code>set_error_handler</code>, <code>set_exception_handler</code> e <code>register_shutdown_function</code>.</p>
          <pre class="bg-slate-900 p-4 rounded-md text-sm"><code>&lt;?php
set_error_handler(function($errno, $errstr, $errfile, $errline) {
  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

set_exception_handler(function($e) {
  // log e mostrar mensagem amigável
  error_log($e->getMessage());
  http_response_code(500);
  echo "Ops... algo deu errado. Tente novamente mais tarde.";
});

register_shutdown_function(function() {
  $err = error_get_last();
  if ($err) {
    error_log(print_r($err, true));
    // opcional: renderizar uma página amigável
  }
});
?&gt;</code></pre>
        </article>

        <!-- Converter Erros -->
        <article id="converter" class="glass p-8 rounded-2xl border border-white/6 shadow-md">
          <h2 class="text-2xl font-bold mb-3">Converter erros em exceções</h2>
          <p class="text-slate-300 mb-3">Transformar warnings/notices em exceções facilita o fluxo de <code>try/catch</code> e mantém o tratamento consistente.</p>
          <pre class="bg-slate-900 p-4 rounded-md text-sm"><code>&lt;?php
set_error_handler(function($errno, $errstr, $errfile, $errline) {
  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
  include 'arquivo_inexistente.php'; // agora vira ErrorException
} catch (ErrorException $e) {
  // tratar como exceção
}
?&gt;</code></pre>
        </article>

        <!-- Exemplos -->
        <article id="exemplos" class="glass p-8 rounded-2xl border border-white/6 shadow-md">
          <h2 class="text-2xl font-bold mb-3">Exemplos práticos (arquivo, banco, redirecionamento)</h2>
          <p class="text-slate-300">Cópie os trechos e cole no seu projeto. Os exemplos abaixo usam <strong>mysqli</strong> (conforme pedido) e manipulação de arquivo.</p>

          <h3 class="font-semibold mt-4">Exemplo: Arquivo (file_get_contents)</h3>
          <pre class="bg-slate-900 p-4 rounded-md text-sm"><code>// transformar warnings em exceções
set_error_handler(function($errno, $errstr, $errfile, $errline) {
  throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
  $c = file_get_contents('arquivo_inexistente.txt');
} catch (ErrorException $e) {
  error_log($e->getMessage());
  // redirecionar o usuário para uma página amigável
  header('Location: /erro/arquivo-indisponivel.php');
  exit;
}
</code></pre>

          <h3 class="font-semibold mt-4">Exemplo: MySQLi (conexão e query)</h3>
          <pre class="bg-slate-900 p-4 rounded-md text-sm"><code>$con = mysqli_connect('localhost', 'user', 'pass', 'db');
if (!$con) {
  error_log('DB error: ' . mysqli_connect_error());
  header('Location: /erro/db-indisponivel.php');
  exit;
}

$result = mysqli_query($con, 'SELECT * FROM tabela');
if (!$result) {
  error_log('Query error: ' . mysqli_error($con));
  header('Location: /erro/db-query-falhou.php');
  exit;
}
</code></pre>

          <h3 class="font-semibold mt-4">Exemplo: Exceção centralizada com resposta amigável</h3>
          <pre class="bg-slate-900 p-4 rounded-md text-sm"><code>set_exception_handler(function($e) {
  error_log($e->getMessage());
  // mostrar página simples e amigável
  http_response_code(500);
  include __DIR__ . '/templates/500_amigavel.php';
  exit;
});
</code></pre>
        </article>

        <!-- Redirecionar usuário -->
        <article id="redirecionar" class="glass p-8 rounded-2xl border border-white/6 shadow-md">
          <h2 class="text-2xl font-bold mb-3">Redirecionamento seguro para o usuário</h2>
          <p class="text-slate-300 mb-3">Quando ocorrer um erro, evite mostrar detalhes técnicos. Use páginas amigáveis e (quando apropriado) um código HTTP que represente o problema.</p>
          <ul class="list-disc pl-5 text-slate-300 mb-3">
            <li>Use <code>http_response_code(500)</code> para erros internos.</li>
            <li>Redirecione com <code>header('Location: /erro/xxx.php')</code> e <code>exit;</code>.</li>
            <li>Não passe stack trace na URL ou em mensagens públicas.</li>
            <li>Opcional: mostre um código de erro curto (ex: <code>ERR-1234</code>) que apareça nos logs para correlação.</li>
          </ul>

          <div class="bg-slate-800 p-4 rounded-md border border-white/6">
            <p class="text-slate-300"><strong>Exemplo de página amigável (templates/500_amigavel.php)</strong></p>
            <pre class="bg-slate-900 p-4 rounded-md text-sm mt-3"><code>&lt;?php http_response_code(500); ?&gt;
&lt;!doctype html&gt;
&lt;html&gt;&lt;body style="font-family:system-ui,sans-serif"&gt;
  &lt;h1&gt;Ops! Algo deu errado.&lt;/h1&gt;
  &lt;p&gt;Nosso time já foi notificado. Se quiser, recarregue a página ou volte mais tarde.&lt;/p&gt;
  &lt;p&gt;Código de referência: &lt;strong&gt;ERR-<?= substr(md5(time()),0,6) ?>&lt;/strong&gt;&lt;/p&gt;
&lt;/body&gt;&lt;/html&gt;
</code></pre>
          </div>

        </article>

        <!-- Boas práticas -->
        <article id="boas-praticas" class="glass p-8 rounded-2xl border border-white/6 shadow-md">
          <h2 class="text-2xl font-bold mb-3">Boas práticas</h2>
          <ol class="list-decimal pl-5 text-slate-300 space-y-2">
            <li>Configurar logs rotativos (logrotate) para evitar arquivos enormes.</li>
            <li>Em produção: <code>display_errors=0</code>, <code>log_errors=1</code>.</li>
            <li>Não expor detalhes técnicos ao usuário.</li>
            <li>Use códigos de referência para correlacionar usuário & logs.</li>
            <li>Monitore erros com Sentry, Bugsnag ou outras ferramentas (opcional).</li>
            <li>Teste handlers com casos reais: DB off, disco cheio, permissões.</li>
          </ol>
        </article>

      </section>

    </main>

    <footer class="max-w-5xl mx-auto mt-12 text-center text-slate-400">
      <p>Feito para você</p>

    </footer>
  </div>

  <script>
    // Copiar código ao clicar (melhora UX)
    document.addEventListener('click', function(e){
      if(e.target.matches('[data-copy]')){
        const target = document.querySelector(e.target.getAttribute('data-copy'));
        if(target){
          navigator.clipboard.writeText(target.innerText).then(()=>{
            e.target.innerText = 'Copiado!';
            setTimeout(()=> e.target.innerText = 'Copiar', 1200);
          });
        }
      }
    });
  </script>
</body>
</html>
