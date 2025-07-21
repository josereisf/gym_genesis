//===========================================================================================================================================================================================
// essa parte aqui do codigo e o que faz funcionar o formulario por completo o botao de ir par ao proximo e de nao ir ao proximo
let currentStep = 1;
const totalSteps = 3;

const form = document.getElementById("multiStepForm");
const steps = form.querySelectorAll(".step");
const labels = document.querySelectorAll(".step-label");
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");

function showStep(step) {
  steps.forEach((el, i) => {
    el.classList.toggle("hidden", i !== step - 1);
  });

  labels.forEach((label) => {
    label.classList.toggle(
      "active",
      parseInt(label.dataset.step) === step
    );
  });

  prevBtn.style.display = step === 1 ? "none" : "inline-block";
  nextBtn.textContent = step === totalSteps ? "Finalizar" : "Próximo";
}

nextBtn.addEventListener("click", async () => {
  if (currentStep < totalSteps) {
    currentStep++;
    showStep(currentStep);
  } else {
    await enviarFormulario(); // Chama a função principal
  }
});

showStep(currentStep);

// ================= FUNÇÕES DE ENVIO =================

async function usuario(nome, senha, email, cpf, data, telefone) {
  try {
    const response = await fetch('http://localhost:83/public/api/index.php?entidade=usuario&acao=cadastrar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        nome, 
        senha, 
        email, 
        cpf,
        data_nascimento: data,
        telefone,
        imagem: null,
        tipo: 1
      })
    });

    if (!response.ok) throw new Error(`Erro na requisição: ${response.status}`);
    return await response.json();
  } catch (error) {
    console.error('Erro ao cadastrar usuário:', error);
    throw error;
  }
}

async function enviarEndereco(id, tipo, cep, rua, numero, complemento, bairro, cidade, estado) {
  try {
    const response = await fetch('http://localhost:83/public/api/index.php?entidade=endereco&acao=cadastrar', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        id,           // ID do usuário ou funcionário
        tipo,         // tipo = 1 (usuário), 2 (funcionário), etc.
        cep,
        rua,
        numero,
        complemento,
        bairro,
        cidade,
        estado
      })
    });

    if (!response.ok) throw new Error(`Erro na requisição: ${response.status}`);
    return await response.json();
  } catch (error) {
    console.error('Erro ao cadastrar endereço:', error);
    throw error;
  }
}


async function enviarFormulario() {
  const nome = document.getElementById('nome').value;
  const data = document.getElementById('data').value;
  const telefone = document.getElementById('telefone').value;
  const email = document.getElementById('email').value;
  const cpf = document.getElementById('cpf').value;
  const senha = document.getElementById('senha').value;
  const cep = document.getElementById('cep').value;
  const rua = document.getElementById('rua').value;
  const numero = document.getElementById('numero').value;
  const complemento = document.getElementById('complemento').value;
  const bairro = document.getElementById('bairro').value;
  const cidade = document.getElementById('cidade').value;
  const estado = document.getElementById('estado').value;

  try {
    const respostaUsuario = await usuario(nome, senha, email, cpf, data, telefone);
    console.log("Usuário cadastrado:", respostaUsuario);
    const idUsuario = respostaUsuario.data.id;

    const respostaEndereco = await enviarEndereco(idUsuario, 1, cep, rua, numero, complemento, bairro, cidade, estado);
    console.log("Endereço cadastrado:", respostaEndereco);

    alert("Cadastro realizado com sucesso!");
    form.reset();
    window.location.href = "http://localhost:83/public/login.html"; // Redireciona para a página inicial
    currentStep = 1;
    showStep(currentStep);
  } catch (error) {
    alert("error ao cadastrar: " + error.message);
  }
}


prevBtn.addEventListener("click", () => {
  if (currentStep > 1) {
    currentStep--;
    showStep(currentStep);
  }
});

showStep(currentStep);


//===========================================================================================================================================================================================
// aqui começar a validação geral  com nome email cpf e por ai vai...
const nomeInput = document.getElementById("nome");
const emailInput = document.getElementById("email");
const cpfInput = document.getElementById("cpf");
const telefoneInput = document.getElementById("telefone");

function showError(input, message) {
  const errorMsg = input.nextElementSibling;
  errorMsg.textContent = message;
  errorMsg.classList.remove("hidden");
  input.classList.add("border-red-500", "animate-shake");
  input.classList.remove("border-green-500");
  setTimeout(() => input.classList.remove("animate-shake"), 500);
}

function showSuccess(input) {
  const errorMsg = input.nextElementSibling;
  errorMsg.classList.add("hidden");
  errorMsg.textContent = "";
  input.classList.remove("border-red-500");
  input.classList.add("border-green-500");
}

// Validações simples

function validateNome() {
  const val = nomeInput.value.trim();
  if (val.length < 3) {
    showError(nomeInput, "Nome deve ter pelo menos 3 caracteres");
    return false;
  }
  showSuccess(nomeInput);
  return true;
}

function validateEmail() {
  const val = emailInput.value.trim();
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(val)) {
    showError(emailInput, "Email inválido");
    return false;
  }
  showSuccess(emailInput);
  return true;
}

function validateCPF() {
  const val = cpfInput.value.replace(/\D/g, ""); // só números
  if (val.length !== 11) {
    showError(cpfInput, "CPF deve ter 11 números");
    return false;
  }
  // Pode implementar validação real de CPF aqui depois
  showSuccess(cpfInput);
  return true;
}

function validateTelefone() {
  const val = telefoneInput.value.replace(/\D/g, "");
  if (val.length < 10) {
    showError(telefoneInput, "Telefone deve ter ao menos 10 dígitos");
    return false;
  }
  showSuccess(telefoneInput);
  return true;
}

// Eventos

[nomeInput, emailInput, cpfInput, telefoneInput].forEach((input) => {
  input.addEventListener("blur", () => {
    switch (input.id) {
      case "nome":
        validateNome();
        break;
      case "email":
        validateEmail();
        break;
      case "cpf":
        validateCPF();
        break;
      case "telefone":
        validateTelefone();
        break;
    }
  });
});

//===========================================================================================================================================================================================
// Elementos do DOM
const cepInput = document.getElementById("cep");
const ruaInput = document.getElementById("rua");
const numeroInput = document.getElementById("numero");
const complementoInput = document.getElementById("complemento");
const bairroInput = document.getElementById("bairro");
const cidadeInput = document.getElementById("cidade");
const estadoInput = document.getElementById("estado");

// Funções de tratamento de erro visual
function showFieldError(input, message) {
  const errEl = input.nextElementSibling;
  errEl.textContent = message;
  errEl.classList.remove("hidden");
  input.classList.add("border-red-500");
}

function clearFieldError(input) {
  const errEl = input.nextElementSibling;
  errEl.textContent = "";
  errEl.classList.add("hidden");
  input.classList.remove("border-red-500");
}

// Bloqueia/desbloqueia os campos de endereço
function lockAddressFields() {
  ruaInput.disabled = true;
  numeroInput.disabled = true;
  complementoInput.disabled = true;
  bairroInput.disabled = true;
}

function unlockAddressFields() {
  ruaInput.disabled = false;
  numeroInput.disabled = false;
  complementoInput.disabled = false;
  bairroInput.disabled = false;
}

// Função principal: busca endereço via CEP
async function buscaEnderecoPorCep(cep) {
  try {
    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    const data = await response.json();

    if (data.erro) {
      showFieldError(cepInput, "CEP não encontrado.");
      return;
    }

    ruaInput.value = data.logradouro || "";
    bairroInput.value = data.bairro || "";
    cidadeInput.value = data.localidade || "";
    estadoInput.value = data.uf || "";

    unlockAddressFields();
    clearFieldError(cepInput);
  } catch (error) {
    showFieldError(cepInput, "Erro ao buscar o CEP.");
    console.error(error);
  }
}

// Evento de blur no campo de CEP
cepInput.addEventListener("blur", () => {
  const cep = cepInput.value.replace(/\D/g, "");
  if (cep.length !== 8) {
    showFieldError(cepInput, "CEP inválido! Deve ter 8 números.");
    return;
  }

  clearFieldError(cepInput);
  buscaEnderecoPorCep(cep);
});

// Inicializa com os campos bloqueados
lockAddressFields();



//===========================================================================================================================================================================================
// aqui e o que faz os olhos da senha se mexerem e mudares suas formas...
function toggleSenha(id, btn) {
  const input = document.getElementById(id);
  const isHidden = input.type === "password";
  input.type = isHidden ? "text" : "password";

  // Ícones SVG para olho aberto e fechado
  const eyeOpen = `
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`;

  const eyeOff = `
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path d="M17.94 17.94a10.06 10.06 0 01-11.88 0M1 1l22 22M9.88 9.88A3 3 0 0012 15a3 3 0 002.12-.88M2.1 12a9.94 9.94 0 0119.8 0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>`;

  btn.innerHTML = isHidden ? eyeOpen : eyeOff;
}
//===========================================================================================================================================================================================
// aqui aplicar mascaraCPf, mascaraTelefone para deixa para o usuario facil de entender e ver oq e como fazer tudo
function aplicarMascaraCPF(valor) {
  return valor
    .replace(/\D/g, "") // Remove tudo que não for número
    .replace(/(\d{3})(\d)/, "$1.$2")
    .replace(/(\d{3})(\d)/, "$1.$2")
    .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
}

function aplicarMascaraTelefone(valor) {
  return valor
    .replace(/\D/g, "")
    .replace(/^(\d{2})(\d)/, "($1) $2")
    .replace(/(\d{5})(\d{1,4})$/, "$1-$2");
}

// Aplica a máscara enquanto o usuário digita
document.getElementById("cpf").addEventListener("input", function (e) {
  this.value = aplicarMascaraCPF(this.value);
});

document
  .getElementById("telefone")
  .addEventListener("input", function (e) {
    this.value = aplicarMascaraTelefone(this.value);
  });
this.value = aplicarMascaraCPF(this.value).substring(0, 14);
//=================================================================================================================================================================
