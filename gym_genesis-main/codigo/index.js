const http = require("http");
const fs = require("fs");
const url = require("url");
const path = require("path");
const { salvarUsuario, listarUsuarios } = require("./funcoes");

http.createServer(async function (req, res) {
  const parsedUrl = url.parse(req.url, true);
  const pathname = parsedUrl.pathname;

  if (pathname === "/") {
    const filePath = path.join(__dirname, "public", "index.html");
    console.log("Caminho do HTML:", filePath);

    fs.readFile(filePath, "utf8", (err, data) => {
      if (err) {
        res.writeHead(500, { "Content-Type": "text/plain" });
        res.end("Erro ao carregar a página.");
      } else {
        res.writeHead(200, { "Content-Type": "text/html; charset=utf-8" });
        res.end(data);
      }
    });

  } else if (pathname === "/usuarios") {
    try {
      const usuarios = await listarUsuarios();
      res.writeHead(200, { "Content-Type": "application/json" });
      res.end(JSON.stringify(usuarios));
    } catch (err) {
      res.writeHead(500, { "Content-Type": "text/plain" });
      res.end("Erro ao buscar usuários.");
    }

  } else if (pathname === "/salvar") {
    // Essa rota salva um usuário fixo só para teste
    const nome = "João Silva";
    const senha = "senhaSegura123";
    const email = "joao@email.com";
    const cpf = "12345678900";
    const data_nasc = "1990-05-12";
    const telefone = "11999";
    const num_matricula = "12345";
    const tipo = 1;

    try {
      const result = await salvarUsuario(
        nome, senha, email, cpf, data_nasc, telefone, num_matricula, tipo
      );
      res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
      res.end("Usuário salvo com sucesso: " + result);
    } catch (error) {
      res.writeHead(500, { "Content-Type": "text/plain; charset=utf-8" });
      res.end("Erro ao salvar o usuário: " + error.message);
    }

  } else {
    res.writeHead(404, { "Content-Type": "text/plain" });
    res.end("Página não encontrada");
  }
}).listen(3000);

console.log("Servidor rodando em http://localhost:3000");
