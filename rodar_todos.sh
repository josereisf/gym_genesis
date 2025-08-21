#!/bin/bash
LOGFILE="log.log"
TEST_DIR="testes_SH"

# limpa log anterior
> "$LOGFILE"

echo "==== Executando todos os .sh em $TEST_DIR ====" | tee -a "$LOGFILE"

for script in "$TEST_DIR"/*.sh; do
  if [ -f "$script" ]; then
    echo ">> Rodando $script" | tee -a "$LOGFILE"
    bash "$script" >> "$LOGFILE" 2>&1
    echo "" | tee -a "$LOGFILE"
  fi
done

echo "==== Todos os testes foram executados ====" | tee -a "$LOGFILE"
