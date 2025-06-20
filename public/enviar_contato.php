
<?php
// Segurança básica
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['sucesso' => false, 'msg' => 'Método não permitido.']);
    exit;
}

// Conexão segura com o banco
$mysqli = new mysqli('localhost', 'root', 'developer', 'loja');
if ($mysqli->connect_errno) {
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao conectar ao banco de dados.']);
    exit;
}

// Sanitização e validação
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$assunto = trim($_POST['assunto'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');
$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

if (
    empty($nome) || empty($email) || empty($assunto) || empty($mensagem) ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    mb_strlen($nome) > 80 || mb_strlen($email) > 120 || mb_strlen($assunto) > 120 || mb_strlen($mensagem) > 1000
) {
    echo json_encode(['sucesso' => false, 'msg' => 'Dados inválidos ou incompletos.']);
    exit;
}

// Previne SQL Injection
$stmt = $mysqli->prepare("INSERT INTO contatos (nome, email, assunto, mensagem, ip, user_agent) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param('ssssss', $nome, $email, $assunto, $mensagem, $ip, $user_agent);

if ($stmt->execute()) {
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao salvar no banco.']);
}
$stmt->close();
$mysqli->close();