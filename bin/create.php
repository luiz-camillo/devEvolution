<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1) Carrega o autoload do Composer para registrar todas as classes via PSR-4
require_once __DIR__ . '/../vendor/autoload.php';

use App\Curso\Task\Task;
use App\Curso\Task\TaskRepo;

// 2) Só processa quando o formulário for enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 3) Lê e "limpa" os valores vindos do form
    $nome       = trim($_POST['nome'] ?? '');
    $descricao  = trim($_POST['descricao'] ?? '');
    $prioridade = $_POST['prioridade'] ?? '';

    // 4) Cria um objeto Task com os dados recebidos
    $task = new Task($nome, $descricao, $prioridade);

    // 5) Instancia o repositório, que já abre a conexão e cria a tabela
    $repo = new TaskRepo();

    // 6) Persiste a tarefa no banco (retorna true ou false)
    $success = $repo->save($task);

    // 7) Redireciona de volta para a home, passando ?sucesso=1 ou ?sucesso=0
    header('Location: home.php?sucesso=' . ($success ? '1' : '0'));
    exit;
}

// 8) Se alguém acessar create.php sem usar POST, volta para a home
header('Location: home.php');
exit;
