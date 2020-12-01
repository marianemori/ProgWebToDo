<?php
include_once '../model/task.php';

$task = new Task();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'POST':
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        extract(get_object_vars($data));
        try {
            $data = $task->updateTask($taskid, $name, $description, $date);
            header('Content-Type: application/json');
            echo json_encode(array("bool"=>true, "msg"=>"Atualizado com sucesso"));
        } catch (\Exception $err) {
            echo json_encode(array("bool"=>false, "msg"=>"Erro ao tentar atualizar"));
        }
    break;

    case 'GET':
        $id = $_GET['taskId'];
        $data = $task->getById($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    break;
}
