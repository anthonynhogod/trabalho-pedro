<?php
// public/index.php

// Inicie a sessão no topo, se ainda não estiver sendo feito em outro lugar
session_start();

// Inclui arquivos essenciais
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/auth_controller.php';
require_once __DIR__ . '/../utils/functions.php';
// --- CÁLCULO DE ROTA CORRIGIDO E SEGURO ---

// 1. Remove parâmetros da URL
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 2. Caminho base (ex: /trabalho_pedro/public)
$script_name = $_SERVER['SCRIPT_NAME'];
$base_path = rtrim(str_replace('/index.php', '', $script_name), '/');

// 3. Remove o caminho base da URI
$route = preg_replace('#^' . preg_quote($base_path) . '#', '', $request_uri);

// 4. Corrige rota vazia
if ($route === '' || $route === false) {
    $route = '/';
} elseif ($route[0] !== '/') {
    $route = '/' . $route;
}

// --- FIM DO CÁLCULO DE ROTA ---

// Sistema de Roteamento Simples
switch ($route) { // *** ATENÇÃO: Agora usa $route em vez de $request_uri ***
    case '/':
        require __DIR__ . '/../templates/index.php';
        break;

    case '/register':
        $error = handle_register($pdo); // Processa o formulário
        require __DIR__ . '/../templates/register.php';
        break;

    case '/login':
        $error = handle_login($pdo); // Processa o login
        require __DIR__ . '/../templates/login.php';
        break;

    case '/main-aluno':
        require_login();
        require __DIR__ . '/../templates/main-aluno.php';
        break;
        
    case '/main-professor':
        require_login();
        require __DIR__ . '/../templates/main-professor.php';
        break;

    case '/logout':
        session_destroy();
        redirect('/login');
        break;
        
    // A Rota '/sobre' no seu nav bar deve ser incluída
    case '/sobre': 
         require __DIR__ . '/../templates/sobre.php';
         break;

    default:
        http_response_code(404);
        echo "Página não encontrada ($route)";
        break;
}
?>