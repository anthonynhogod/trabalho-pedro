<?php
session_start();
require_once "../config/models.php";
if ($_SESSION["tipo"] !== "aluno") { header("Location: index.php"); exit; }

$id_aluno = $_SESSION["id"];
$aulas = Aula::listarPorAluno($id_aluno);
?>
<?php
$title = 'Minhas Aulas';
require_once __DIR__ . '/partials/header.php';
// Lógica para buscar aulas do aluno
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl text-white font-bold">Minhas Aulas</h1>
    <a href="/main-aluno" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">&larr; Voltar</a>
</div>

<div class="overflow-x-auto bg-gray-900/50 rounded-lg">
    <table class="w-full text-left text-gray-300">
        <thead class="bg-gray-700 text-sm uppercase">
            <tr>
                <th class="px-6 py-3">Turma</th>
                <th class="px-6 py-3">Título da Aula</th>
                <th class="px-6 py-3">Data</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($aulas)): ?>
                <tr class="border-t border-gray-700">
                    <td colspan="3" class="text-center px-6 py-4 text-gray-400">Nenhuma aula encontrada para você.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($aulas as $a): ?>
                    <tr class="border-t border-gray-700 hover:bg-gray-700/50">
                        <td class="px-6 py-4 font-medium"><?= htmlspecialchars($a["turma"]) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($a["titulo"]) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars(date("d/m/Y", strtotime($a["data"]))) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
