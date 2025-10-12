<?php
// controllers/auth_controller.php

require_once __DIR__ . '/../config/database.php';

/**
 * Registra um novo usuário no banco de dados.
 */
function handle_register($pdo) {
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $cpf = trim($_POST['cpf'] ?? '');
        $telefone = trim($_POST['telefone'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $tipo = $_POST['tipo'] ?? 'aluno'; // 'aluno' ou 'professor'

        // Validação simples
        if (empty($nome) || empty($email) || empty($senha) || empty($cpf)) {
            $error = "Todos os campos são obrigatórios!";
        } else {
            // Verifica se o email ou nome já existem
            $stmt = $pdo->prepare("SELECT id FROM usuario WHERE nome = ? OR email = ?");
            $stmt->execute([$nome, $email]);
            if ($stmt->fetch()) {
                $error = "Nome de usuário ou e-mail já cadastrado!";
            } else {
                // Hash da senha
                $hashed_senha = password_hash($senha, PASSWORD_DEFAULT);

                // Insere no banco de dados
                $stmt = $pdo->prepare("INSERT INTO usuario (nome, email, cpf, telefone, senha, tipo) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$nome, $email, $cpf, $telefone, $hashed_senha, $tipo]);
                
                // Redireciona para a página de login após o sucesso
                header("Location: /login");
                exit();
            }
        }
    }
    return $error;
}


/**
 * Autentica um usuário.
 */
function handle_login($pdo) {
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (empty($nome) || empty($senha)) {
            $error = "Nome e senha são obrigatórios.";
        } else {
            // Busca o usuário pelo nome
            $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nome = ?");
            $stmt->execute([$nome]);
            $user = $stmt->fetch();

            // Verifica se o usuário existe e a senha está correta
            if ($user && password_verify($senha, $user['senha'])) {
                // Inicia a sessão
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_nome'] = $user['nome'];
                $_SESSION['tipo'] = $user['tipo'];
 
                // Redireciona com base no tipo de usuário
                if ($user['tipo'] === 'professor') {
                    header("Location: /main-professor");
                } else {
                    header("Location: /main-aluno");
                }
                exit();
            } else {
                $error = "Nome de usuário ou senha inválidos.";
            }
        }
    }
    return $error;
}
?>