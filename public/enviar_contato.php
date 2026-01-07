
<?php
// Headers de segurança ANTES de qualquer output
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Incluir arquivo de inicialização DEPOIS dos headers
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
}

// Verificar método HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['sucesso' => false, 'msg' => 'Método não permitido.']);
    exit;
}

// Verificar conexão
if (!isset($conexao) || $conexao === null) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao conectar ao banco de dados.']);
    exit;
}

// Rate limiting por IP (máximo 5 mensagens por hora)
$ip_atual = $_SERVER['REMOTE_ADDR'] ?? 'desconhecido';
$stmt_check = $conexao->prepare("SELECT COUNT(*) as total FROM mensagens_contato WHERE ip = ? AND data_envio > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
if ($stmt_check) {
    $stmt_check->bind_param('s', $ip_atual);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();
    if ($row['total'] >= 5) {
        http_response_code(429);
        echo json_encode(['sucesso' => false, 'msg' => 'Limite de mensagens excedido. Tente novamente mais tarde.']);
        $stmt_check->close();
        exit;
    }
    $stmt_check->close();
}

// Sanitização e validação rigorosa
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$assunto = isset($_POST['assunto']) ? trim($_POST['assunto']) : '';
$mensagem = isset($_POST['mensagem']) ? trim($_POST['mensagem']) : '';
$user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 500);

// Remover scripts maliciosos e tags HTML
$nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$assunto = htmlspecialchars($assunto, ENT_QUOTES, 'UTF-8');
$mensagem = htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8');

// Validações rigorosas
$erros = [];

if (empty($nome)) {
    $erros[] = 'Nome é obrigatório';
} elseif (strlen($nome) < 3 || strlen($nome) > 100) {
    $erros[] = 'Nome deve ter entre 3 e 100 caracteres';
}

if (empty($email)) {
    $erros[] = 'E-mail é obrigatório';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'E-mail inválido';
} elseif (strlen($email) > 100) {
    $erros[] = 'E-mail muito longo';
}

if (empty($assunto)) {
    $erros[] = 'Assunto é obrigatório';
} elseif (strlen($assunto) < 5 || strlen($assunto) > 200) {
    $erros[] = 'Assunto deve ter entre 5 e 200 caracteres';
}

if (empty($mensagem)) {
    $erros[] = 'Mensagem é obrigatória';
} elseif (strlen($mensagem) < 10 || strlen($mensagem) > 5000) {
    $erros[] = 'Mensagem deve ter entre 10 e 5000 caracteres';
}

// Verificar conteúdo suspeito ANTES de sanitizar (para detectar tentativas)
$conteudo_bruto = (isset($_POST['nome']) ? $_POST['nome'] : '') . 
                  (isset($_POST['email']) ? $_POST['email'] : '') . 
                  (isset($_POST['assunto']) ? $_POST['assunto'] : '') . 
                  (isset($_POST['mensagem']) ? $_POST['mensagem'] : '');
                  
$conteudo_suspeito = preg_match('/(<script|javascript:|onerror|onclick|onload|eval\(|base64|alert\(|confirm\(|prompt\()/i', $conteudo_bruto);
if ($conteudo_suspeito) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'msg' => 'Conteúdo inválido detectado.']);
    exit;
}

// Retornar erros se houver
if (!empty($erros)) {
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'msg' => implode('; ', $erros)]);
    exit;
}

// Inserir na tabela com prepared statement (7 parâmetros)
$status = 'não lido';
$stmt = $conexao->prepare("INSERT INTO mensagens_contato (nome, email, assunto, mensagem, ip, user_agent, status) VALUES (?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao preparar consulta: ' . $conexao->error]);
    exit;
}

// 7 tipos: s=string (x7)
$stmt->bind_param('sssssss', $nome, $email, $assunto, $mensagem, $ip_atual, $user_agent, $status);

if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(['sucesso' => true, 'msg' => 'Mensagem enviada com sucesso! Responderemos em breve.']);
} else {
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'msg' => 'Erro ao salvar mensagem: ' . $stmt->error]);
}

$stmt->close();
?>