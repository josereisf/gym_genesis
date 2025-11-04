<?php
switch($tabela){
    case 'alimento':
        $id_tabela = 'idalimento';
        break;
    case 'plano':
        $id_tabela = 'idplano';
        break;
    case 'usuario':
        $id_tabela = 'idusuario';
        break;
    case 'assinatura':
        $id_tabela = 'idassinatura';
        break;
    case 'cargo':
        $id_tabela = 'idcargo';
        break;
    case 'funcionario':
        $id_tabela = 'idfuncionario';
        break;
    case 'treino':
        $id_tabela = 'idtreino';
        break;
    case 'aula_agendada':
        $id_tabela = 'idaula';
        break;
    case 'aula_usuario':
        $id_tabela = 'idaula';
        break;
    case 'avaliacao_fisica':
        $id_tabela = 'idavaliacao';
        break;
    case 'categoria_produto':
        $id_tabela = 'idcategoria';
        break;
    case 'cupom_desconto':
        $id_tabela = 'idcupom';
        break;
    case 'dicas_nutricionais':
        $id_tabela = 'iddicas_nutricionais';
        break;
    case 'dieta':
        $id_tabela = 'iddieta';
        break;
    case 'refeicao':
        $id_tabela = 'idrefeicao';
        break;
    case 'dieta_alimentar':
        $id_tabela = 'iddieta_alimentar';
        break;
    case 'endereco':
        $id_tabela = 'idendereco';
        break;
    case 'exercicio':
        $id_tabela = 'idexercicio';
        break;
    case 'forum':
        $id_tabela = 'idforum';
        break;
    case 'historico_peso':
        $id_tabela = 'idhistorico_peso';
        break;
    case 'historico_treino':
        $id_tabela = 'idhistorico_treino';
        break;
    case 'pagamento':
        $id_tabela = 'idpagamento';
        break;
    case 'pedido':
        $id_tabela = 'idpedido';
        break;
    case 'produto':
        $id_tabela = 'idproduto';
        break;
    case 'item_pedido':
        // PK é composta (pedido_id, produto_id) — ignorado conforme solicitado
        $id_tabela = '';
        break;
    case 'meta_usuario':
        $id_tabela = 'idmeta';
        break;
    case 'pagamento_detalhe':
        $id_tabela = 'idpagamento_detalhe';
        break;
    case 'perfil_professor':
        $id_tabela = 'idperfil_professor';
        break;
    case 'perfil_usuario':
        $id_tabela = 'idperfil_usuario';
        break;
    case 'recuperacao_senha':
        $id_tabela = 'idrecuperacao_senha';
        break;
    default:
        $id_tabela = '';
        break;
}
?>