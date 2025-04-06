const conexao = require('./conexao');

async function salvarUsuario(
  nome,
  senha,
  email,
  cpf,
  data_nasc,
  telefone,
  num_matricula,
  tipo
) {
    const sql = 'INSERT INTO usuario ( nome, senha, email, cpf, data_de_nascimento, telefone, numero_matricula, tipo_usuario) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)';
    const [funcionou] = await conexao.execute(sql, [nome, senha, email, cpf, data_nasc, telefone, num_matricula, tipo]);
    return funcionou;
};

module.exports = {salvarUsuario};