#!/bin/bash

LOGFILE="log.log"
TEST_DIR="logs"

# Limpa log anterior
> "$LOGFILE"

# Cores para terminal
GREEN="\e[32m"
RED="\e[31m"
YELLOW="\e[33m"
RESET="\e[0m"

echo -e "${YELLOW}==== Executando todos os .sh em $TEST_DIR ====${RESET}" | tee -a "$LOGFILE"

total=0
sucesso=0
falha=0

for script in "$TEST_DIR"/*.sh; do
  if [ -f "$script" ]; then
    ((total++))
    echo -e "\n>> Rodando $script" | tee -a "$LOGFILE"
    
    # Executa script e captura código de saída
    bash "$script" >> "$LOGFILE" 2>&1
    status=$?

    if [ $status -eq 0 ]; then
      echo -e "${GREEN}✔ $script executado com sucesso${RESET}" | tee -a "$LOGFILE"
      ((sucesso++))
    else
      echo -e "${RED}✖ $script falhou (código $status)${RESET}" | tee -a "$LOGFILE"
      ((falha++))
    fi
  fi
done

echo -e "\n${YELLOW}==== Resumo ====${RESET}" | tee -a "$LOGFILE"
echo "Total de scripts: $total" | tee -a "$LOGFILE"
echo -e "${GREEN}Executados com sucesso: $sucesso${RESET}" | tee -a "$LOGFILE"
echo -e "${RED}Falharam: $falha${RESET}" | tee -a "$LOGFILE"

echo -e "${YELLOW}==== Todos os testes foram executados ====${RESET}" | tee -a "$LOGFILE"
