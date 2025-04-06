const http = require("http");
const fs = require("fs");
const url = require("url");
const {salvarUsuario} = require("./funcoes");

http
  .createServer(async function (req, res) {

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
      nome,
      senha,
      email,
      cpf,
      data_nasc,
      telefone,
      num_matricula,
      tipo
    );
    res.writeHead(200, { "Content-Type": "text/plain; charset=utf-8" });
    res.end("Salvar o usuário: " + result);
  } catch (error) {
    res.writeHead(500, { "Content-Type": "text/plain; charset=utf-8" });
    res.end("Erro ao salvar o usuário: " + error.message);
  }
  })
  .listen(3000);

console.log("testando");
