<?php

//TODO ?

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas listas</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/tags.css">
    <link rel="stylesheet" href="./public/css/utils.css">
</head>

<body>
    <?php require('./templates/header.php') ?>

    <div class="main">
        <?php require('./templates/nav-bar.php') ?>

        <div class="container">
            <section class="minhas-tarefas">
                <div class="tarefa-title">
                    <h1>Minhas Listas</h1>
                </div>
                <form method="POST">
                    <div>
                        <input type="hidden" name="action" value="CREATE">
                        <button type="submit"> + adicionar lista </button>
                    </div>
                </form>
                <div class="tarefa mb-1" data-taskid="RObson">
                    <div class="">
                        <form method="POST">
                            <input type="hidden" name="id" value="RObson">
                        </form>
                        <p>Nova Lista</p>
                    </div>
                    <div class="mr-2">
                        <img class="cursor-pointer mr-2" onclick="showMenu('edit')" src="./public/assets/editBtn.png" height="22" width="22" alt="Editar">
                        <form method="POST">
                            <input type="hidden" name="action" value="">
                            <input type="hidden" name="id" value="RObson">
               
                        </form>
                    </div>
                </div>
            </section>


</body>
<script src="./public/js/script.js"></script>

</html>