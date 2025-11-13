document.addEventListener('DOMContentLoaded', () => {
  const botaoPerfil = document.getElementById('botaoPerfil')
  const menuPerfil = document.getElementById('menuPerfil')

  botaoPerfil.addEventListener('click', () => {
    menuPerfil.classList.toggle('hidden')
  })

  // Fecha o menu se clicar fora dele
  document.addEventListener('click', (event) => {
    if (!menuPerfil.contains(event.target) && !botaoPerfil.contains(event.target)) {
      menuPerfil.classList.add('hidden')
    }
  })
})
const btnAbrirModal = document.getElementById('btnAbrirModal')
const btnFecharModal = document.getElementById('btnFecharModal')
const modalForm = document.getElementById('modalForm')
const formMeta = document.getElementById('formMeta')

btnAbrirModal.addEventListener('click', () => {
  modalForm.classList.remove('hidden')
})

btnFecharModal.addEventListener('click', () => {
  modalForm.classList.add('hidden')
  formMeta.reset()
})

formMeta.addEventListener('submit', async (e) => {
  e.preventDefault()

  const formData = new FormData(formMeta)

  try {
    const res = await fetch(
      'http://localhost:83/public/api/index.php?entidade=meta_usuario&acao=cadastrar',
      {
        method: 'POST',
        body: formData,
      }
    )

    const texto = await res.text() // pega a resposta crua
    console.log('Resposta do servidor:', texto)

    if (!res.ok) {
      alert(`Erro HTTP: ${res.status}`)
      return
    }

    let data
    try {
      data = JSON.parse(texto) // parse manual
    } catch (err) {
      alert('Resposta inválida do servidor, não é JSON.')
      console.error('Erro ao fazer parse do JSON:', err)
      return
    }

    // Aqui mostro a mensagem que vier do backend, mesmo no sucesso ou erro
    if (data.mensagem) {
      alert(data.mensagem)
    } else if (data.sucesso) {
      alert('Operação realizada com sucesso!')
    } else {
      alert('Resposta inesperada do servidor.')
    }

    if (data.sucesso) {
      modalForm.classList.add('hidden')
      formMeta.reset()

      // Aqui pode atualizar a lista no dashboard se quiser
    }
  } catch (err) {
    alert('Erro ao conectar com o servidor.')
    console.error(err)
  }
})

// Progress Chart
const ctx = document.getElementById('progressChart').getContext('2d')
const progressChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
    datasets: [
      {
        label: 'Calorias Queimadas',
        data: [450, 580, 690, 520, 730, 810, 540],
        borderColor: 'rgb(99, 102, 241)',
        backgroundColor: 'rgba(99, 102, 241, 0.1)',
        tension: 0.3,
        fill: true,
      },
      {
        label: 'Tempo de Treino (min)',
        data: [45, 60, 75, 55, 80, 90, 60],
        borderColor: 'rgb(16, 185, 129)',
        backgroundColor: 'rgba(16, 185, 129, 0.0)',
        tension: 0.3,
        borderDash: [5, 5],
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'top',
      },
    },
    scales: {
      y: {
        beginAtZero: true,
        grid: {
          display: true,
          color: 'rgba(0, 0, 0, 0.05)',
        },
      },
      x: {
        grid: {
          display: false,
        },
      },
    },
  },
})

// Progress Button Handlers
const progressBtns = document.querySelectorAll('.progress-btn')
progressBtns.forEach((btn) => {
  btn.addEventListener('click', () => {
    // Reset all buttons
    progressBtns.forEach((b) => {
      b.classList.remove('bg-indigo-600', 'text-white')
      b.classList.add('bg-gray-200', 'text-gray-700')
    })

    // Highlight clicked button
    btn.classList.remove('bg-gray-200', 'text-gray-700')
    btn.classList.add('bg-indigo-600', 'text-white')

    // Update chart data based on period
    const period = btn.dataset.period
    let labels, caloriesData, timeData

    if (period === 'week') {
      labels = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom']
      caloriesData = [450, 580, 690, 520, 730, 810, 540]
      timeData = [45, 60, 75, 55, 80, 90, 60]
    } else if (period === 'month') {
      labels = ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4']
      caloriesData = [3200, 3800, 4100, 3900]
      timeData = [320, 380, 410, 390]
    } else {
      labels = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun']
      caloriesData = [12000, 14500, 13800, 15200, 16100, 15800]
      timeData = [1200, 1450, 1380, 1520, 1610, 1580]
    }

    progressChart.data.labels = labels
    progressChart.data.datasets[0].data = caloriesData
    progressChart.data.datasets[1].data = timeData
    progressChart.update()
  })
})

// Notification Modal
const notificationBtn = document.getElementById('notificationBtn')
const notificationModal = document.getElementById('notificationModal')
const closeNotificationBtn = document.getElementById('closeNotificationBtn')

notificationBtn.addEventListener('click', () => {
  notificationModal.classList.remove('hidden')
  notificationModal.classList.add('flex')
})

closeNotificationBtn.addEventListener('click', () => {
  notificationModal.classList.add('hidden')
  notificationModal.classList.remove('flex')
})

// Close modal when clicking outside
notificationModal.addEventListener('click', (e) => {
  if (e.target === notificationModal) {
    notificationModal.classList.add('hidden')
    notificationModal.classList.remove('flex')
  }
})

function mostrarBotoesAgua() {
  const botoes = document.getElementById('botoes-agua')
  botoes.classList.toggle('hidden')
}

function mostrarInput() {
  const botoes = document.getElementById('input-peso')
  botoes.classList.toggle('hidden')
}

const btnStart = document.getElementById('btnStart')
const modal = document.getElementById('modal')
const btnClose = document.getElementById('btnClose')
const mainContent = document.getElementById('main-content')

function openModal() {
  modal.classList.remove('opacity-0', 'pointer-events-none')
  modal.classList.add('opacity-100')
  mainContent.classList.add('blur-sm', 'pointer-events-none') // Aplica blur e bloqueia interação no fundo
}

function closeModal() {
  modal.classList.add('opacity-0', 'pointer-events-none')
  modal.classList.remove('opacity-100')
  mainContent.classList.remove('blur-sm', 'pointer-events-none') // Remove blur e desbloqueia interação
}

btnStart.addEventListener('click', openModal)
btnClose.addEventListener('click', closeModal)

// Fecha o modal ao clicar fora do conteúdo (no backdrop)
modal.addEventListener('click', (e) => {
  if (e.target === modal) {
    closeModal()
  }
})
document.addEventListener('DOMContentLoaded', () => {
  const formPeso = document.getElementById('form-peso')

  formPeso.addEventListener('submit', async (e) => {
    e.preventDefault()

    const formData = new FormData(formPeso)

    try {
      const res = await fetch(formPeso.action, {
        method: 'POST',
        body: formData,
      })

      const texto = await res.text()
      console.log('Resposta do servidor:', texto)

      if (!res.ok) {
        alert(`Erro HTTP: ${res.status}`)
        return
      }

      let data
      try {
        data = JSON.parse(texto)
      } catch (err) {
        alert('Resposta inválida do servidor, não é JSON.')
        console.error('Erro ao fazer parse do JSON:', err)
        return
      }

      // Mostra a mensagem do backend
      if (data.mensagem) alert(data.mensagem)

      // Se der sucesso, recarrega a página
      if (data.sucesso) {
        location.reload()
      }
    } catch (err) {
      alert('Erro ao conectar com o servidor.')
      console.error(err)
    }
  })
})

;(function () {
  function c() {
    var b = a.contentDocument || a.contentWindow.document
    if (b) {
      var d = b.createElement('script')
      d.innerHTML =
        "window.__CF$cv$params={r:'94bcd4c1c300e01a',t:'MTc0OTI2NDUxMi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);"
      b.getElementsByTagName('head')[0].appendChild(d)
    }
  }
  if (document.body) {
    var a = document.createElement('iframe')
    a.height = 1
    a.width = 1
    a.style.position = 'absolute'
    a.style.top = 0
    a.style.left = 0
    a.style.border = 'none'
    a.style.visibility = 'hidden'
    document.body.appendChild(a)
    if ('loading' !== document.readyState) c()
    else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c)
    else {
      var e = document.onreadystatechange || function () {}
      document.onreadystatechange = function (b) {
        e(b)
        'loading' !== document.readyState && ((document.onreadystatechange = e), c())
      }
    }
  }
})()
lucide.createIcons()

function concluirTreino(id) {
  const card = document.getElementById('card-' + id)
  card.classList.toggle('concluido')
}
