<?php
session_start();
require_once "../config/models.php";

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] !== "professor") {
    header("Location: /login");
    exit;
}

$id_professor = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["nome"])) {
    Turma::criar($_POST["nome"], $id_professor);
}

$turmas = Turma::listarPorProfessor($id_professor);

$title = 'Gerenciar Turmas';
require_once __DIR__ . '/partials/header.php';
// Lógica para buscar e criar turmas deve ser chamada aqui
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl text-white font-bold">Minhas Turmas</h1>
    <a href="/main-professor" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">&larr; Voltar</a>
</div>

<div class="bg-gray-900/50 p-6 rounded-lg mb-8">
    <h2 class="text-xl font-semibold text-white mb-4">Criar Nova Turma</h2>
    <form method="post" class="flex items-end gap-4">
        <div class="flex-grow">
            <label for="nome" class="block mb-2 text-sm font-medium text-gray-300">Nome da Turma</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Engenharia de Software 2024" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 h-[50px]">Criar</button>
    </form>
</div>

<div class="overflow-x-auto bg-gray-900/50 rounded-lg">
    <table class="w-full text-left text-gray-300">
        <thead class="bg-gray-700 text-sm uppercase">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Nome da Turma</th>
                <th class="px-6 py-3 text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach($turmas as $t):  ?>
            <tr class="border-t border-gray-700 hover:bg-gray-700/50">
                <td class="px-6 py-4"><?php  echo $t["id"]  ?></td>
                <td class="px-6 py-4 font-medium"><?php  echo htmlspecialchars($t["nome"])  ?></td>
                <td class="px-6 py-4 text-center">
                    <a href="/turma_detalhes?id=<?php  echo $t["id"]  ?>" class="font-medium text-blue-500 hover:text-blue-400">Gerenciar Alunos</a>
                </td>
            </tr>
            <?php  endforeach;  ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
