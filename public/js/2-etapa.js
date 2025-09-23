//===========================================================================================================================================================================================
// essa parte aqui do codigo e o que faz funcionar o formulario por completo o botao de ir par ao proximo e de nao ir ao proximo

let currentStep = 1
const totalSteps = 3

const form = document.getElementById('multiStepForm')
const steps = form.querySelectorAll('.step')
const labels = document.querySelectorAll('.step-label')
const nextBtn = document.getElementById('nextBtn')
const prevBtn = document.getElementById('prevBtn')

function showStep(step) {
  steps.forEach((el, i) => {
    el.classList.toggle('hidden', i !== step - 1)
  })

  labels.forEach((label) => {
    label.classList.toggle('active', parseInt(label.dataset.step) === step)
  })

  prevBtn.style.display = step === 1 ? 'none' : 'inline-block'
  nextBtn.textContent = step === totalSteps ? 'Finalizar' : 'Próximo'
}

nextBtn.addEventListener('click', async () => {
  if (currentStep < totalSteps) {
    currentStep++
    showStep(currentStep)
  } else {
    await enviarFormulario() // Chama a função principal
  }
})

showStep(currentStep)

// ================= FUNÇÕES DE ENVIO =================
async function usuario(senha, email) {
  try {
    const response = await fetch(
      'http://localhost:83/public/api/index.php?entidade=usuario&acao=cadastrar',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          senha,
          email,
          tipo: 1,
        }),
      }
    )

    // Primeiro, verifica se a requisição deu certo
    if (!response.ok) throw new Error(`Erro na requisição: ${response.status}`)

    // Lê a resposta como texto cru
    const textoBruto = await response.text()
    console.log('Resposta bruta da API:', textoBruto)

    // Tenta converter pra JSON
    try {
      const json = JSON.parse(textoBruto)
      return json
    } catch (erroDeParse) {
      console.error(
        'Erro ao fazer JSON.parse. A resposta não é um JSON válido.'
      )
      throw erroDeParse
    }
  } catch (error) {
    console.error('Erro ao cadastrar usuário:', error)
    throw error
  }
}

async function perfil_usuario(idusuario, nome, cpf, data, telefone) {
  try {
    const response = await fetch(
      'http://localhost:83/public/api/index.php?entidade=perfil_usuario&acao=cadastrar',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          idusuario,
          nome,
          senha,
          email,
          cpf,
          data_nascimento: data,
          telefone,
          imagem: null,
          tipo: 1,
        }),
      }
    )

    // Primeiro, verifica se a requisição deu certo
    if (!response.ok) throw new Error(`Erro na requisição: ${response.status}`)

    // Lê a resposta como texto cru
    const textoBruto = await response.text()
    console.log('Resposta bruta da API:', textoBruto)

    // Tenta converter pra JSON
    try {
      const json = JSON.parse(textoBruto)
      return json
    } catch (erroDeParse) {
      console.error(
        'Erro ao fazer JSON.parse. A resposta não é um JSON válido.'
      )
      throw erroDeParse
    }
  } catch (error) {
    console.error('Erro ao cadastrar usuário:', error)
    throw error
  }
}
async function funcionario(idusuario, nome, cpf, data, telefone) {
  try {
    const response = await fetch(
      'http://localhost:83/public/api/index.php?entidade=perfil_professor&acao=cadastrar',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          idusuario,
          nome,
          senha,
          email,
          cpf,
          data_nascimento: data,
          telefone,
          imagem: null,
          tipo: 2,
        }),
      }
    )

    // Primeiro, verifica se a requisição deu certo
    if (!response.ok) throw new Error(`Erro na requisição: ${response.status}`)

    // Lê a resposta como texto cru
    const textoBruto = await response.text()
    console.log('Resposta bruta da API:', textoBruto)

    // Tenta converter pra JSON
    try {
      const json = JSON.parse(textoBruto)
      return json
    } catch (erroDeParse) {
      console.error(
        'Erro ao fazer JSON.parse. A resposta não é um JSON válido.'
      )
      throw erroDeParse
    }
  } catch (error) {
    console.error('Erro ao cadastrar usuário:', error)
    throw error
  }
}
async function enviarEndereco(
  id,
  tipo,
  cep,
  rua,
  numero,
  complemento,
  bairro,
  cidade,
  estado
) {
  try {
    const response = await fetch(
      'http://localhost:83/public/api/index.php?entidade=endereco&acao=cadastrar',
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          id, // ID do usuário ou funcionário
          tipo, // tipo = 1 (usuário), 2 (funcionário), etc.
          cep,
          rua,
          numero,
          complemento,
          bairro,
          cidade,
          estado,
        }),
      }
    )

    if (!response.ok) throw new Error(`Erro na requisição: ${response.status}`)
    return await response.json()
  } catch (error) {
    console.error('Erro ao cadastrar endereço:', error)
    throw error
  }
}

async function enviarAssinatura(idusuario, idplano) {
  try {
    // Gera a data atual no formato YYYY-MM-DD
    const dataAtual = new Date().toISOString().split('T')[0]

    const response = await fetch(
      'http://localhost:83/public/api/index.php?entidade=assinatura&acao=cadastrar',
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          idusuario: idusuario,
          idplano: idplano,
        }),
      }
    )

    if (!response.ok) {
      throw new Error(`Erro na requisição: ${response.status}`)
    }

    const resultado = await response.json()
    return resultado
  } catch (error) {
    console.error('Erro ao cadastrar assinatura:', error.message)
    throw error
  }
}

async function enviarFormulario() {
  const nome = document.getElementById('nome').value
  const data = document.getElementById('data').value
  const telefone = document.getElementById('telefone').value
  const email = document.getElementById('email').value
  const cpf = document.getElementById('cpf').value
  const senha = document.getElementById('senha').value
  const cep = document.getElementById('cep').value
  const rua = document.getElementById('rua').value
  const numero = document.getElementById('numero').value
  const complemento = document.getElementById('complemento').value
  const bairro = document.getElementById('bairro').value
  const cidade = document.getElementById('cidade').value
  const estado = document.getElementById('estado').value
  const plano = parseInt(document.getElementById('plano').value)

  try {
    // 1. Cadastra (Usuario)
    const respostaUsuario = await usuario(senha, email)
    if (!respostaUsuario.sucesso || !respostaUsuario.dados?.id) {
      throw new Error('Erro ao cadastrar usuário.')
    }
    const idUsuario = respostaUsuario.dados.id

    // 2. Cadastra (perfil completo)
    const respostaPerfilUsuario = await perfil_usuario(
      idUsuario,
      nome,
      cpf,
      data,
      telefone
    )
    if (!respostaPerfilUsuario.sucesso) {
      throw new Error('Erro ao cadastrar usuário.')
    }

    // 3. Cadastra endereço
    const respostaEndereco = await enviarEndereco(
      idUsuario,
      1,
      cep,
      rua,
      numero,
      complemento,
      bairro,
      cidade,
      estado
    )
    if (!respostaEndereco.sucesso) {
      throw new Error('Erro ao cadastrar endereço.')
    }

    // 4. Cadastra assinatura
    const respostaAssinatura = await enviarAssinatura(idUsuario, plano)
    if (!respostaAssinatura.sucesso) {
      throw new Error('Erro ao cadastrar assinatura.')
    }

    // ✅ Sucesso
    alert('Cadastro realizado com sucesso!')
    document.querySelector('form')?.reset()
    window.location.href = 'http://localhost:83/public/login.php'
  } catch (error) {
    console.error('Erro no envio do formulário:', error)
    alert('Erro ao cadastrar: ' + error.message)
  }
}

prevBtn.addEventListener('click', () => {
  if (currentStep > 1) {
    currentStep--
    showStep(currentStep)
  }
})

showStep(currentStep)

//===========================================================================================================================================================================================
// aqui começar a validação geral  com nome email cpf e por ai vai...
$('document').ready(function () {
  // Métodos customizados
  $.validator.addMethod(
    'noSpace',
    function (value, element) {
      return value === '' || value.trim().length > 0
    },
    'Este campo não pode conter apenas espaços.'
  )

  $.validator.addMethod(
    'strongPassword',
    function (value, element) {
      return (
        this.optional(element) ||
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/.test(value)
      )
    },
    'A senha deve ter ao menos 8 caracteres, incluindo maiúsculas, minúsculas, números e símbolos.'
  )

  $.validator.addMethod('validarData', function (value, element) {
    // Data atual
    var today = new Date()
    // Data máxima (150 anos atrás)
    var maxDate = new Date()
    maxDate.setFullYear(today.getFullYear() - 150)
    // Se a data for maior que a data de hoje ou mais nova que 150 anos, é inválida
    var selectedDate = new Date(value)

    return selectedDate <= today && selectedDate >= maxDate
  })
  // Validação do formulário
  $('#multiStepForm').validate({
    rules: {
      nome: {
        required: true,
        noSpace: true,
      },
      email: {
        required: true,
        noSpace: true,
        email: true,
      },
      cpf: {
        required: true,
        noSpace: true,
        minlength: 14,
        maxlength: 14,
      },
      telefone: {
        required: true,
        noSpace: true,
        minlength: 15,
        maxlength: 15,
      },
      data: {
        required: true,
        validarData: true,
      },
      cep: {
        required: true,
        noSpace: true,
        minlength: 9,
        maxlength: 9,
      },
      rua: {
        required: true,
        noSpace: true,
      },
      numero: {
        noSpace: true,
      },
      complemento: {
        noSpace: true,
      },
      bairro: {
        required: true,
        noSpace: true,
      },
      cidade: {
        required: true,
        noSpace: true,
      },
      estado: {
        required: true,
        noSpace: true,
      },
      senha: {
        required: true,
        strongPassword: true,
      },
      confirmarSenha: {
        required: true,
        equalTo: '#senha',
      },
      plano: {
        required: true,
      },
    },
    messages: {
      nome: {
        required: 'Por favor, informe seu nome.',
        noSpace: 'O nome não pode conter apenas espaços.',
      },
      email: {
        required: 'Por favor, informe seu email.',
        noSpace: 'O email não pode conter apenas espaços.',
        email: 'Por favor, utilize um email válido',
      },
      cpf: {
        required: 'Por favor, informe seu CPF.',
        noSpace: 'O CPF não pode conter apenas espaços.',
        minlength: 'O CPF deve conter exatamente 11 dígitos.',
        maxlength: 'O CPF deve conter exatamente 11 dígitos.',
      },
      telefone: {
        required: 'Por favor, informe seu telefone.',
        noSpace: 'O telefone não pode conter apenas espaços.',
        minlength: 'O telefone deve conter exatamente 11 dígitos.',
        maxlength: 'O telefone deve conter exatamente 11 dígitos.',
      },
      data: {
        required: 'Por favor, informe sua data de nascimento.',
        validarData: 'Por favor, informe uma data válida.',
      },
      cep: {
        required: 'Por favor, informe seu CEP.',
        noSpace: 'O CEP não pode conter apenas espaços.',
        minlength: 'O CEP deve conter exatamente 8 dígitos.',
        maxlength: 'O CEP deve conter exatamente 8 dígitos.',
      },
      rua: {
        required: 'Por favor, informe a rua.',
        noSpace: 'A rua não pode conter apenas espaços.',
      },
      numero: {
        noSpace: 'O número não pode conter apenas espaços.',
      },
      complemento: {
        noSpace: 'O complemento não pode conter apenas espaços.',
      },
      bairro: {
        required: 'Por favor, informe o bairro.',
        noSpace: 'O bairro não pode conter apenas espaços.',
      },
      cidade: {
        required: 'Por favor, informe a cidade.',
        noSpace: 'A cidade não pode conter apenas espaços.',
      },
      estado: {
        required: 'Por favor, informe o estado.',
        noSpace: 'O estado não pode conter apenas espaços.',
      },
      senha: {
        required: 'Por favor, informe a senha.',
        strongPassword:
          'Senha deve ter ao menos 8 caracteres, letras e números.',
      },
      confirmarSenha: {
        required: 'Por favor, confirme a senha.',
        equalTo: 'As senhas não coincidem.',
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      // Encontra o container de erro específico
      var errorContainer = element.next('.error-message')
      if (errorContainer.length) {
        errorContainer.removeClass('hidden').html(error.text())
      } else {
        // Se não encontrar, cria um novo
        error.addClass('error-message text-red-500 text-sm mt-1')
        error.insertAfter(element)
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('border-red-500').removeClass('border-green-500')
      // Mostra o container de erro
      var errorContainer = $(element).next('.error-message')
      if (errorContainer.length) {
        errorContainer.removeClass('hidden')
      }
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('border-red-500').addClass('border-green-500')
      // Esconde o container de erro
      var errorContainer = $(element).next('.error-message')
      if (errorContainer.length) {
        errorContainer.addClass('hidden')
      }
    },
    invalidHandler: function (event, validator) {
      // Debug: mostra erros no console
      console.log('Erros de validação:', validator.errorList)
    },
  })

  // Teste simples para verificar se a validação está funcionando
  console.log('Validação jQuery carregada:', $.fn.validate !== undefined)
})
//===========================================================================================================================================================================================
// Aqui e o que faz a busca do cep funcionar e preencher os campos automaticamente
$(document).ready(function () {
  const $cep = $('#cep')
  const $rua = $('#rua')
  const $numero = $('#numero')
  const $complemento = $('#complemento')
  const $bairro = $('#bairro')
  const $cidade = $('#cidade')
  const $estado = $('#estado')

  // --- Funções auxiliares ---
  function showFieldError($input, message) {
    const $err = $input.next('.error')
    $err.text(message).removeClass('hidden')
    $input.addClass('border-red-500')
  }

  function clearFieldError($input) {
    const $err = $input.next('.error')
    $err.text('').addClass('hidden')
    $input.removeClass('border-red-500')
  }

  function lockAddressFields() {
    $rua.prop('disabled', true)
    $numero.prop('disabled', true)
    $complemento.prop('disabled', true)
    $bairro.prop('disabled', true)
  }

  function unlockAddressFields() {
    $rua.prop('disabled', false)
    $numero.prop('disabled', false)
    $complemento.prop('disabled', false)
    $bairro.prop('disabled', false)
  }

  // --- Função principal ---
  function buscaEnderecoPorCep(cep) {
    let timeout = setTimeout(() => {
      unlockAddressFields()
      showFieldError($cep, 'Tempo limite excedido. Preencha manualmente.')
    }, 5000) // 5 segundos

    $.ajax({
      url: `https://viacep.com.br/ws/${cep}/json/`,
      dataType: 'json',
      success: function (data) {
        clearTimeout(timeout)

        if (data.erro) {
          showFieldError($cep, 'CEP não encontrado.')
          return
        }

        $rua.val(data.logradouro || '')
        $bairro.val(data.bairro || '')
        $cidade.val(data.localidade || '')
        $estado.val(data.uf || '')

        unlockAddressFields()
        clearFieldError($cep)
      },
      error: function () {
        clearTimeout(timeout)
        unlockAddressFields()
        showFieldError($cep, 'Erro ao buscar o CEP.')
      },
    })
  }

  // --- Evento blur no CEP ---
  $cep.on('blur', function () {
    const cep = $(this).val().replace(/\D/g, '')
    if (cep.length !== 8) {
      showFieldError($cep, 'CEP inválido! Deve ter 8 números.')
      return
    }

    clearFieldError($cep)
    lockAddressFields()
    buscaEnderecoPorCep(cep)
  })

  // --- Inicializa com os campos bloqueados ---
  lockAddressFields()
})

//===========================================================================================================================================================================================
// Alterna entre mostrar/ocultar senha
function toggleSenha(id, btn) {
  const input = document.getElementById(id)
  const isHidden = input.type === 'password'
  input.type = isHidden ? 'text' : 'password'

  const eyeOpen = '<i class="fa-regular fa-eye h-16"></i>'
  const eyeOff = '<i class="fa-regular fa-eye-slash h-16"></i>'

  btn.innerHTML = isHidden ? eyeOpen : eyeOff
}

// Verifica força da senha (funciona para senha e confirmarSenha)
function verificarForcaSenha(id) {
  const senha = document.getElementById(id).value
  const progressBar = document.getElementById(id === 'senha' ? 'progress' : 'progress2')
  const message = document.getElementById(id === 'senha' ? 'message' : 'message2')

  if (senha.length === 0) {
    progressBar.style.width = '0%'
    progressBar.className = 'h-full bg-gray-300'
    message.innerText = ''
    message.className = 'text-gray-700'
    return
  }

  // Critérios
  let strength = 0
  const regexUpper = /[A-Z]/
  const regexLower = /[a-z]/
  const regexDigits = /\d/
  const regexSpecial = /[!@#$%^&*(),.?":{}|<>]/

  if (senha.length >= 8) strength++
  if (regexUpper.test(senha)) strength++
  if (regexLower.test(senha)) strength++
  if (regexDigits.test(senha)) strength++
  if (regexSpecial.test(senha)) strength++

  // Força da senha
  switch (strength) {
    case 1:
    case 2:
      progressBar.style.width = '25%'
      progressBar.className = 'h-full bg-red-500'
      message.innerText = 'Senha Fraca'
      message.className = 'text-red-500'
      break
    case 3:
      progressBar.style.width = '50%'
      progressBar.className = 'h-full bg-yellow-500'
      message.innerText = 'Senha Média'
      message.className = 'text-yellow-500'
      break
    case 4:
      progressBar.style.width = '75%'
      progressBar.className = 'h-full bg-green-500'
      message.innerText = 'Senha Forte'
      message.className = 'text-green-500'
      break
    case 5:
      progressBar.style.width = '100%'
      progressBar.className = 'h-full bg-indigo-500'
      message.innerText = 'Senha Muito Forte'
      message.className = 'text-indigo-500'
      break
    default:
      progressBar.style.width = '0%'
      progressBar.className = 'h-full bg-gray-300'
      message.innerText = ''
      message.className = 'text-gray-700'
  }
}


//===========================================================================================================================================================================================
// aqui aplicar mascaraCPf, mascaraTelefone para deixa para o usuario facil de entender e ver oq e como fazer tudo
function aplicarMascaraCPF(valor) {
  return valor
    .replace(/\D/g, '') // Remove tudo que não for número
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d{1,2})$/, '$1-$2')
}

function aplicarMascaraTelefone(valor) {
  return valor
    .replace(/\D/g, '')
    .replace(/^(\d{2})(\d)/, '($1) $2')
    .replace(/(\d{5})(\d{1,4})$/, '$1-$2')
}

// Aplica a máscara enquanto o usuário digita
document.getElementById('cpf').addEventListener('input', function (e) {
  this.value = aplicarMascaraCPF(this.value)
})

document.getElementById('telefone').addEventListener('input', function (e) {
  this.value = aplicarMascaraTelefone(this.value)
})
this.value = aplicarMascaraCPF(this.value).substring(0, 14)
//=================================================================================================================================================================
function toggleNumero() {
  const numeroInput = document.getElementById('numero')
  const semNumeroCheckbox = document.getElementById('sem_numero')

  if (semNumeroCheckbox.checked) {
    // Se "S/N" estiver marcado, desabilita o campo e coloca um valor específico
    numeroInput.disabled = true
    numeroInput.value = 'S/N' // Atribui o valor 'S/N' ao campo
  } else {
    // Se "S/N" não estiver marcado, habilita o campo de número
    numeroInput.disabled = false
    numeroInput.value = '' // Limpa o valor do campo quando reabilitado
  }
}
