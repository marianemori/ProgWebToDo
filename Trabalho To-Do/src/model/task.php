<?php
include_once 'database.php';

class Task
{

    public function __construct($db_path = false)
    {
        // cria o schema do banco de dados
        if ($db_path) {
        } else {
            try {
                Database::createSchema();
                $this->db = Database::getInstance();
            } catch (\Exception $err) {
                print $err->getMessage();
            }
        }
    }


    /**
     * Função que retorna a lista completa de tarefas do banco de dados
     * @return Array
     */
    public function listAll()
    {
        // Realiza a consulta ao banco e retorna o resultado
        $data = $this->db->query('SELECT id ,nome, descricao, strftime("%d/%m/%Y", data_tarefa) as data_tarefa, concluida FROM tarefas ORDER BY data_tarefa DESC')->fetchAll();
        return $data;
    }


    /**
     * Função que retorna uma tarefa baseada no id da mesma
     * @return 
     */
    public function getById($id)
    {
        try {
            // Pepara e executa a consulta, depois retorna o valor de uma unica tarefa
            $stm = $this->db->prepare('SELECT id ,nome, descricao, strftime("%Y-%m-%d", data_tarefa) as data_tarefa, concluida FROM tarefas WHERE id = :id');
            $stm->bindParam(':id', $id);
            $stm->execute();
            $data = $stm->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (\Exception $err) {
            $err->getMessage();
        }
    }

    /**
     * Cria uma nova tarefa com os valores padrões
     * @return bool
     */
    public function createNewTask()
    {
        try {
            // Pepara e executa a consulta para inserir a tarefa
            $stm = $this->db->prepare('INSERT INTO tarefas (nome, descricao, concluida) VALUES (:nome, :descricao, :concluida)');
            $stm->execute(array(':nome' => 'Nova Tarefa', ':descricao' => 'Insira uma descrição.', ':concluida' => 'false'));
            return true;
        } catch (\Exception $err) {
            $err->getMessage();
            return false;
        }
    }

    /**
     * Deleta a tarefa
     * @return bool
     */
    public function deleteTask($id)
    {
        try {
            // Pepara e executa a consulta para delete a tarefa com id passado no parametro
            $stm = $this->db->prepare('DELETE FROM tarefas WHERE id = :id');
            $stm->execute(array(':id' => $id));
            return true;
        } catch (\Exception $err) {
            $err->getMessage();
            return false;
        }
    }

    /**
     * Faz a atualização das informações da tarefa
     * @return bool
     */
    public function updateTask($id, $name, $description, $date)
    {
        try {
            // Pepara e executa a consulta para inserir a tarefa
            $stm = $this->db->prepare('UPDATE tarefas SET nome = :nome, descricao = :descricao, data_tarefa = :data_tarefa WHERE id = :id');
            $stm->execute(array(':nome' => $name, ':descricao' => $description, ':data_tarefa' => $date, ':id' => $id));
            return true;
        } catch (\Exception $err) {
            throw new Error('Algo deu errado com método update');
            $err->getMessage();
            echo $err->getMessage();
            return false;
        }
    }


    /**
     * Muda o atribudo 'concluida' da tarefa para true, dessa forma a mesma será dada como concluida
     * @return bool
     */
    public function completeTask($id, $value)
    {
        try {
            // Pepara e executa a consulta para inserir a tarefa
            $stm = $this->db->prepare('UPDATE tarefas SET concluida = :value WHERE id = :id');
            $stm->execute(array(':id' => $id, 'value'=> $value));
            return true;
        } catch (\Exception $err) {
            $err->getMessage();
            return false;
        }
    }
}
