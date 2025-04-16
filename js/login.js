const loginForm = document.querySelector('.login-form');
const signupForm = document.querySelector('.signup-form');

function swapPos(btn) {
    const isSignupSwitch = btn.classList.contains('signup-switch');
    signupForm.classList.toggle('above', isSignupSwitch);
    loginForm.classList.toggle('above', !isSignupSwitch);
    signupForm.classList.toggle('below', !isSignupSwitch);
    loginForm.classList.toggle('below', isSignupSwitch);
}

function validarSenha() {
    let senha = document.getElementById("password").value;
    let confirmarSenha = document.getElementById("confirm-pass").value;
    let botao = document.getElementById("registro");
    let campoConfirmar = document.getElementById("confirm-pass");

    if (senha === confirmarSenha && senha !== "") {
        botao.disabled = false;
        campoConfirmar.classList.add("valido");
        campoConfirmar.classList.remove("invalido");
    } else {
        botao.disabled = true;
        campoConfirmar.classList.add("invalido");
        campoConfirmar.classList.remove("valido");
    }
}

let email = document.getElementById("email-address").value;
let senha = document.getElementById("create-pass").value;


