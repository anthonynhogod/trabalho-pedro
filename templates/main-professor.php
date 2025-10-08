<?php
$title = 'Página do Professor';
require_once __DIR__ . '/partials/header.php';
?>

<h1 class="text-3xl text-white font-bold">
    Página do Professor
</h1>
<p>Bem-vindo, Professor(a) <?= htmlspecialchars($_SESSION['user_nome']) ?>!</p>

<?php require_once __DIR__ . '/partials/footer.php'; ?>