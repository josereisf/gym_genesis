const salvarUsuario = require('./salvarUsuario');

const nome = "João Silva";
const senha = "senhaSegura123";
const email = "joao@email.com";
const cpf = "12345678900";
const data_nasc = "1990-05-12";
const telefone = "11999999999";
const num_matricula = "12345";
const tipo = 1;

salvarUsuario(nome, senha, email, cpf,data_nasc, telefone, num_matricula, tipo);

res.writeHead(200, { 'Content-Type': 'text/plain; charset=utf-8' });
res.end(funcionou);