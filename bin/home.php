<?php
// 1) Autoload das classes via Composer
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
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <div style="display: flex; flex-direction: row; justify-content: center; align-items: flex-start; min-height: 90vh;">

        <!-- Coluna esquerda: Formulário de cadastro -->
        <div style="width: 350px; margin-right: 40px;">
            <form method="post" action="create.php">
                <div>
                    <label for="nome">Cadastro nova tarefa</label>
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        placeholder="Nome da tarefa"
                        required
                        style="width:100%; font-size:1em; padding:8px; margin-bottom:10px;"
                    >
                </div>
                <div>
                    <label for="descricao">Informe a descrição da tarefa</label>
                    <input
                        type="text"
                        id="descricao"
                        name="descricao"
                        placeholder="Descrição"
                        required
                        style="width:100%; font-size:1em; padding:8px; margin-bottom:10px;"
                    >
                </div>
                <div>
                    <label for="prioridade">Selecione a prioridade</label>
                    <select
                        id="prioridade"
                        name="prioridade"
                        required
                        style="width:100%; font-size:1em; padding:8px; margin-bottom:10px;"
                    >
                        <option value="baixa">Baixa</option>
                        <option value="media">Média</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
                <div>
                    <button type="submit" style="width:100%; font-size:1em; padding:10px;">
                        CADASTRAR NOVA TAREFA
                    </button>
                </div>
            </form>

            <!-- Mensagem de sucesso -->
            <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
                <div style="margin-top:20px; padding:15px; border:1px solid #222; text-align:center;">
                    TAREFA CADASTRADA COM SUCESSO!
                </div>
            <?php endif; ?>
        </div>

        <!-- Coluna direita: Listagem de tarefas -->
        <div style="width: 400px;">
            <div style="margin-bottom: 20px;">
                <form action="list.php" method="get">
                    <button type="submit" style="width:100%; font-size:1em; padding:10px;">
                        Ver detalhes das tarefas
                    </button><br>
                    <label for="lista">Lista de tarefas:</label>
                </form>
            </div>
            <div style="border:1px solid #222; padding:10px;">
                <?php if (empty($tasks)): ?>
                    <p style="text-align:center;">Ainda não há tarefas cadastradas.</p>
                <?php else: ?>
                    <?php foreach ($tasks as $t): ?>
                        <div style="display:flex; align-items:center; margin-bottom:8px;">
                            <span style="flex:1;"><?= htmlspecialchars($t['nome']) ?></span>
                            <form action="edit.php" method="get" style="margin:0;">
                                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                <button type="submit">editar</button>
                            </form>
                            <form action="delete.php" method="post" style="margin:0; margin-left:4px;">
                                <input type="hidden" name="id" value="<?= $t['id'] ?>">
                                <button type="submit" onclick="return confirm('Confirma exclusão?')">
                                    excluir
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
