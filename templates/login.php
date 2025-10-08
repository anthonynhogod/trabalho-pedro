<?php
$title = 'Login';
require_once __DIR__ . '/partials/header.php';
?>

<div class="w-full max-w-md mx-auto bg-gray-800 rounded-xl shadow-lg p-8 space-y-8">
    
    <div class="text-center">
        <h2 class="text-2xl font-bold text-white">Acesse sua Conta</h2>
        <p class="mt-2 text-sm text-gray-400">
            Ou <a href="/registrar" class="font-medium text-blue-500 hover:text-blue-400">crie uma conta agora</a>
        </p>
    </div>

    <?php if (isset($error) && $error): ?>
    <div class="bg-red-500/10 border border-red-500/30 text-red-300 px-4 py-3 rounded-lg text-center text-sm">
        <span><?= htmlspecialchars($error) ?></span>
    </div>
    <?php endif; ?>

    <form class="space-y-6" method="post" action="/login">
        <div class="space-y-4">
            <div>
                <input id="nome" name="nome" type="text" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nome de usuário">
            </div>
            <div>
                <input id="senha" name="senha" type="password" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Senha">
            </div>
        </div>

        <div class="flex items-center justify-end text-sm">
            <a href="#" class="font-medium text-blue-500 hover:text-blue-400">
                Esqueceu sua senha?
            </a>
        </div>

        <div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg cursor-pointer transition-colors duration-300">
                Entrar
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>