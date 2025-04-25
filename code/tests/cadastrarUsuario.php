<?php
use PHPUnit\Framework\TestCase;

require_once '/../funcao.php'; // ajuste o caminho conforme necessário

class UsuarioTest extends TestCase
{
    public function testCadastrarUsuario()
    {
        $nome = 'João Teste';
        $senha = 'senha123';
        $email = 'joao'.rand(1000,9999).'@teste.com'; // evitar conflito
        $cpf = strval(rand(10000000000, 99999999999));
        $data_nascimento = '1995-05-20';
        $telefone = '11999998888';
        $foto_perfil = 'foto.jpg';
        $numero_matricula = rand(1000, 9999);
        $tipo_usuario = 1;

        $resultado = cadastrarUsuario(
            conectar(),
            $nome,
            $senha,
            $email,
            $cpf,
            $data_nascimento,
            $telefone,
            $foto_perfil,
            $numero_matricula,
            $tipo_usuario
        );

        // Espera-se que retorne um ID numérico
        $this->assertIsInt($resultado);
        $this->assertGreaterThan(0, $resultado);
    }