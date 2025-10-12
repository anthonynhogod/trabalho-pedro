<?php
require_once "../config/models.php";

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] !== "professor") {
    header("Location: /login");
    exit;
}

if (!isset($_GET["id"])) {
    header("Location: turmas");
    exit;
}

$id_turma = (int)$_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["add_aluno"])) {
        TurmaAluno::adicionar($id_turma, $_POST["aluno_id"]);
    } elseif (isset($_POST["remove_aluno"])) {
        TurmaAluno::remover($id_turma, $_POST["aluno_id"]);
    }
}

$turma = Turma::listarPorProfessor($_SESSION["id"]);
$alunos_disponiveis = TurmaAluno::listarAlunos();
$alunos_turma = TurmaAluno::listarPorTurma($id_turma);
?>
<?php
$title = 'Gerenciar Alunos da Turma';
require_once __DIR__ . '/partials/header.php';
// Lógica para buscar detalhes da turma e alunos deve ser chamada aqui
$id_turma = 1; // Exemplo
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl text-white font-bold">Gerenciar Turma #<?= $id_turma ?></h1>
    <a href="/turmas" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">&larr; Voltar para Turmas</a>
</div>

<div class="bg-gray-900/50 p-6 rounded-lg mb-8">
    <h2 class="text-xl font-semibold text-white mb-4">Adicionar Aluno à Turma</h2>
    <form method="post" class="flex items-end gap-4">
        <div class="flex-grow">
            <label for="aluno_id" class="block mb-2 text-sm font-medium text-gray-300">Selecione o Aluno</label>
            <select name="aluno_id" id="aluno_id" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">Selecione...</option>
                <?php  foreach ($alunos_disponiveis as $al):  ?>
                <option value="<?php echo $al['id']?>"><?php echo htmlspecialchars($al['nome']) ?></option>
                <?php  endforeach;  ?>
            </select>
        </div>
        <button type="submit" name="add_aluno" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 h-[50px]">Adicionar</button>
    </form>
</div>

<h2 class="text-xl font-semibold text-white mb-4">Alunos na Turma</h2>
<div class="overflow-x-auto bg-gray-900/50 rounded-lg">
    <table class="w-full text-left text-gray-300">
        <thead class="bg-gray-700 text-sm uppercase">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nome do Aluno</th>
                <th class="px-6 py-3 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos_turma as $a): ?>
            <tr class="border-t border-gray-700 hover:bg-gray-700/50">
                <td class="px-6 py-4"><?php echo $a["id"]?></td>
                <td class="px-6 py-4 font-medium"><?php  echo htmlspecialchars($a["nome"]) ?></td>
                <td class="px-6 py-4 text-center">
                    <form method="post" class="inline">
                        <input type="hidden" name="aluno_id" value="<?php echo $a['id'] ?>">
                        <button type="submit" name="remove_aluno" class="font-medium text-red-500 hover:text-red-400">Remover</button>
                    </form>
                </td>
            </tr>
            <?php  endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
