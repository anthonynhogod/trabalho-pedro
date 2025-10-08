<?php
$title = 'Página Inicial';
require_once __DIR__ . '/partials/header.php';
?>

<h1 class="text-3xl text-white font-bold">
    Página inicial
</h1>
// Debug temporário
<?php
echo "<pre>";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "BASE_PATH: " . $base_path . "\n";
echo "ROUTE: " . $route . "\n";
echo "</pre>";
?>
<?php require_once __DIR__ . '/partials/footer.php'; ?>