const conexao = require('./conexao');
const bcrypt = require('bcrypt');

async function salvarUsuario(
  nome,
  senha,
  email,
  cpf,
  data_nasc,
  telefone = null,
  foto_perfil = null, // valor padrão se não for passado
  num_matricula,
  tipo
) {
  saltQuant = 3;
  bcrypt.hash(senha, saltQuant, function (err, senhahash){
    if (err) {
      console.error(err);
      return;
    };
    return senhahash;
  });
  const sql = `
    INSERT INTO usuario (
      nome,
      senha,
      email,
      cpf,
      data_de_nascimento,
      telefone,
      foto_de_perfil,
      numero_matricula,
      tipo_usuario
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
  `;

  const [resultado] = await conexao.execute(sql, [
    nome,
    senhahash,
    email,
    cpf,
    data_nasc,
    telefone,
    foto_perfil,
    num_matricula,
    tipo
  ]);

  return resultado;
}


async function listarUsuarios() {
  try {
    const [rows] = await conexao.query(`
      SELECT 
        idusuario,
        nome,
        email,
        cpf,
        data_de_nascimento,
        telefone,
        numero_matricula,
        tipo_usuario
      FROM usuario
    `);
    return rows;
  } catch (error) {
    console.error("Erro ao listar usuários:", error);
    return []; // Retorna lista vazia em caso de erro
  }
}


module.exports = {
  salvarUsuario,
  listarUsuarios,
};