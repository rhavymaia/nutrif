/* Biblioteca de validação */
var aluno = 1;
var subsequente = 2;

function validaForm() {
    var vazio = "";
    var formulario = document.formRegistroAntropometrico;

    if (formulario.aluno.value.trim() == vazio) {
        adicionaErro(formulario.aluno.name);
        return false;
    }
    
    if (formulario.matricula.value.trim() == vazio) {
        adicionaErro("Matrícula");
        return false;
    }
    
    if (formulario.dataNascimento.value.trim() == vazio) {
        adicionaErro("data nascimento");
        return false;
    }

    if (formulario.sexo.value.trim() == vazio) {
        adicionaErro(formulario.sexo.name);
        return false;
    }    

    /*
     * peso, altura,
     */

    return true;
}

function formatar(src, mask) {

    // permitindo alguns caracteres importantes
    switch (window.event.keyCode) {
        case 8:     // backspace
        case 9:     // tab
        case 37:    // left arrow
        case 39:    // right arrow
        case 46:    // delete
            window.event.returnValue = true;
            return;
    }
    
    var i = src.value.length;
    var saida = mask.substring(0, 1);
    var texto = mask.substring(i);
    
    if (texto.substring(0, 1) != saida) {
        src.value += texto.substring(0, 1);
    }
}

function resetValidacao(){
    
    limpaErro();
    
    return true;
}

function adicionaErro(campo) {

    //Limpa lista de erro.
    limpaErro();

    // Adicionando mensagem.
    var list = document.getElementById("erro");
    var li = document.createElement("li");
    li.innerHTML = "O campo " + campo + " deve ser preenchido.";
    list.appendChild(li);
}

function limpaErro() {
    var list = document.getElementById("erro");

    while (list.hasChildNodes()) {
        list.removeChild(list.lastChild);
    }
}

	