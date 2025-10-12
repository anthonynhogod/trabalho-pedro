<?php
$title = 'Criar Conta';
require_once __DIR__ . '/partials/header.php';
?>

<div class="w-full max-w-md mx-auto bg-gray-800 rounded-xl shadow-lg p-8 space-y-6">
    
    <div class="text-center">
        <h2 class="text-2xl font-bold text-white">Crie sua Conta</h2>
        <p class="mt-2 text-sm text-gray-400">
            Já tem uma? <a href="/login" class="font-medium text-blue-500 hover:text-blue-400">Faça login</a>
        </p>
    </div>

    <div class="flex border-b border-gray-700">
        <button id="tab-aluno" class="flex-1 py-2 text-center font-semibold border-b-2 border-blue-500 text-blue-500 transition-colors duration-300">
            Sou Aluno
        </button>
        <button id="tab-professor" class="flex-1 py-2 text-center font-semibold text-gray-400 border-b-2 border-transparent transition-colors duration-300">
            Sou Professor
        </button>
    </div>

    <?php if (isset($error) && $error): ?>
    <div class="bg-red-500/10 border border-red-500/30 text-red-300 px-4 py-3 rounded-lg text-center text-sm">
        <span><?= htmlspecialchars($error) ?></span>
    </div>
    <?php endif; ?>

    <form class="space-y-4" method="post" action="/register">
        <input type="hidden" name="tipo" id="tipo-conta" value="aluno">

        <div>
            <input type="text" name="nome" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nome Completo">
        </div>
        <div>
            <input type="email" name="email" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="E-mail">
        </div>
        <div>
            <input type="text" name="cpf" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="CPF">
        </div>
        <div>
            <input type="tel" name="telefone" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Telefone">
        </div>
        <div>
            <input type="password" name="senha" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Senha">
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg cursor-pointer transition-colors duration-300">
                Criar Conta
            </button>
        </div>
    </form>
</div>

<script>
    // O JavaScript permanece o mesmo, pois é executado no lado do cliente.
    const tabAluno = document.getElementById('tab-aluno');
    const tabProfessor = document.getElementById('tab-professor');
    const tipoContaInput = document.getElementById('tipo-conta');

    tabAluno.addEventListener('click', () => {
        tipoContaInput.value = 'aluno';
        tabAluno.classList.add('border-blue-500', 'text-blue-500');
        tabAluno.classList.remove('border-transparent', 'text-gray-400');
        tabProfessor.classList.add('border-transparent', 'text-gray-400');
        tabProfessor.classList.remove('border-blue-500', 'text-blue-500');
    });

    tabProfessor.addEventListener('click', () => {
        tipoContaInput.value = 'professor';
        tabProfessor.classList.add('border-blue-500', 'text-blue-500');
        tabProfessor.classList.remove('border-transparent', 'text-gray-400');
        tabAluno.classList.add('border-transparent', 'text-gray-400');
        tabAluno.classList.remove('border-blue-500', 'text-blue-500');
    });
</script>

<?php require_once __DIR__ . '/partials/footer.php'; ?>