<?php
// 1) Carrega o autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php';

use App\Curso\Task\TaskRepo;

// 2) Instancia o repositório e busca todas as tarefas
$repo  = new TaskRepo();
$tasks = $repo->all();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listar Tarefas</title>
</head>
<body>

    <!-- 3) Botão para voltar à home -->
    <a href="home.php">← Voltar</a>
    <h2>Lista de Tarefas</h2>

    <!-- 4) Monta uma tabela HTML com cabeçalhos -->
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Prioridade</th>
            <th>Ações</th>
        </tr>

        <!-- 5) Loop pelas tarefas retornadas -->
        <?php foreach ($tasks as $t): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= htmlspecialchars($t['nome']) ?></td>
            <td><?= htmlspecialchars($t['descricao']) ?></td>
            <td><?= htmlspecialchars($t['prioridade']) ?></td>
            <td>
                <!-- 6) Link para editar (GET) -->
                <a href="edit.php?id=<?= $t['id'] ?>">Editar</a>
                <!-- 7) Formulário para excluir (POST) -->
                <form action="delete.php" method="post" style="display:inline">
                    <input type="hidden" name="id" value="<?= $t['id'] ?>">
                    <button type="submit" onclick="return confirm('Confirma exclusão?')">Excluir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
