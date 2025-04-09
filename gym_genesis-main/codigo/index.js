const http = require("http");
const fs = require("fs");
const url = require("url");
const path = require("path");
const conexao = require("./conexao");
const { salvarUsuario, listarUsuarios} = require("./funcoes");


const server = http.createServer(async (req, res) => {
  const parsedUrl = url.parse(req.url, true);
  const pathname = parsedUrl.pathname;

  // Página inicial
  if (pathname === "/" && req.method === "GET") {
    const filePath = path.join(__dirname, "public", "index.html");

    fs.readFile(filePath, "utf8", (err, data) => {
      if (err) {
        res.writeHead(500, { "Content-Type": "text/plain" });
        res.end("Erro ao carregar a página.");
      } else {
        res.writeHead(200, { "Content-Type": "text/html; charset=utf-8" });
        res.end(data);
      }
    });

  // Listar usuários
  } else if (pathname === "/usuarios" && req.method === "GET") {
    try {
      const usuarios = await listarUsuarios();
      res.writeHead(200, { "Content-Type": "application/json" });
      res.end(JSON.stringify(usuarios));
    } catch (err) {
      res.writeHead(500, { "Content-Type": "application/json" });
      res.end(JSON.stringify({ erro: "Erro ao buscar usuários." }));
    }

  // Salvar usuário fixo
  } else if (pathname === "/salvar" && req.method === "GET") {
    const nome = "João Silva";
    const senha = "senhaSegura123";
    const email = "joao@email.com";
    const cpf = "12345678905";
    const data_nasc = "1990-05-13";
    const telefone = "11999";
    const foto_perfil = null;
    const num_matricula = "12345";
    const tipo = 1;

    try {
      const result = await salvarUsuario(
        nome, senha, email, cpf, data_nasc, telefone, foto_perfil, num_matricula, tipo
      );
      res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
      res.end("Usuário salvo com sucesso!");
    } catch (error) {
      res.writeHead(500, { "Content-Type": "text/plain; charset=utf-8" });
      res.end("Erro ao salvar o usuário: " + error.message);
    }

  // Rota dinâmica para exibir dados da tabela: /tabela?nome=usuario
} else if (pathname === "/tabela" && req.method === "GET") {
  const nomeTabela = parsedUrl.query.nome;
  console.log("Tabela solicitada:", nomeTabela);

  const tabelasValidas = [
    "alimento", "assinatura", "aula_agendada", "avaliacao_fisica", "avaliador", "cargo",
    "categoria_produto", "cupom_desconto", "dieta", "dieta_alimento", "endereco",
    "endereco_entrega", "exercicio", "forum", "funcionario", "historico_treino", "horario",
    "item_pedido", "meta_usuario", "pagamento", "pagamento_detalhe", "pedido", "plano",
    "produto", "refeicao", "resposta_forum", "treino", "treino_exercicio", "usuario"
  ];

  if (!tabelasValidas.includes(nomeTabela)) {
    res.writeHead(400, { "Content-Type": "application/json" });
    res.end(JSON.stringify({ erro: "Tabela inválida" }));
    return;
  }

  try {
    const [dados] = await conexao.query(`SELECT * FROM \`${nomeTabela}\` LIMIT 50`);
    res.writeHead(200, { "Content-Type": "application/json" });
    res.end(JSON.stringify(dados));
  } catch (erro) {
    console.error("Erro ao buscar dados:", erro);
    res.writeHead(500, { "Content-Type": "application/json" });
    res.end(JSON.stringify({ erro: "Erro ao buscar dados" }));
  }


  // Arquivos estáticos (ex: script.js, style.css)
  } else {
    const filePath = path.join(__dirname, "public", pathname);

    fs.readFile(filePath, (err, data) => {
      if (err) {
        res.writeHead(404, { "Content-Type": "text/plain" });
        res.end("Página não encontrada");
      } else {
        const ext = path.extname(filePath);
        const contentType = {
          ".js": "application/javascript",
          ".css": "text/css",
          ".html": "text/html"
        }[ext] || "text/plain";

        res.writeHead(200, { "Content-Type": contentType });
        res.end(data);
      }
    });
  }
});

server.listen(3000, () => {
  console.log("Servidor rodando em http://localhost:3000");
});
