<?php
$title = 'Página do Aluno';
require_once __DIR__ . '/partials/header.php';
?>

<h1 class="text-3xl text-white font-bold">
    Página do Aluno
</h1>
<p>Bem-vindo, <?= htmlspecialchars($_SESSION['user_nome']) ?>!</p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>