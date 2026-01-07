<?php
// Arquivo central de configuração e conexão com o banco de dados
// Este arquivo deve ser incluído em todos os outros arquivos PHP que precisem de conexão com BD

// Guard clause - evitar incluir múltiplas vezes
if (defined('BD_CONECTADO')) {
    return;
}
define('BD_CONECTADO', true);

// Configurações do banco de dados
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = 'developer';
$DB_NAME = 'loja';

// Conectar ao banco de dados
$conexao = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

// Verificar se a conexão foi bem sucedida
if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Definir charset
mysqli_set_charset($conexao, "utf8mb4");
?>
