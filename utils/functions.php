<?php
// utils/functions.php

// Inicia a sessão em todas as páginas que incluírem este arquivo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Redireciona para uma URL.
 * @param string $url A URL para redirecionar.
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Verifica se o usuário está logado. Se não, redireciona para a página de login.
 */
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        redirect('/login');
    }
}
?>