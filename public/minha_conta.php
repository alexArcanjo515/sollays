<?php
// Incluir arquivo de inicialização
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
} else {
    session_start();
}

// Redirecionar para login se não estiver logado
if (!$usuario_logado) {
    header('Location: login.php');
    exit();
}

// Buscar dados do usuário
$query = "SELECT id, username, email, data_criacao FROM clientes WHERE id = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param('i', $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$dados_usuario = $resultado->fetch_assoc();
$stmt->close();

// Buscar solicitações de preço
$query_preco = "SELECT id, produto_id, categoria, mensagem, data_solicitacao, status FROM solicitacoes_preco WHERE usuario_id = ? ORDER BY data_solicitacao DESC";
$stmt_preco = $conexao->prepare($query_preco);
$stmt_preco->bind_param('i', $usuario_id);
$stmt_preco->execute();
$resultado_preco = $stmt_preco->get_result();
$solicitacoes_preco = $resultado_preco->fetch_all(MYSQLI_ASSOC);
$stmt_preco->close();

// Buscar solicitações de cotação (apenas as do email do usuário)
$query_cotacao = "SELECT id, nome, email, telefone, mensagem, produtos_json, data_solicitacao, status FROM solicitacoes_cotacao WHERE email = ? ORDER BY data_solicitacao DESC";
$stmt_cotacao = $conexao->prepare($query_cotacao);
$stmt_cotacao->bind_param('s', $dados_usuario['email']);
$stmt_cotacao->execute();
$resultado_cotacao = $stmt_cotacao->get_result();
$solicitacoes_cotacao = $resultado_cotacao->fetch_all(MYSQLI_ASSOC);
$stmt_cotacao->close();

// Buscar mensagens de contato
$query_mensagens = "SELECT id, assunto, mensagem, data_envio, status, resposta, data_resposta FROM mensagens_contato WHERE email = ? ORDER BY data_envio DESC";
$stmt_mensagens = $conexao->prepare($query_mensagens);
$stmt_mensagens->bind_param('s', $dados_usuario['email']);
$stmt_mensagens->execute();
$resultado_mensagens = $stmt_mensagens->get_result();
$mensagens_contato = $resultado_mensagens->fetch_all(MYSQLI_ASSOC);
$stmt_mensagens->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - Sollays</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f2f5 100%);
            min-height: 100vh;
        }

        .minha-conta-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 15px;
        }

        .header-usuario {
            background: linear-gradient(135deg, #18438f 0%, #0096df 100%);
            color: white;
            padding: 40px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-usuario-info h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            font-weight: 800;
        }

        .header-usuario-info p {
            font-size: 1.1rem;
            margin: 5px 0;
            opacity: 0.95;
        }

        .header-usuario-btn {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-editar {
            background: white;
            color: #18438f;
        }

        .btn-editar:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .btn-sair {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
        }

        .btn-sair:hover {
            background: white;
            color: #18438f;
            transform: translateY(-2px);
        }

        /* Tabs de Navegação */
        .tabs-container {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
            border-bottom: 2px solid #e0e0e0;
        }

        .tab-btn {
            background: white;
            border: none;
            padding: 15px 25px;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
            color: #666;
            font-size: 1rem;
        }

        .tab-btn:hover {
            color: #18438f;
            border-bottom-color: #18438f;
        }

        .tab-btn.active {
            color: white;
            background: linear-gradient(135deg, #18438f 0%, #0096df 100%);
            border-bottom-color: #0096df;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Cards de Solicitações */
        .solicitacao-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #0096df;
            transition: all 0.3s;
        }

        .solicitacao-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .solicitacao-card.preco {
            border-left-color: #0096df;
        }

        .solicitacao-card.cotacao {
            border-left-color: #ffc107;
        }

        .solicitacao-card.mensagem {
            border-left-color: #28a745;
        }

        .solicitacao-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .solicitacao-titulo {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .solicitacao-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pendente {
            background: #fff3cd;
            color: #856404;
        }

        .status-nao-lido {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-respondido {
            background: #d4edda;
            color: #155724;
        }

        .status-lido {
            background: #d4edda;
            color: #155724;
        }

        .solicitacao-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .info-label {
            font-weight: 700;
            color: #18438f;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-valor {
            color: #333;
            font-size: 1rem;
        }

        .solicitacao-mensagem {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
            margin-top: 15px;
            border-left: 4px solid #0096df;
        }

        .solicitacao-resposta {
            background: #d4edda;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
            margin-top: 15px;
            border-left: 4px solid #28a745;
        }

        .vazio-message {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
        }

        .vazio-message i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .vazio-message p {
            color: #999;
            font-size: 1.2rem;
        }

        .contador-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0096df;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .header-usuario {
                flex-direction: column;
                text-align: center;
            }

            .header-usuario-info h2 {
                font-size: 1.5rem;
            }

            .tab-btn {
                padding: 12px 18px;
                font-size: 0.9rem;
            }

            .solicitacao-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include '../templates/menu.php'; ?>

    <div class="minha-conta-container">
        <!-- Header do Usuário -->
        <section class="header-usuario">
            <div class="header-usuario-info">
                <h2><i class="fas fa-user-circle me-2"></i><?php echo htmlspecialchars($dados_usuario['username']); ?></h2>
                <p><i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($dados_usuario['email']); ?></p>
                <p><i class="fas fa-calendar me-2"></i>Membro desde <?php echo date('d/m/Y', strtotime($dados_usuario['data_criacao'])); ?></p>
            </div>
            <div class="header-usuario-btn">
                <a href="index.php?logout=1" class="btn-custom btn-sair">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </a>
            </div>
        </section>

        <!-- Estatísticas -->
        <section class="contador-stats">
            <div class="stat-box">
                <div class="stat-number"><?php echo count($solicitacoes_preco); ?></div>
                <div class="stat-label">Solicitações de Preço</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo count($solicitacoes_cotacao); ?></div>
                <div class="stat-label">Solicitações de Cotação</div>
            </div>
            <div class="stat-box">
                <div class="stat-number"><?php echo count($mensagens_contato); ?></div>
                <div class="stat-label">Mensagens de Contato</div>
            </div>
        </section>

        <!-- Tabs -->
        <section class="tabs-container">
            <button class="tab-btn active" onclick="abrirTab(event, 'preco')">
                <i class="fas fa-tag me-2"></i>Preços (<?php echo count($solicitacoes_preco); ?>)
            </button>
            <button class="tab-btn" onclick="abrirTab(event, 'cotacao')">
                <i class="fas fa-file-invoice me-2"></i>Cotações (<?php echo count($solicitacoes_cotacao); ?>)
            </button>
            <button class="tab-btn" onclick="abrirTab(event, 'mensagens')">
                <i class="fas fa-envelope me-2"></i>Mensagens (<?php echo count($mensagens_contato); ?>)
            </button>
        </section>

        <!-- Tab: Solicitações de Preço -->
        <section id="preco" class="tab-content active">
            <h3 style="margin-bottom: 25px; color: #333; font-weight: 800;">
                <i class="fas fa-tag me-2" style="color: #0096df;"></i>Solicitações de Preço
            </h3>

            <?php if (empty($solicitacoes_preco)): ?>
                <div class="vazio-message">
                    <i class="fas fa-inbox"></i>
                    <p>Você ainda não fez solicitações de preço</p>
                </div>
            <?php else: ?>
                <?php foreach ($solicitacoes_preco as $preco): ?>
                    <div class="solicitacao-card preco">
                        <div class="solicitacao-header">
                            <div class="solicitacao-titulo">
                                <i class="fas fa-tag"></i>
                                Produto #<?php echo $preco['produto_id']; ?> - <?php echo ucfirst($preco['categoria']); ?>
                            </div>
                            <span class="solicitacao-status status-<?php echo str_replace(' ', '-', strtolower($preco['status'])); ?>">
                                <?php echo ucfirst($preco['status']); ?>
                            </span>
                        </div>

                        <div class="solicitacao-info">
                            <div class="info-item">
                                <div class="info-label">ID da Solicitação</div>
                                <div class="info-valor">#<?php echo $preco['id']; ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Data da Solicitação</div>
                                <div class="info-valor"><?php echo date('d/m/Y H:i', strtotime($preco['data_solicitacao'])); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Categoria</div>
                                <div class="info-valor"><?php echo ucfirst($preco['categoria']); ?></div>
                            </div>
                        </div>

                        <?php if (!empty($preco['mensagem'])): ?>
                            <div class="solicitacao-mensagem">
                                <strong>Sua mensagem:</strong><br>
                                <?php echo htmlspecialchars($preco['mensagem']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <!-- Tab: Solicitações de Cotação -->
        <section id="cotacao" class="tab-content">
            <h3 style="margin-bottom: 25px; color: #333; font-weight: 800;">
                <i class="fas fa-file-invoice me-2" style="color: #ffc107;"></i>Solicitações de Cotação
            </h3>

            <?php if (empty($solicitacoes_cotacao)): ?>
                <div class="vazio-message">
                    <i class="fas fa-inbox"></i>
                    <p>Você ainda não fez solicitações de cotação</p>
                </div>
            <?php else: ?>
                <?php foreach ($solicitacoes_cotacao as $cotacao): ?>
                    <div class="solicitacao-card cotacao">
                        <div class="solicitacao-header">
                            <div class="solicitacao-titulo">
                                <i class="fas fa-file-invoice"></i>
                                Cotação #<?php echo $cotacao['id']; ?>
                            </div>
                            <span class="solicitacao-status status-<?php echo str_replace(' ', '-', strtolower($cotacao['status'])); ?>">
                                <?php echo ucfirst($cotacao['status']); ?>
                            </span>
                        </div>

                        <div class="solicitacao-info">
                            <div class="info-item">
                                <div class="info-label">Data da Solicitação</div>
                                <div class="info-valor"><?php echo date('d/m/Y H:i', strtotime($cotacao['data_solicitacao'])); ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Telefone</div>
                                <div class="info-valor"><?php echo !empty($cotacao['telefone']) ? htmlspecialchars($cotacao['telefone']) : 'Não informado'; ?></div>
                            </div>
                        </div>

                        <div class="solicitacao-info">
                            <div style="grid-column: 1/-1;">
                                <div class="info-label">Produtos Solicitados</div>
                                <div class="info-valor">
                                    <?php 
                                    $produtos = json_decode($cotacao['produtos_json'], true);
                                    if (is_array($produtos) && !empty($produtos)) {
                                        echo '<ul style="margin: 10px 0; padding-left: 20px;">';
                                        foreach ($produtos as $p) {
                                            echo '<li>' . htmlspecialchars($p['nome'] ?? '') . 
                                                 (!empty($p['capacidade']) ? ' (' . htmlspecialchars($p['capacidade']) . ')' : '') . '</li>';
                                        }
                                        echo '</ul>';
                                    } else {
                                        echo 'Nenhum produto especificado';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($cotacao['mensagem'])): ?>
                            <div class="solicitacao-mensagem">
                                <strong>Sua mensagem:</strong><br>
                                <?php echo htmlspecialchars($cotacao['mensagem']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <!-- Tab: Mensagens de Contato -->
        <section id="mensagens" class="tab-content">
            <h3 style="margin-bottom: 25px; color: #333; font-weight: 800;">
                <i class="fas fa-envelope me-2" style="color: #28a745;"></i>Mensagens de Contato
            </h3>

            <?php if (empty($mensagens_contato)): ?>
                <div class="vazio-message">
                    <i class="fas fa-inbox"></i>
                    <p>Você ainda não enviou mensagens de contato</p>
                </div>
            <?php else: ?>
                <?php foreach ($mensagens_contato as $msg): ?>
                    <div class="solicitacao-card mensagem">
                        <div class="solicitacao-header">
                            <div class="solicitacao-titulo">
                                <i class="fas fa-envelope"></i>
                                <?php echo htmlspecialchars($msg['assunto']); ?>
                            </div>
                            <span class="solicitacao-status status-<?php echo str_replace(' ', '-', strtolower($msg['status'])); ?>">
                                <?php echo ucfirst($msg['status']); ?>
                            </span>
                        </div>

                        <div class="solicitacao-info">
                            <div class="info-item">
                                <div class="info-label">ID da Mensagem</div>
                                <div class="info-valor">#<?php echo $msg['id']; ?></div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Data de Envio</div>
                                <div class="info-valor"><?php echo date('d/m/Y H:i', strtotime($msg['data_envio'])); ?></div>
                            </div>
                            <?php if (!empty($msg['data_resposta'])): ?>
                                <div class="info-item">
                                    <div class="info-label">Data de Resposta</div>
                                    <div class="info-valor"><?php echo date('d/m/Y H:i', strtotime($msg['data_resposta'])); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="solicitacao-mensagem">
                            <strong>Sua mensagem:</strong><br>
                            <?php echo htmlspecialchars($msg['mensagem']); ?>
                        </div>

                        <?php if (!empty($msg['resposta'])): ?>
                            <div class="solicitacao-resposta">
                                <strong><i class="fas fa-reply me-2"></i>Resposta do Suporte:</strong><br>
                                <?php echo htmlspecialchars($msg['resposta']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </div>

    <?php include '../templates/rodape.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function abrirTab(evt, tabName) {
            // Esconder todos os tabs
            var tabconts = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabconts.length; i++) {
                tabconts[i].classList.remove("active");
            }

            // Remover classe active de todos os botões
            var tabbts = document.getElementsByClassName("tab-btn");
            for (var i = 0; i < tabbts.length; i++) {
                tabbts[i].classList.remove("active");
            }

            // Mostrar o tab selecionado
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>
</body>
</html>
