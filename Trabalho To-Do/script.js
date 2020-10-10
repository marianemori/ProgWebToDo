function onclickMenu(id) {
    var elemento = document.getElementById(id);
    console.log(id);

    if (elemento.style.display == 'none') {
        elemento.style.display = 'flex';
    } else {
        elemento.style.display = 'none';
    }
}

function edit(id) {
    var elemento = document.querySelectorAll(`#${id}`);

    elemento.forEach(textarea => {
        if (textarea.disabled) {
            textarea.disabled = false;
        } else {
            textarea.disabled = true;
        }
    })


}

function adicionarTarefas() {
    let containerTarefas = document.getElementById('container-tarefas');
    let novaTarefa = `
    <div class="tarefa mb-1">
        <div class="tarefa">
            <img src="assets/tasks.png" height="28" width="28" alt="" onclick="concluirTarefa()">
            <p>Nova Tarefa</p>
        </div>
        <img class="imagem-editar" onclick="onclickMenu('edit')" src="assets/edit.png" height="25" width="7" alt="Editar">
    </div>`
    containerTarefas.innerHTML += novaTarefa;

}

function concluirTarefa() {
    let tarefa = event.target.parentNode.parentNode;
    event.target.parentNode.parentNode.remove();
    let containerConcluida = document.getElementById('container-concluida');
    console.log(tarefa.firstElementChild)
    if (tarefa.firstElementChild.firstElementChild.src) {
        tarefa.firstElementChild.firstElementChild.src = "assets/done.png";
    }
    containerConcluida.appendChild(tarefa);
}

function editNomeLista() {
    let btnEditar = event.target
    let nomeLista = event.target.previousElementSibling
    if (nomeLista.disabled) {
        nomeLista.disabled = false
        btnEditar.src = 'assets/done.png'
    } else {
        nomeLista.disabled = true
        btnEditar.src = 'assets/editBtn.png'
    }


}