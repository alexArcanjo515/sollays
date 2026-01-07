<?php
// Arquivo de inicialização - incluir uma única vez no início de cada página
// Este arquivo configura a sessão e define variáveis globais

// Guard clause - evitar incluir múltiplas vezes
if (defined('SOLLAYS_INICIALIZADO')) {
    return;
}
define('SOLLAYS_INICIALIZADO', true);

// Incluir configuração do banco de dados
if (file_exists(__DIR__ . '/../config/database.php')) {
    include_once __DIR__ . '/../config/database.php';
}
if (session_status() === PHP_SESSION_NONE) {
    // Configurar armazenamento de sessão
    ini_set('session.save_path', '/tmp');
    session_start();
}

// Verificar se o usuário está logado
$usuario_logado = false;
$usuario_nome = '';
$usuario_email = '';
$usuario_id = null;

if (isset($_SESSION['usuario_id']) && isset($_SESSION['usuario_nome'])) {
    $usuario_logado = true;
    $usuario_nome = $_SESSION['usuario_nome'];
    $usuario_email = isset($_SESSION['usuario_email']) ? $_SESSION['usuario_email'] : '';
    $usuario_id = $_SESSION['usuario_id'];
}

// Função para logout
if (!function_exists('fazer_logout')) {
    function fazer_logout() {
        $_SESSION = array();
        session_destroy();
        // Redirecionar usando JavaScript para evitar problemas com headers já enviados
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    }
}

// Processar logout se solicitado
if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    fazer_logout();
}
?>
