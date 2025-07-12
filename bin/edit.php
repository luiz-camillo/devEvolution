<?php
// 1) Carrega o autoload do Composer, para usar nossas classes
require_once __DIR__ . '/../vendor/autoload.php';

use App\Curso\Task\TaskRepo;
use App\Curso\Task\Task;

// 2) Pega o ID via GET (int) ou zero se não vier
$id = intval($_GET['id'] ?? 0);

// 3) Instancia o repositório e busca a tarefa
$repo = new TaskRepo();
$data = $repo->find($id);

// 4) Se não encontrar a tarefa, redireciona para a lista
if ($data === null) {
    header('Location: list.php');
    exit;
}

// 5) Se o método for POST, processa a atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 5.1) Pega e limpa os dados do formulário
    $nome       = trim($_POST['nome']);
    $descricao  = trim($_POST['descricao']);
    $prioridade = $_POST['prioridade'];

    // 5.2) Cria o objeto Task incluindo o ID existente
    $task = new Task($nome, $descricao, $prioridade, $id);

    // 5.3) Chama o update no repositório
    $repo->update($task);

    // 5.4) Volta para a lista de tarefas
    header('Location: list.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
</head>
<body>
    <!-- 6) Link para voltar sem editar -->
    <a href="list.php">← Voltar à lista</a>
    <h2>Editar Tarefa #<?= $id ?></h2>

    <!-- 7) Formulário preenchido com os dados atuais -->
    <form method="post" action="">
        <label>Nome:</label><br>
        <input 
            type="text" 
            name="nome" 
            required 
            value="<?= htmlspecialchars($data['nome']) ?>"
        ><br><br>

        <label>Descrição:</label><br>
        <input 
            type="text" 
            name="descricao" 
            value="<?= htmlspecialchars($data['descricao']) ?>"
        ><br><br>

        <label>Prioridade:</label><br>
        <select name="prioridade" required>
            <?php
            // 7.1) Gera as opções e marca a atual como selected
            foreach (['baixa','media','alta'] as $p): 
                $sel = $data['prioridade'] === $p ? 'selected' : '';
            ?>
                <option value="<?= $p ?>" <?= $sel ?>>
                    <?= ucfirst($p) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
