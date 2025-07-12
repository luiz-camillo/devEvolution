<?php

namespace App\Curso\Task;

use App\Curso\Database\SqliteConnection;
use PDO;

class TaskRepo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new SqliteConnection())->getConnection();
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS tarefas (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nome TEXT NOT NULL,
                descricao TEXT,
                prioridade TEXT NOT NULL
            )
        ");
    }

    /**
     * Insere uma nova tarefa no banco.
     */
    public function save(Task $task): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO tarefas (nome, descricao, prioridade)
            VALUES (:nome, :descricao, :prioridade)
        ");
        return $stmt->execute([
            ':nome'       => $task->nome,
            ':descricao'  => $task->descricao,
            ':prioridade' => $task->prioridade,
        ]);
    }

    /**
     * 1) Retorna todas as tarefas em ordem decrescente de id.
     */
    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM tarefas ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 2) Busca e retorna uma tarefa pelo seu ID, ou null se não existir.
     */
    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tarefas WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data === false ? null : $data;
    }

    /**
     * 3) Atualiza uma tarefa existente.
     */
    public function update(Task $task): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE tarefas
            SET nome = :nome, descricao = :descricao, prioridade = :prioridade
            WHERE id = :id
        ");
        return $stmt->execute([
            ':nome'       => $task->nome,
            ':descricao'  => $task->descricao,
            ':prioridade' => $task->prioridade,
            ':id'         => $task->id,        // lembre-se de adicionar public $id no Task!
        ]);
    }

    /**
     * 4) Exclui uma tarefa pelo ID.
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM tarefas WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
