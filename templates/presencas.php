<?php
session_start();
require_once "../config/models.php";
if ($_SESSION["tipo"] !== "professor") { header("Location: index"); exit; }

$id_professor = $_SESSION["id"];
$turmas = Turma::listarPorProfessor($id_professor);

$alunos = [];
if (isset($_GET["aula"])) {
    $alunos = Presenca::listarPorAula($_GET["aula"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["presenca"])) {
    foreach ($_POST["presenca"] as $id_aluno => $valor) {
        Presenca::marcar($_POST["id_aula"], $id_aluno, $valor === "1" ? 1 : 0);
    }
    header("Location: presencas?aula=" . $_POST["id_aula"]);
}
?>
<?php
$title = 'Marcar Presenças';
require_once __DIR__ . '/partials/header.php';
// Lógica para buscar aulas, alunos e marcar presenças
$alunos = [['id' => 1, 'nome' => 'João da Silva', 'presente' => true]]; // Exemplo
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl text-white font-bold">Marcar Presenças</h1>
    <a href="/main-professor" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">&larr; Voltar</a>
</div>

<form method="get" class="mb-8 bg-gray-900/50 p-6 rounded-lg">
    <label for="aula" class="block mb-2 text-sm font-medium text-gray-300">Selecione a aula para lançar a presença:</label>
    <select name="aula" id="aula" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
        <option value="">Selecione...</option>
        <option value="1" selected>Eng. de Software - Intro a Padrões de Projeto</option>
    </select>
</form>

<?php if(!empty($alunos)): ?>
<form method="post">
    <input type="hidden" name="id_aula" value="<?= $_GET["aula"] ?? '' ?>">
    <div class="overflow-x-auto bg-gray-900/50 rounded-lg">
        <table class="w-full text-left text-gray-300">
             <thead class="bg-gray-700 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3">Aluno</th>
                    <th class="px-6 py-3 text-center">Presente?</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($alunos as $a): ?>
                <tr class="border-t border-gray-700 hover:bg-gray-700/50">
                    <td class="px-6 py-4 font-medium"><?= htmlspecialchars($a["nome"]) ?></td>
                    <td class="px-6 py-4 text-center">
                        <input type="checkbox" name="presenca[<?= $a["id"] ?>]" value="1" <?= $a["presente"] ? "checked" : "" ?> class="w-5 h-5 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-6">
         <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
            Salvar Presenças
        </button>
    </div>
</form>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
