<?php
$title = 'Painel do Aluno';
require_once __DIR__ . '/partials/header.php';
?>

<div class="text-center">
    <h1 class="text-3xl text-white font-bold">Painel do Aluno</h1>
    <p class="mt-2 text-gray-400">Bem-vindo(a), <?= htmlspecialchars($_SESSION['user_nome']) ?>!</p>
</div>

<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <a href="/aulas-aluno" class="block bg-gray-700 hover:bg-gray-600 p-6 rounded-lg text-center transition-colors duration-300">
        <h2 class="text-xl font-semibold text-white">Ver Minhas Aulas</h2>
        <p class="mt-2 text-gray-400">Acesse o cronograma e os detalhes das suas aulas.</p>
    </a>
    <a href="/presencas-aluno" class="block bg-gray-700 hover:bg-gray-600 p-6 rounded-lg text-center transition-colors duration-300">
        <h2 class="text-xl font-semibold text-white">Minhas Presenças</h2>
        <p class="mt-2 text-gray-400">Consulte seu histórico de presenças e faltas.</p>
    </a>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
