<?php
     
     //TODO ?
     
     ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas listas</title>
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
            <section class="minhas-tarefas">
                <div class="tarefa-title">
                    <h1>Minhas Listas</h1>
                </div>
                <div class="add-tarefa">
                    <p> + Adicionar Lista </p>
                </div>
                <div class="tarefa lista p-2">
                    <input type="text" value="Lista 01" disabled></input>
                    <img class="" onclick="editNomeLista()" src="assets/editBtn.png" height="20" width="20" alt="Editar ">
                </div>
            </section>

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



</body>
<script src="script.js"></script>

</html>
