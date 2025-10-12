<?php
$title = 'Minhas Presenças';
require_once __DIR__ . '/partials/header.php';

// Inclui o arquivo que contém as classes do modelo (Turma, Aula, Presenca, etc.)
require_once __DIR__ . '/../config/models.php';

// Garante que o usuário está logado e é um aluno antes de prosseguir
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'aluno') {
    // A função redirect() deve estar definida em algum lugar (ex: utils/functions.php)
    // Se não estiver, use: header('Location: /login'); exit();
    redirect('/login');
}

// Lógica para buscar presenças do aluno do banco de dados
$id_aluno = $_SESSION['id'];
$presencas = Presenca::listarPorAluno($id_aluno);
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl text-white font-bold">Minhas Presenças</h1>
    <a href="/main-aluno" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">&larr; Voltar</a>
</div>

<div class="overflow-x-auto bg-gray-900/50 rounded-lg">
    <table class="w-full text-left text-gray-300">
        <thead class="bg-gray-700 text-sm uppercase">
            <tr>
                <th class="px-6 py-3">Turma</th>
                <th class="px-6 py-3">Aula</th>
                <th class="px-6 py-3">Data</th>
                <th class="px-6 py-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($presencas)): ?>
                <tr class="border-t border-gray-700">
                    <td colspan="4" class="text-center px-6 py-4 text-gray-400">Nenhum registro de presença encontrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach($presencas as $p): ?>
                <tr class="border-t border-gray-700 hover:bg-gray-700/50">
                    <td class="px-6 py-4 font-medium"><?= htmlspecialchars($p["turma"]) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars($p["titulo"]) ?></td>
                    <td class="px-6 py-4"><?= htmlspecialchars(date("d/m/Y", strtotime($p["data"]))) ?></td>
                    <td class="px-6 py-4 text-center">
                        <?php if ($p["presente"]): ?>
                            <span class="bg-green-500/20 text-green-300 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">Presente</span>
                        <?php else: ?>
                            <span class="bg-red-500/20 text-red-300 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">Falta</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

