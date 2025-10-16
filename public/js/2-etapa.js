// =====================================================================================================================
// FORMULÁRIO MULTI-ETAPAS COMPLETO EM jQUERY
// =====================================================================================================================
$(document).ready(function () {
  let currentStep = 1
  const totalSteps = 3

  const $form = $('#multiStepForm')
  const $steps = $form.find('.step')
  const $labels = $('.step-label')
  const $nextBtn = $('#nextBtn')
  const $prevBtn = $('#prevBtn')

  function showStep(step) {
    $steps.each(function (i) {
      $(this).toggleClass('hidden', i !== step - 1)
    })

    $labels.each(function () {
      $(this).toggleClass('active', parseInt($(this).data('step')) === step)
    })

    $prevBtn.toggle(step !== 1)
    $nextBtn.text(step === totalSteps ? 'Finalizar' : 'Próximo')
  }

  $nextBtn.on('click', async function () {
    if (currentStep < totalSteps) {
      currentStep++
      showStep(currentStep)
    } else {
      await enviarFormulario()
    }
  })

  $prevBtn.on('click', function () {
    if (currentStep > 1) {
      currentStep--
      showStep(currentStep)
    }
  })

  showStep(currentStep)

  // =====================================================================================================================
  // FUNÇÕES DE ENVIO (jQuery AJAX)
  // =====================================================================================================================
  async function usuario(senha, email) {
    return $.ajax({
      url: 'http://localhost:83/public/api/index.php?entidade=usuario&acao=cadastrar',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({ senha, email, tipo: 1 }),
    })
  }

  async function perfil_usuario(idusuario, nome, cpf, data, telefone) {
    return $.ajax({
      url: 'http://localhost:83/public/api/index.php?entidade=perfil_usuario&acao=cadastrar',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({
        idusuario,
        nome,
        cpf,
        data_nascimento: data,
        telefone,
        imagem: null,
        tipo: 1,
      }),
    })
  }

  async function funcionario(idusuario, nome, cpf, data, telefone) {
    return $.ajax({
      url: 'http://localhost:83/public/api/index.php?entidade=perfil_professor&acao=cadastrar',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({
        idusuario,
        nome,
        cpf,
        data_nascimento: data,
        telefone,
        imagem: null,
        tipo: 2,
      }),
    })
  }

  async function enviarEndereco(id, tipo, cep, rua, numero, complemento, bairro, cidade, estado) {
    return $.ajax({
      url: 'http://localhost:83/public/api/index.php?entidade=endereco&acao=cadastrar',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({
        id,
        tipo,
        cep,
        rua,
        numero,
        complemento,
        bairro,
        cidade,
        estado,
      }),
    })
  }

  async function enviarAssinatura(idusuario, idplano) {
    return $.ajax({
      url: 'http://localhost:83/public/api/index.php?entidade=assinatura&acao=cadastrar',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({ idusuario, idplano }),
    })
  }

  async function enviarFormulario() {
    const nome = $('#nome').val()
    const data = $('#data').val()
    const telefone = $('#telefone').val()
    const email = $('#email').val()
    const cpf = $('#cpf').val()
    const senha = $('#senha').val()
    const cep = $('#cep').val()
    const rua = $('#rua').val()
    const numero = $('#numero').val()
    const complemento = $('#complemento').val()
    const bairro = $('#bairro').val()
    const cidade = $('#cidade').val()
    const estado = $('#estado').val()
    const plano = parseInt($('#plano').val())

    try {
      const respostaUsuario = await usuario(senha, email)
      if (!respostaUsuario.sucesso || !respostaUsuario.dados?.id)
        throw new Error('Erro ao cadastrar usuário.')

      const idUsuario = respostaUsuario.dados.id

      const respostaPerfilUsuario = await perfil_usuario(idUsuario, nome, cpf, data, telefone)
      if (!respostaPerfilUsuario.sucesso) throw new Error('Erro ao cadastrar perfil.')

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
      if (!respostaEndereco.sucesso) throw new Error('Erro ao cadastrar endereço.')

      const respostaAssinatura = await enviarAssinatura(idUsuario, plano)
      if (!respostaAssinatura.sucesso) throw new Error('Erro ao cadastrar assinatura.')

      alert('✅ Cadastro realizado com sucesso!')
      $form.trigger('reset')
      window.location.href = 'http://localhost:83/public/login.php'
    } catch (error) {
      console.error('Erro no envio:', error)
      alert('❌ Erro ao cadastrar: ' + error.message)
    }
  }

  // =====================================================================================================================
  // VALIDAÇÃO DO FORMULÁRIO
  // =====================================================================================================================
  $.validator.addMethod(
    'noSpace',
    function (value) {
      return value === '' || value.trim().length > 0
    },
    'Este campo não pode conter apenas espaços.'
  )

  $.validator.addMethod(
    'strongPassword',
    function (value) {
      return (
        this.optional(element) ||
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/.test(value)
      )
    },
    'A senha deve ter ao menos 8 caracteres, incluindo maiúsculas, minúsculas, números e símbolos.'
  )

  $.validator.addMethod(
    'validarCEP',
    function (value) {
      return this.optional(element) || /^[0-9]{5}-[0-9]{3}$/.test(value)
    },
    'Informe um CEP válido (00000-000).'
  )

  $.validator.addMethod('validarData', function (value) {
    const hoje = new Date()
    const min = new Date()
    min.setFullYear(hoje.getFullYear() - 150)
    const selecionada = new Date(value)
    return selecionada <= hoje && selecionada >= min
  })

  $('#multiStepForm').validate({
    rules: {
      nome: { required: true, noSpace: true },
      email: { required: true, email: true },
      cpf: { required: true, minlength: 14, maxlength: 14 },
      telefone: { required: true, minlength: 15, maxlength: 15 },
      data: { required: true, validarData: true },
      cep: { required: true, validarCEP: true },
      rua: { required: true },
      numero: {},
      complemento: {},
      bairro: { required: true },
      cidade: { required: true },
      estado: { required: true },
      senha: { required: true, strongPassword: true },
      confirmarSenha: { required: true, equalTo: '#senha' },
      plano: { required: true },
    },
    messages: {
      nome: 'Por favor, informe seu nome.',
      email: 'Informe um e-mail válido.',
      cpf: 'Informe um CPF válido.',
      telefone: 'Informe um telefone válido.',
      data: 'Informe uma data válida.',
      cep: 'Informe um CEP válido.',
      senha: 'Senha inválida.',
      confirmarSenha: 'As senhas não coincidem.',
    },
    errorElement: 'span',
    errorClass: 'text-red-500 text-sm mt-1 block',
    highlight: function (el) {
      $(el).addClass('border-red-500').removeClass('border-green-500')
    },
    unhighlight: function (el) {
      $(el).removeClass('border-red-500').addClass('border-green-500')
    },
  })

  // =====================================================================================================================
  // BUSCA CEP AUTOMÁTICA (ViaCEP)
  // =====================================================================================================================
  const $cep = $('#cep')
  const $rua = $('#rua')
  const $bairro = $('#bairro')
  const $cidade = $('#cidade')
  const $estado = $('#estado')

  function buscaEnderecoPorCep(cep) {
    $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
      if (data.erro) {
        alert('CEP não encontrado!')
        return
      }
      $rua.val(data.logradouro)
      $bairro.val(data.bairro)
      $cidade.val(data.localidade)
      $estado.val(data.uf)
    }).fail(function () {
      alert('Erro ao buscar o CEP.')
    })
  }

  $cep.on('blur', function () {
    const valor = $(this).val().replace(/\D/g, '')
    if (valor.length === 8) buscaEnderecoPorCep(valor)
  })

  // =====================================================================================================================
  // SENHA (mostrar/ocultar e força)
  // =====================================================================================================================
  window.toggleSenha = function (id, btn) {
    const $input = $('#' + id)
    const isHidden = $input.attr('type') === 'password'
    $input.attr('type', isHidden ? 'text' : 'password')
    $(btn).html(isHidden ? '<i class="fa-regular fa-eye"></i>' : '<i class="fa-regular fa-eye-slash"></i>')
  }

  window.verificarForcaSenha = function (id) {
    const senha = $('#' + id).val()
    const $progress = $('#' + (id === 'senha' ? 'progress' : 'progress2'))
    const $message = $('#' + (id === 'senha' ? 'message' : 'message2'))
    let strength = 0

    if (senha.length >= 8) strength++
    if (/[A-Z]/.test(senha)) strength++
    if (/[a-z]/.test(senha)) strength++
    if (/\d/.test(senha)) strength++
    if (/[!@#$%^&*(),.?":{}|<>]/.test(senha)) strength++

    const strengths = [
      { w: '25%', c: 'bg-red-500', t: 'Senha Fraca' },
      { w: '50%', c: 'bg-yellow-500', t: 'Senha Média' },
      { w: '75%', c: 'bg-green-500', t: 'Senha Forte' },
      { w: '100%', c: 'bg-indigo-500', t: 'Senha Muito Forte' },
    ]

    if (strength === 0) {
      $progress.css('width', '0%').removeClass().addClass('h-full bg-gray-300')
      $message.text('')
    } else {
      const s = strengths[strength - 1]
      $progress.css('width', s.w).removeClass().addClass('h-full ' + s.c)
      $message.text(s.t)
    }
  }

  // =====================================================================================================================
  // MÁSCARAS CPF / TELEFONE
  // =====================================================================================================================
  $('#cpf').on('input', function () {
    $(this).val(
      $(this)
        .val()
        .replace(/\D/g, '')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})$/, '$1-$2')
        .substring(0, 14)
    )
  })

  $('#telefone').on('input', function () {
    $(this).val(
      $(this)
        .val()
        .replace(/\D/g, '')
        .replace(/^(\d{2})(\d)/, '($1) $2')
        .replace(/(\d{5})(\d{1,4})$/, '$1-$2')
    )
  })

  // =====================================================================================================================
  // CAMPO "SEM NÚMERO"
  // =====================================================================================================================
  $('#sem_numero').on('change', function () {
    const $num = $('#numero')
    if ($(this).is(':checked')) {
      $num.prop('disabled', true).val('S/N')
    } else {
      $num.prop('disabled', false).val('')
    }
  })
})
