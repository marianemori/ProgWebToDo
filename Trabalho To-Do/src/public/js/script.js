var currentNameTaskEditing;

function showMenu(id, action) {
    let elemento = document.getElementById(id);
    elemento.classList.remove('d-none')

    if(action == 'close'){
        elemento.classList.add('d-none')
    }
    if (id === 'edit') {
        let taskId = event.target.parentNode.parentNode.dataset['taskid']
        currentNameTaskEditing = event.target.parentNode.previousElementSibling.children[1]
        loadTaskInfo(taskId)
    }

}

function loadTaskInfo(taskId) {
    let editForm = document.getElementById('edit')
    fetch(`/controllers/task.php?taskId=${taskId}`, { method: 'GET' })
        .then(data => { return data.json() })
        .then(task => {
            editForm.innerHTML = `
            <img class="cursor-pointer" onclick="showMenu('edit', 'close')" src="./public/assets/left-arrow.png" height="22" width="22" alt="Editar">
            <div class="editar-botao "  data-editing="false">   
                <input id="input-name" type="text" value="${task.nome}" class="titulo-edicao" disabled></input type="text">

                <button id="btn-editar" class="botao-editar" onclick="changeEditButton('edicao')" data-taskid="${taskId}">Editar</button>
                <button id="btn-salvar" class="d-none" onclick="changeEditButton('edicao')" data-taskid="${taskId}">Salvar</button>
                
                </div>
                <h2>Descrição</h2>
                <textarea id="input-description" disabled maxlength="410" rows="10">${task.descricao}</textarea>
                <h2>Data Limite</h2>
                <input id="input-date" class="data-edicao"  disabled type="date" value="${task.data_tarefa}"">  
                <div id="alert-div" class="alert d-none">
                    <p id="alert-text">Deu certo</p>
                </div>
            </div>`

        })
}

function edit(id) {
    let { name, description, date } = {
        name: document.getElementById('input-name'),
        description: document.getElementById('input-description'),
        date: document.getElementById('input-date')
    }
    let isEditing = name.parentNode.dataset['editing']
    if (isEditing == 'false') {
        name.disabled = false
        description.disabled = false
        date.disabled = false
    } else {
        name.disabled = true
        description.disabled = true
        date.disabled = true
    }
}


function changeEditButton(id) {
    let btnSalvar = document.getElementById('btn-salvar')
    let btnEditar = document.getElementById('btn-editar')
    let isEditing = event.target.parentNode.dataset['editing']
    if (isEditing == 'false') {
        edit(id)
        event.target.classList.toggle('d-none')
        btnSalvar.classList.toggle('d-none')
        event.target.parentNode.dataset['editing'] = 'true'
    } else {
        edit(id)
        btnEditar.classList.toggle('d-none')
        btnSalvar.classList.toggle('d-none')
        event.target.parentNode.dataset['editing'] = 'false'
        let { taskid, name, description, date } = {
            taskid: btnSalvar.dataset['taskid'],
            name: document.getElementById('input-name').value,
            description: document.getElementById('input-description').value,
            date: document.getElementById('input-date').value
        }
        fetch(`controllers/task.php?taskId=${event.target.dataset['taskid']}&name=${name}&description=${description}&date=${date}`, {
            method: 'POST',
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                taskid,
                name,
                description,
                date
            })


        })
            .then(data => {
                return data.json()
            })
            .then(json => {
                let alertDiv = document.getElementById('alert-div')
                let alertText = document.getElementById('alert-text')
                if (json.bool) {
                    currentNameTaskEditing.innerHTML = name
                    alertDiv.classList.toggle('d-none')
                    alertDiv.classList.add('alert-success')
                    alertText.innerHTML = json.msg
                    setTimeout(() => {
                        alertDiv.classList.toggle('d-none')
                    }, 1500)
                } else {
                    alertDiv.classList.toggle('d-none')
                    alertDiv.classList.add('alert-error')
                    alertText.innerHTML = json.msg
                    setTimeout(() => {
                        alertDiv.classList.toggle('d-none')
                    }, 1500)
                }

            })
    }
}