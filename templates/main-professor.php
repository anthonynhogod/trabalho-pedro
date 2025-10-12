<?php
$title = 'Painel do Professor';
require_once __DIR__ . '/partials/header.php';
?>

<div class="text-center">
    <h1 class="text-3xl text-white font-bold">Painel do Professor</h1>
    <p class="mt-2 text-gray-400">Bem-vindo(a), Professor(a) <?= htmlspecialchars($_SESSION['user_nome']) ?>!</p>
</div>

<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="/turmas" class="block bg-gray-700 hover:bg-gray-600 p-6 rounded-lg text-center transition-colors duration-300">
        <h2 class="text-xl font-semibold text-white">Gerenciar Turmas</h2>
        <p class="mt-2 text-gray-400">Crie e administre suas turmas e alunos.</p>
    </a>
    <a href="/aulas" class="block bg-gray-700 hover:bg-gray-600 p-6 rounded-lg text-center transition-colors duration-300">
        <h2 class="text-xl font-semibold text-white">Gerenciar Aulas</h2>
        <p class="mt-2 text-gray-400">Cadastre novas aulas para suas turmas.</p>
    </a>
    <a href="/presencas" class="block bg-gray-700 hover:bg-gray-600 p-6 rounded-lg text-center transition-colors duration-300">
        <h2 class="text-xl font-semibold text-white">Marcar Presenças</h2>
        <p class="mt-2 text-gray-400">Realize a chamada para cada aula.</p>
    </a>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
