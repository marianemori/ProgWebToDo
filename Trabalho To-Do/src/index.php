<?php
include_once './model/task.php';

try {
    $task = new Task();
    $tarefas = $task->listAll();

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            switch ($_POST['action']) {
                case 'CREATE':
                    $task->createNewTask();
                    header('Location: /index.php');
                    break;
                case 'DELETE':
                    $id = $_POST['id'];
                    $task->deleteTask($id);
                    header('Location: /index.php');
                    break;
                case 'COMPLETE':
                    $id = $_POST['id'];
                    $value = $_POST['value'];
                    $task->completeTask($id, $value);
                    header('Location: /index.php');
                    break;
            }

            break;
    }
} catch (\Throwable $th) {
    echo $th;
    die(1);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do</title>
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
                    <h1>Minhas Tarefas</h1>
                </div>

                <form method="POST">
                    <div>
                        <input type="hidden" name="action" value="CREATE">
                        <button type="submit"> + adicionar tarefa </button>
                    </div>
                </form>

                <div id="container-tarefas" class="container-tarefas">
                    <?php foreach ($tarefas as $tarefa) { ?>

                        <?php if ($tarefa['concluida'] == 'false') { ?>

                            <div class="tarefa mb-1" data-taskid="<?= $tarefa['id'] ?>">
                                <div class="">
                                    <form method="POST">
                                        <input type="hidden" name="action" value="COMPLETE">
                                        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                                        <input type="hidden" name="value" value="true">
                                        <input type="image" src="./public/assets/tasks.png" height="28" width="28" alt="">
                                    </form>
                                    <p><?= $tarefa['nome'] ?></p>
                                </div>
                                <div class="mr-2">
                                    <img class="cursor-pointer mr-2" onclick="showMenu('edit')" src="./public/assets/editBtn.png" height="22" width="22" alt="Editar">
                                    <form method="POST">
                                        <input type="hidden" name="action" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                                        <input type="image" class="cursor-pointer" src="./public/assets/deleteBtn.png" height="23" width="23" alt="Deletar">

                                    </form>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                </div>
            </section>


            <section class="tarefas-concluidas">
                <div>
                    <h1>Tarefas Concluídas</h1>
                </div>


                <div class="container-concluida" id="container-concluida">

                    <?php foreach ($tarefas as $tarefa) { ?>

                        <?php if ($tarefa['concluida'] == 'true') { ?>

                            <div class="tarefa mb-1" data-taskid="<?= $tarefa['id'] ?>">
                                <div class="">
                                    <form method="POST">
                                        <input type="hidden" name="action" value="COMPLETE">
                                        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                                        <input type="hidden" name="value" value="false">
                                        <input type="image" <?php if ($tarefa['concluida'] == 'true') { ?> src="./public/assets/done.png" height="28" width="28" alt="">
                                    <?php } ?>

                                    </form>
                                    <p><?= $tarefa['nome'] ?></p>
                                </div>
                                <div class="mr-2">
                                    <img class="cursor-pointer mr-2" onclick="showMenu('edit')" src="./public/assets/editBtn.png" height="22" width="22" alt="Editar">
                                    <form method="POST">
                                        <input type="hidden" name="action" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                                        <input type="image" class="cursor-pointer" src="./public/assets/deleteBtn.png" height="23" width="23" alt="Deletar">
                                    </form>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                </div>
            </section>
        </div>

        <div id="edit" class="editar-tarefa d-none">

        </div>
    </div>
    
    <script src="./public/js/script.js"></script>
</body>


</html>