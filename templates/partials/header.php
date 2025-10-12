<?php
// Garante que a sessão está iniciada em todas as páginas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Sistema de Gestão' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white antialiased">
    <header class="bg-gray-800 shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-white hover:text-blue-400 transition-colors">MAPA AUTOMATION</a>
            <div class="flex items-center space-x-6">
                <?php if (isset($_SESSION['id'])): ?>
                    <?php if ($_SESSION['tipo'] === 'aluno'): ?>
                         <a href="/main-aluno" class="text-gray-300 hover:text-white transition-colors duration-300">Painel</a>
                    <?php else: ?>
                         <a href="/main-professor" class="text-gray-300 hover:text-white transition-colors duration-300">Painel</a>
                    <?php endif; ?>
                    <a href="/logout" class="text-gray-300 hover:text-white transition-colors duration-300">Sair</a>
                <?php else: ?>
                    <a href="/register" class="text-gray-300 hover:text-white transition-colors duration-300">Registrar</a>
                    <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-300">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="container mx-auto py-12 px-4">
        <!-- O contêiner do conteúdo é aberto aqui e fechado no footer -->
        <div class="w-full max-w-5xl mx-auto bg-gray-800 rounded-xl shadow-lg p-8 space-y-8">
