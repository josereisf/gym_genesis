const mysql = require('mysql2/promise');

const conexao = mysql.createPool({
    host: 'db',
    user: 'root',
    password:'123',
    database:'gym_genesis',
    port: 3306
});

module.exports = conexao;