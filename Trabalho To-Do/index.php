<?php
include_once __DIR__ . '/Database.php';

try {
    Database::createSchema(); // cria o schema do banco de dados

    $db = Database::getInstance();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (key_exists('nome', $_POST) && $_POST['nome'] !== '' && key_exists('descricao', $_POST) && $_POST['descricao'] !== '') {
            $stm = $db->prepare('INSERT INTO Tarefas (nome, descricao) VALUES (:nome, :descricao)');
            $stm->execute(array(':nome' => $_POST['nome'], ':descricao' => $_POST['descricao']));
            echo 'Nome inserido com sucesso! <br/><br/>';
            echo 'Descricao atualizada com sucesso! <br/><br/>';
        }

    }

    $usuarios = $db->query('SELECT * FROM Tarefas ORDER BY data_tarefa DESC')->fetchAll();
} catch (\Throwable $th) {
    echo $th;
    die(1);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="tags.css">
    <link rel="stylesheet" href="utils.css">
</head>

<body>
    <header class="cabecalho">
        <div class="menu"> <img onclick="onclickMenu('nav-bar')" class="imagem-menu" src="assets/menu.png" alt="Menu"></div>
        <div class="logo"><img class="imagem-logo" src="assets/logo.png" alt="Logo to-do"></div>
        <div class="pesquisa">
            <img class="imagem-pesquisar" src="assets/pesquisar.png" alt="Pesquisar">
            <input class="pesquisar" placeholder="Pesquisar"></input>
        </div>
    </header>

    <div class="main">
        <div class="navegacao" id="nav-bar">
            <div> <img class="imagem-tarefa" src="assets/tarefas.png" alt="Tarefa">
                <a href="index.php"> </p>Minhas tarefas</p>
                </a>
            </div>
            <div> <img class="imagem-lista" src="assets/listas.png" alt="Listas">
                <a href="lista.php">
                    <p>Minhas listas</p>
                </a>
            </div>
            <div> <img class="imagem-config" src="assets/config.png" alt="Configuração">
                <p>Configurações</p>
            </div>
        </div>

        <div class="container">

        <form method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome">

        <br>

        <label for="nome">Descricao: </label>
        <input type="text" name="descricao" id="descricao">
        <button type="submit">Enviar</button>

        </form>

        <hr>

            <ul> 
                <?php foreach ($tarefas as $tarefa) { ?>
        
                    <li> 
                        <?= $tarefa['id'] ?>: <?= $tarefa['nome'] ?> <?= $tarefa['descricao'] ?> (add em <?= $tarefa['data_tarefa'] ?>
                    </li>

                <?php } ?>    

            </ul>


            <section class="minhas-tarefas">
                <div class="tarefa-title">
                    <h1>Minhas Tarefas</h1>
                </div>
                <div onclick="adicionarTarefas(); " class="add-tarefa"> 
                    <p> + Adicionar Tarefa </p>
                </div>
                <div id="container-tarefas" class="container-tarefas">
                    <div class="tarefa mb-1">
                        <div class="tarefa">
                            <img src="assets/tasks.png" height="28" width="28" alt="" onclick="concluirTarefa()">
                            <p>Nova tarefa</p>
                        </div>
                        <img class="imagem-editar" onclick="onclickMenu('edit') " src="assets/edit.png" height="25 " width="7 " alt="Editar ">
                    </div>

                </div>

            
            </section>

            <section class="tarefas-concluidas">
                <div>
                    <h1>Tarefas Concluídas</h1>
                </div>


                <div class="container-concluida" id="container-concluida">
                    <div class="tarefa-concluida mb-1">
                        <div class="tarefa-concluida ">
                            <img src="assets/done.png " height="28 " width="28 " alt=" ">
                            <p>Tarefa Concluida</p>
                        </div>
                        <img class="imagem-editar" onclick="onclickMenu('edit')" src="assets/edit.png" src="assets/edit.png" height="25 " width="7 " alt="Editar ">
                    </div>
                </div>
            </section>
        </div>

        <div class="editar-tarefa" id="edit">
            <div class="editar-botao ">
                <input type="text" id="edicao" value="Nome da tarefa" class="titulo-edicao" disabled></input type="text">
                <button class="botao-editar" onclick="edit('edicao') ">Editar</button>
            </div>
            <h2>Descrição</h2>
            <textarea id="edicao" disabled maxlength="410" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet delectus quam dignissimos, exercitationem consequuntur fugiat dolore magni minus ipsam in, cum, enim id quia rem ipsa tempore harum ex! Corporis.
            </textarea>
            <h2>Data</h2>
            <input class="data-edicao" id="edicao" disabled type="date"></input>
        </div>
    </div>

  

</body>
<script src="script.js "></script>

</html>
