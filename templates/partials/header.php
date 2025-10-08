<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= $title ?? 'Meu Projeto' ?></title>
    <style>
        body { background-color: #111827; }
    </style>
</head>
<body class="text-gray-200">
    <nav class="bg-gray-800 p-4 mb-8">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-white text-xl font-bold">Logo</a>
            <div class="flex space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/logout" class="text-gray-300 hover:text-white">Logout</a>
                <?php else: ?>
                    <a href="/sobre" class="text-gray-300 hover:text-white">Sobre</a>
                    <a href="/register" class="text-gray-300 hover:text-white">Registrar</a>
                    <a href="/login" class="text-gray-300 hover:text-white">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        <?= $content ?? '' ?>
    </main>
</body>
</html>
