const salvarUsuario = require('./salvarUsuario');

const nome = "Maria Oliveira";
const senha = "NovaSenha456";
const email = "maria.oliveira@email.com";
const cpf = "98765432100";
const data_nasc = "1988-09-25";
const telefone = "21988888888";
const num_matricula = "67890";
const tipo = 2;


salvarUsuario(nome, senha, email, cpf,data_nasc, telefone, num_matricula, tipo);

res.writeHead(200, { 'Content-Type': 'text/plain; charset=utf-8' });
res.end(funcionou);