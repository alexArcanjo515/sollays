<?php
// Incluir arquivo de inicialização
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
} else {
    session_start();
}

header('Content-Type: application/json');

// Verificar se o usuário está logado
if (!$usuario_logado) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não autenticado - usuario_logado é falso']);
    exit;
}

// Verificar se produto_id foi enviado
if (!isset($_POST['produto_id'])) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Produto ID não fornecido']);
    exit;
}

// Definir variáveis
$produto_id = (int)$_POST['produto_id'];
$usuario_id_atual = (int)$usuario_id;
$mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';

try {
    // Verificar se conexão existe
    if (!$conexao) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro: Sem conexão com banco de dados']);
        exit;
    }

    // Preparar query para inserir a solicitação
    $query = "INSERT INTO solicitacoes_preco (usuario_id, produto_id, categoria, mensagem) 
              VALUES (?, ?, 'painel', ?)";
    
    $stmt = $conexao->prepare($query);
    
    if (!$stmt) {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao preparar query']);
        exit;
    }
    
    // Bind parameters
    $stmt->bind_param("iis", $usuario_id_atual, $produto_id, $mensagem);
    
    // Executar
    if ($stmt->execute()) {
        echo json_encode(['sucesso' => true, 'mensagem' => 'Solicitação enviada com sucesso!']);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao salvar solicitação']);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao processar solicitação']);
} finally {
    // A conexão será fechada automaticamente
}
?>
