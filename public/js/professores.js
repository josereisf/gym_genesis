document.addEventListener('load', () => {
  const cards = document.querySelectorAll('.professor-card')
  const modal = document.getElementById('modal')
  const btnSelecionar = document.getElementById('btnSelecionar')
  const containerHorarios = document.getElementById('modalHorarios')
  let selectedIdaula = null
  const usuarioId = document.getElementById('usuario').getAttribute('data-idaluno')

  function abrirModal(card) {
    document.getElementById('modalNome').textContent = card.dataset.nome
    document.getElementById('modalDescricao').textContent = card.dataset.descricao
    document.getElementById('modalExperiencia').textContent =
      'Experiência: ' + card.dataset.experiencia + ' anos'
    document.getElementById('modalModalidade').textContent =
      'Modalidade: ' + card.dataset.modalidade
    document.getElementById('modalAvaliacao').textContent = 'Avaliação: ' + card.dataset.avaliacao
    document.getElementById('modalTelefone').textContent = 'Telefone: ' + card.dataset.telefone
    document.getElementById('modalEmail').textContent = 'Email: ' + card.dataset.email
    document.getElementById('modalFoto').src = card.dataset.foto

    containerHorarios.innerHTML = ''
    selectedIdaula = null
    btnSelecionar.disabled = true

    fetch(
      `http://localhost:83/public/api/index.php?entidade=aula_agendada&acao=listar&idprofessor=${card.dataset.idprofessor}`
    )
      .then((res) => res.json())
      .then((response) => {
        if (!response.sucesso) return alert('Erro ao listar aulas: ' + response.mensagem)

        const dados = JSON.parse(response.dados) // converte JSON string em array
        dados.forEach((aula) => {
          const btn = document.createElement('button')
          btn.className =
            'horario-card bg-[#2a4662] hover:bg-[#3a5977] text-white py-2 px-4 rounded-lg transition'
          btn.dataset.idaula = aula.idaula

          const inicio = aula.hora_inicio.slice(0, 5)
          const fim = aula.hora_fim.slice(0, 5)
          btn.textContent = `${aula.dia_semana} (${aula.data_aula}) - ${inicio} às ${fim} | ${aula.treino_tipo}: ${aula.treino_desc}`
          containerHorarios.appendChild(btn)
        })
      })

    modal.classList.remove('hidden')
  }

  cards.forEach((card) => {
    card.addEventListener('click', () => abrirModal(card))
  })

  window.fecharModal = () => modal.classList.add('hidden')

  containerHorarios.addEventListener('click', (e) => {
    const btn = e.target.closest('.horario-card')
    if (!btn) return
    document.querySelectorAll('.horario-card').forEach((b) => b.classList.remove('bg-green-600'))
    btn.classList.add('bg-green-600')
    selectedIdaula = btn.dataset.idaula
    btnSelecionar.disabled = false
  })

  btnSelecionar.addEventListener('click', () => {
    if (!selectedIdaula) return
    fetch('http://localhost:83/public/api/index.php?entidade=aula_usuario&acao=cadastrar', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        idaula: selectedIdaula,
        usuario_id: usuarioId,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success || data.sucesso) {
          alert('Aula selecionada com sucesso!')
          modal.classList.add('hidden')
        } else {
          alert('Erro ao selecionar aula!')
        }
      })
  })
  const filtroModalidade = document.getElementById('filtroModalidade')
  const buscaNome = document.getElementById('buscaNome')

  function filtrarCards() {
    const modalidade = filtroModalidade.value.toLowerCase()
    const nome = buscaNome.value.toLowerCase()

    const cards = document.querySelectorAll('.professor-card') // Seleciona todos os cards

    cards.forEach((card) => {
      const matchModalidade = !modalidade || card.dataset.modalidade.toLowerCase() === modalidade
      const matchNome = card.dataset.nome.toLowerCase().includes(nome)

      if (matchModalidade && matchNome) {
        card.classList.remove('hidden') // Torna o card visível
      } else {
        card.classList.add('hidden') // Torna o card invisível
      }
    })
  }


  filtroModalidade.addEventListener('', filtrarCards);
  buscaNome.addEventListener('input', filtrarCards);
})


const swiper = new Swiper('.swiper-container', {
  slidesPerView: 1,
  spaceBetween: 20,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
  },
})