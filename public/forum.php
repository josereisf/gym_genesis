<?
require_once "../php/verificarLogado.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fórum Premium - Gym Gênesis</title>
  <style>
    :root {
      --primary: #00ff88;
      --background: #0d0d0d;
      --card-bg: rgba(255, 255, 255, 0.05);
      --blur: blur(12px);
      --glass-border: rgba(255, 255, 255, 0.1);
      --text: #f5f5f5;
      --text-muted: #999;
      --radius: 16px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background: linear-gradient(135deg, #0a0a0a, #1e1e1e);
      font-family: 'Segoe UI', 'Roboto', sans-serif;
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: rgba(0, 0, 0, 0.6);
      padding: 30px;
      text-align: center;
      border-bottom: 1px solid var(--glass-border);
      backdrop-filter: var(--blur);
    }

    header h1 {
      font-size: 2.5rem;
      color: var(--primary);
      font-weight: 800;
      letter-spacing: 1px;
    }

    .container {
      display: flex;
      padding: 40px;
      gap: 30px;
      flex: 1;
    }

    .sidebar {
      width: 260px;
      background: var(--card-bg);
      backdrop-filter: var(--blur);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius);
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .topic-button {
      background: transparent;
      border: 1px solid var(--glass-border);
      padding: 15px;
      color: var(--text);
      font-weight: 500;
      border-radius: 10px;
      transition: all 0.3s;
      cursor: pointer;
    }

    .topic-button:hover {
      background-color: var(--primary);
      color: #000;
    }

    .main {
      flex: 1;
      background: var(--card-bg);
      backdrop-filter: var(--blur);
      border: 1px solid var(--glass-border);
      border-radius: var(--radius);
      padding: 30px;
      box-shadow: 0 0 20px rgba(0, 255, 136, 0.05);
    }

    .main h2 {
      font-size: 1.8rem;
      color: var(--primary);
      margin-bottom: 25px;
    }

    .comment {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid var(--glass-border);
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 20px;
    }

    .user {
      font-size: 0.85rem;
      color: var(--text-muted);
      margin-bottom: 8px;
    }

    .actions {
      margin-top: 15px;
    }

    .actions button {
      background: var(--primary);
      color: #000;
      border: none;
      padding: 8px 16px;
      margin-right: 10px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .actions button:hover {
      background-color: #00cc66;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        padding: 20px;
      }

      .sidebar {
        width: 100%;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px;
      }

      .topic-button {
        flex: 1 1 48%;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>🏋️‍♂️ GYM GÊNESIS</h1>
  </header>

  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <button class="topic-button">🏋️ Treinos</button>
      <button class="topic-button">🥗 Nutrição</button>
      <button class="topic-button">💊 Suplementos</button>
      <button class="topic-button">🧠 Mindset</button>
    </div>

    <!-- Main forum content -->
    <div class="main">
      <h2>Dicas Avançadas de Hipertrofia</h2>

      <div class="comment">
        <div class="user">@rafa_gym · há 3h</div>
        Drop sets no leg press + agachamento livre = 🔥 resultado insano em 2 semanas!
        <div class="actions">
          <button>Curtir</button>
          <button>Responder</button>
        </div>
      </div>

      <div class="comment">
        <div class="user">@luana_fit · há 1h</div>
        Uso progressivo de carga e descanso curto são a chave pra mim!
        <div class="actions">
          <button>Curtir</button>
          <button>Responder</button>
        </div>
      </div>

      <div class="comment">
        <div class="user">@bruno.treino · agora</div>
        Alguém tem planilha de treino ABCDE pra dividir por grupo muscular?
        <div class="actions">
          <button>Curtir</button>
          <button>Responder</button>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
