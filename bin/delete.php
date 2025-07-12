<?php
// 1) Carrega o autoload do Composer para carregamento das classes
require_once __DIR__ . '/../vendor/autoload.php';

use App\Curso\Task\TaskRepo;

// 2) Verifica se o request é POST — só excluímos via POST para maior segurança
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 3) Pega o ID do formulário e garante que seja inteiro
    $id = intval($_POST['id'] ?? 0);

    // 4) Instancia o repositório
    $repo = new TaskRepo();

    // 5) Chama o método delete para remover do banco
    $repo->delete($id);
}

// 6) Após excluir (ou se não for POST), redireciona sempre para a lista
header('Location: list.php');
exit;
