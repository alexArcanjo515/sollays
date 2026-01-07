<?php
// Executar SQL para criar tabela de solicitações

$host = 'localhost';
$usuario = 'root';
$senha = 'developer';
$banco = 'loja';

$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// SQL para criar tabela
$sql = "CREATE TABLE IF NOT EXISTS solicitacoes_preco (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    mensagem TEXT,
    data_solicitacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pendente',
    FOREIGN KEY (usuario_id) REFERENCES clientes(id) ON DELETE CASCADE,
    INDEX idx_usuario_id (usuario_id),
    INDEX idx_produto_id (produto_id),
    INDEX idx_data_solicitacao (data_solicitacao)
)";

if (mysqli_query($conexao, $sql)) {
    echo "✓ Tabela 'solicitacoes_preco' criada com sucesso!";
} else {
    echo "Erro ao criar tabela: " . mysqli_error($conexao);
}

mysqli_close($conexao);
?>
