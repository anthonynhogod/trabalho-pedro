<?php
// utils/functions.php

// Inicia a sessão em todas as páginas que incluírem este arquivo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function require_login() {
    // A sessão deve ser iniciada antes de chamar esta função.
    // Garanta que session_start() está no topo do seu index.php.
    if (!isset($_SESSION['id'])) {
        // Se não houver ID de usuário na sessão, redireciona para o login.
        redirect('/login');
        exit();
    }
}

/**
 * Redireciona o usuário para uma URL baseada na rota fornecida.
 * @param string $path O caminho para o qual redirecionar (ex: '/login').
 */
function redirect($path) {
    // Calcula o caminho base da aplicação para funcionar em subdiretórios
    $base_path = rtrim(str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']), '/');
    header("Location: {$base_path}{$path}");
    exit();
}
?>