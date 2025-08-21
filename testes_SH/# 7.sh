# 7. cupom_desconto
print_sep
echo "========== CUPOM_DESCONTO =========="
API_URL="$BASE_URL?entidade=cupom_desconto"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"codigo":"PROMO10","desconto":10}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"codigo":"PROMO20","desconto":20}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq

# 8. dieta_alimentar
print_sep
echo "========== DIETA_ALIMENTAR =========="
API_URL="$BASE_URL?entidade=dieta_alimentar"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"usuario_id":1,"descricao":"Dieta low carb"}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"usuario_id":1,"descricao":"Dieta cetogênica"}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq

# 9. dieta
print_sep
echo "========== DIETA =========="
API_URL="$BASE_URL?entidade=dieta"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"nome":"Dieta do Arroz"}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"nome":"Dieta do Feijão"}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq

# 10. endereco
print_sep
echo "========== ENDERECO =========="
API_URL="$BASE_URL?entidade=endereco"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"usuario_id":1,"rua":"Rua A","numero":"123"}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"usuario_id":1,"rua":"Rua B","numero":"456"}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq

# 11. exercicio
print_sep
echo "========== EXERCICIO =========="
API_URL="$BASE_URL?entidade=exercicio"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"nome":"Supino","grupo_muscular":"Peito"}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"nome":"Agachamento","grupo_muscular":"Pernas"}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq

# 12. forum
print_sep
echo "========== FORUM =========="
API_URL="$BASE_URL?entidade=forum"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"titulo":"Dúvidas sobre treino"}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"titulo":"Dúvidas sobre dieta"}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq

# 13. funcionario
print_sep
echo "========== FUNCIONARIO =========="
API_URL="$BASE_URL?entidade=funcionario"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"nome":"João","cargo_id":1}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"nome":"Maria","cargo_id":1}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq

# Repita o padrão acima para as demais entidades:
# historico_peso, historico_treino, item_pedido, meta, pagamento_detalhe_assinatura, pagamento_detalhe,
# pagamento, pedido, plano, produto, professor_aluno, recuperacao_senha, refeicao, treino_exercicio,
# treino, usuario

# Exemplo para usuario:
print_sep
echo "========== USUARIO =========="
API_URL="$BASE_URL?entidade=usuario"
echo "== CADASTRAR =="
curl -s -X POST "$API_URL&acao=cadastrar" -H "Content-Type: application/json" -d '{"id":1,"nome":"Carlos","email":"carlos@email.com"}' | jq
echo "== LISTAR =="
curl -s "$API_URL&acao=listar" | jq
echo "== EDITAR =="
curl -s -X POST "$API_URL&acao=editar" -H "Content-Type: application/json" -d '{"id":1,"nome":"Carlos Silva","email":"carlos@email.com"}' | jq
echo "== LISTAR NOVAMENTE =="
curl -s "$API_URL&acao=listar" | jq
echo "== DELETAR =="
curl -s -X POST "$API_URL&acao=deletar" -H "Content-Type: application/json" -d '{"id":1}' | jq
echo "== LISTAR FINAL =="
curl -s "$API_URL&acao=listar" | jq
