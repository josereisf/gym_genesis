        // Abrir modal pegando os dados direto da linha da tabela
        function openModal(botao) {
            // Acha a linha <tr> mais próxima do botão clicado
            const row = botao.closest("tr");
            const cells = row.querySelectorAll("td");

            // Pega os valores das colunas (ajuste os índices conforme sua tabela)
            const dados = {
                foto: row.querySelector("img").src,
                nome: cells[2].innerText,
                cargo: cells[3].innerText,
                modalidade: cells[4].innerText,
                avaliacao: cells[5].innerText,
                descricao: cells[6].innerText,
                telefone: cells[7].innerText,
                email: cells[8].innerText,
                dataAula: cells[9].innerText,
                diaSemana: cells[10].innerText,
                horarios: cells[11].innerText,
                horaInicio: cells[12].innerText,
                horaFim: cells[13].innerText,
                salario: cells[14] ? cells[14].innerText : "",
                funcionarioId: cells[15] ? cells[15].innerText : "",
                aulaId: cells[16] ? cells[16].innerText : "",
                treinoId: cells[17] ? cells[17].innerText : "",
                dataAtualizacao: cells[18] ? cells[18].innerText : "",
                dataContratacao: cells[19] ? cells[19].innerText : ""
            };

            // Monta o conteúdo do modal
            const modalContent = `
            <div class="flex items-center gap-4 border-b border-[#3b82f6] pb-4 mb-4">
                <img src="${dados.foto}" alt="Foto"
                    class="w-24 h-24 rounded-full shadow-lg border-2 border-[#a855f7]">
                <div>
                    <h2 class="text-2xl font-bold text-[#22d3ee]">${dados.nome}</h2>
                    <p class="text-gray-300">${dados.cargo}</p>
                    <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold text-dark bg-[#22d3ee] rounded-full">
                        ${dados.modalidade}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-200">
                <p><span class="font-semibold text-[#22d3ee]">Avaliação:</span> ${dados.avaliacao}</p>
                <p><span class="font-semibold text-[#22d3ee]">Descrição:</span> ${dados.descricao}</p>
                <p><span class="font-semibold text-[#22d3ee]">Telefone:</span> ${dados.telefone}</p>
                <p><span class="font-semibold text-[#22d3ee]">Email:</span> ${dados.email}</p>
                <p><span class="font-semibold text-[#22d3ee]">Data da Aula:</span> ${dados.dataAula}</p>
                <p><span class="font-semibold text-[#22d3ee]">Dia da Semana:</span> ${dados.diaSemana}</p>
                <p><span class="font-semibold text-[#22d3ee]">Horários:</span> ${dados.horarios}</p>
                <p><span class="font-semibold text-[#22d3ee]">Hora Início:</span> ${dados.horaInicio}</p>
                <p><span class="font-semibold text-[#22d3ee]">Hora Fim:</span> ${dados.horaFim}</p>
                ${dados.salario ? `<p><span class="font-semibold text-[#22d3ee]">Salário:</span> ${dados.salario}</p>` : ""}
                ${dados.funcionarioId ? `<p><span class="font-semibold text-[#22d3ee]">ID Funcionário:</span> ${dados.funcionarioId}</p>` : ""}
                ${dados.aulaId ? `<p><span class="font-semibold text-[#22d3ee]">ID Aula:</span> ${dados.aulaId}</p>` : ""}
                ${dados.treinoId ? `<p><span class="font-semibold text-[#22d3ee]">ID Treino:</span> ${dados.treinoId}</p>` : ""}
                ${dados.dataAtualizacao ? `<p><span class="font-semibold text-[#22d3ee]">Data Atualização:</span> ${dados.dataAtualizacao}</p>` : ""}
                ${dados.dataContratacao ? `<p><span class="font-semibold text-[#22d3ee]">Data Contratação:</span> ${dados.dataContratacao}</p>` : ""}
            </div>
        `;

            document.getElementById("modalContent").innerHTML = modalContent;
            document.getElementById("modal").classList.remove("hidden");
            document.getElementById("modal").classList.add("flex");
        }

        // Fechar modal
        function closeModal() {
            document.getElementById("modal").classList.remove("flex");
            document.getElementById("modal").classList.add("hidden");
        }

        document.addEventListener("click", async (e) => {
            const botao = e.target.closest("button[data-idprofessor]");
            if (!botao) return;

            const idprofessor = botao.dataset.idprofessor;
            const idaluno = <?= $usuario ?>;

            console.log("Aula selecionada:", idprofessor, "Aluno:", idaluno);

            try {
                const resposta = await aula_usuario(idprofessor, idaluno);
                console.log("Resposta tratada:", resposta);

                if (resposta.sucesso) {
                    // Se deu certo, redireciona
                    window.location.href = "http://localhost:83/public/dashboard_usuario.php";
                } else {
                    // Se não deu certo, mostra mensagem
                    alert(resposta.mensagem || "Não foi possível agendar a aula.");
                }
            } catch (error) {
                console.error("Erro geral ao agendar aula:", error);
                alert("Erro de comunicação com o servidor.");
            }
        });

        async function aula_usuario(idprofessor, idaluno) {
            try {
                const response = await fetch(
                    'http://localhost:83/public/exercicio.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            idaula: idprofessor,
                            idaluno
                        }),
                    }
                );

                if (!response.ok) throw new Error(`Erro na requisição: ${response.status}`);

                const textoBruto = await response.text();
                console.log('Resposta bruta da API:', textoBruto);

                try {
                    const json = JSON.parse(textoBruto);
                    return json;
                } catch (erroDeParse) {
                    console.error('Erro ao fazer JSON.parse. A resposta não é um JSON válido.');
                    throw erroDeParse;
                }
            } catch (error) {
                console.error('Erro ao cadastrar Aula para Usuario:', error);
                throw error;
            }
        }
