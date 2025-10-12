<?php
session_start();
require_once "../config/models.php";
if ($_SESSION["tipo"] !== "professor") { header("Location: index.php"); exit; }

$id_professor = $_SESSION["id"];
$turmas = Turma::listarPorProfessor($id_professor);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    Aula::criar($_POST["turma"], $_POST["titulo"], $_POST["data"]);
}

?>
<?php
$title = 'Gerenciar Aulas';
require_once __DIR__ . '/partials/header.php';
// Lógica para buscar turmas e criar aulas deve ser chamada aqui
?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl text-white font-bold">Criar Nova Aula</h1>
    <a href="/main-professor" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">&larr; Voltar</a>
</div>

<form method="post" class="space-y-6 bg-gray-900/50 p-6 rounded-lg">
    <div>
        <label for="turma" class="block mb-2 text-sm font-medium text-gray-300">Turma</label>
        <select name="turma" id="turma" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="">Selecione a turma</option>
            <?php  foreach($turmas as $t):  ?>
            <option value="<?php  echo $t['id']  ?>"><?php  echo htmlspecialchars($t['nome'])  ?></option>
            <?php  endforeach;  ?>
        </select>
    </div>
    <div>
        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-300">Título da Aula</label>
        <input type="text" name="titulo" id="titulo" placeholder="Ex: Introdução a Padrões de Projeto" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>
    <div>
        <label for="data" class="block mb-2 text-sm font-medium text-gray-300">Data da Aula</label>
        <input type="date" name="data" id="data" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>
    <div class="pt-2">
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
            Salvar Aula
        </button>
    </div>
</form>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
