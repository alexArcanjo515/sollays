<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['usuario_id'], $_POST['produto_id'])) {
    echo json_encode(['sucesso' => false]);
    exit;
}
$produto_id = (int)$_POST['produto_id'];
$usuario_id = (int)$_SESSION['usuario_id'];
$email = $_SESSION['usuario_email'];
$mensagem = isset($_POST['mensagem']) ? $_POST['mensagem'] : '';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=loja;charset=utf8mb4', 'usuario', 'senha'); // ajuste usuário/senha
    $stmt = $pdo->prepare("INSERT INTO solicitacoes_preco (usuario_id, produto_id, email, mensagem) VALUES (?, ?, ?, ?)");
    $stmt->execute([$usuario_id, $produto_id, $email, $mensagem]);
    echo json_encode(['sucesso' => true]);
} catch (Exception $e) {
    echo json_encode(['sucesso' => false]);
}