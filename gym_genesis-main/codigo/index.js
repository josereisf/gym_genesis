const http = require("http");
const fs = require("fs");
const url = require("url");
const path = require("path");
const { salvarUsuario, listarUsuarios } = require("./funcoes");

const server = http.createServer(async (req, res) => {
  const parsedUrl = url.parse(req.url, true);
  const pathname = parsedUrl.pathname;

  // Página inicial (index.html)
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

  // Rota para listar usuários em JSON
  } else if (pathname === "/usuarios" && req.method === "GET") {
    try {
      const usuarios = await listarUsuarios();
      res.writeHead(200, { "Content-Type": "application/json" });
      res.end(JSON.stringify(usuarios));
    } catch (err) {
      res.writeHead(500, { "Content-Type": "application/json" });
      res.end(JSON.stringify({ erro: "Erro ao buscar usuários." }));
    }

  // Rota de teste para salvar um usuário fixo
  } else if (pathname === "/salvar" && req.method === "GET") {
    const nome = "João Silva";
    const senha = "senhaSegura123";
    const email = "joao@email.com";
    const cpf = "12345678905";
    const data_nasc = "1990-05-13";
    const telefone = "11999";
    const foto_perfil = null; // valor padrão se não for passado
    const num_matricula = "12345";
    const tipo = 1;

    try {
      const result = await salvarUsuario(
        nome, senha, email, cpf, data_nasc, telefone,foto_perfil, num_matricula, tipo
      );
      res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
      res.end("Usuário salvo com sucesso!");
    } catch (error) {
      res.writeHead(500, { "Content-Type": "text/plain; charset=utf-8" });
      res.end("Erro ao salvar o usuário: " + error.message);
    }

  // Qualquer outro caminho retorna erro 404
  } else {
    res.writeHead(404, { "Content-Type": "text/plain" });
    res.end("Página não encontrada");
  }
});

// Inicializa o servidor
server.listen(3000, () => {
  console.log("Servidor rodando em http://localhost:3000");
});
