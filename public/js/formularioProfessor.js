usuario = $("usuario_id").val();
funcionario = $("idfuncionario").val();
perfil = $("idperfil").val();
nome = $("nome").val();
email = $("email").val();
senha = $("senha").val();
tipo = 2 // Tipo 2 para professor/funcionário;
data = $("data_contratacao").val();
salario = $("salario").val();
cargo = $("cargo_id").val();
modalidade = $("modalidade").val();
avaliacao = $("avaliacao_fisica").val();
descricao = $("descricao").val();
horario = $("horarios_disponiveis").val();
telefone = $("telefone").val();
foto = $("foto_perfil").val();
input = $("input[name='botao']").val();
experiencia = $("experiencia").val();


if (input == "Cadastrar") {

    $.ajax({
        url: 'http://localhost:83/public/api/index.php?entidade=usuario&acao=cadastrar', // Altere para o endpoint desejado
        type: 'POST', // Ou 'GET'
        data: {
            idusuario: idusuario,
            email: email,
            senha: senha,
            tipo: tipo,
        },
        success: function (response) {
            console.log('Sucesso:', response);
        },
        error: function (xhr, status, error) {
            console.error('Erro:', error);
        }
    });

    $.ajax({
        url: 'http://localhost:83/public/api/index.php?entidade=funcionario&acao=cadastrar', // Altere para o endpoint desejado
        type: 'POST', // Ou 'GET'
        data: {
            usuario_id: idusuario,
            idfuncionario: funcionario,
            idperfil: perfil,
            nome: nome,
            data_contratacao: data,
            salario: salario,
            cargo_id: cargo,
        },
        success: function (response) {
            console.log('Sucesso:', response);
        },
        error: function (xhr, status, error) {
            console.error('Erro:', error);
        }
    });

    $.ajax({
        url: 'http://localhost:83/public/api/index.php?entidade=perfil_professor&acao=cadastrar', // Altere para o endpoint desejado
        type: 'POST', // Ou 'GET'
        data: {
            usuario_id: idusuario,
            experiencia_anos: experiencia,
            foto_perfil: foto,
            modalidade: modalidade,
            avaliacao_media: avaliacao,
            descricao: descricao,
            horarios_disponiveis: horario,
            telefone: telefone
        },
        success: function (response) {
            console.log('Sucesso:', response);
        },
        error: function (xhr, status, error) {
            console.error('Erro:', error);
        }
    });
}