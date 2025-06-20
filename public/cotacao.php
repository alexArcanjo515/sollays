<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['cotacao'])) {
    $_SESSION['cotacao'] = [];
}

// Remover item da cotação
if (isset($_GET['remover']) && is_numeric($_GET['remover'])) {
    $id = (int)$_GET['remover'];
    $_SESSION['cotacao'] = array_filter($_SESSION['cotacao'], function($item) use ($id) {
        return $item['id'] != $id;
    });
    header("Location: cotacao.php");
    exit;
}

// Recebe produtos adicionados via AJAX ou POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto'])) {
    $produto = $_POST['produto'];
    foreach ($_SESSION['cotacao'] as $item) {
        if ($item['id'] == $produto['id']) {
            echo json_encode(['adicionado' => false, 'msg' => 'Produto já está na cotação.']);
            exit;
        }
    }
    $_SESSION['cotacao'][] = $produto;
    echo json_encode(['adicionado' => true]);
    exit;
}

require_once __DIR__ .'/../vendor/autoload.php'; // PHPMailer via Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '../templates/menu.php';
?>

<section class="container py-5">
    <h1 class="fw-bold mb-4 text-center"
        style="font-size: 2.2rem; background: linear-gradient(90deg, #18438f 40%, #0096df 80%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
        Solicitação de Cotação
    </h1>

    <div id="cotacao-lista"></div>

    <form id="form-cotacao" class="card shadow p-4 mx-auto" style="max-width: 500px; display:none;" method="post" enctype="multipart/form-data" autocomplete="off" accept-charset="UTF-8">
        <h5 class="mb-3 fw-bold text-primary">Seus dados para contato</h5>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome*</label>
            <input type="text" class="form-control" name="nome" id="nome" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail*</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone" id="telefone">
        </div>
        <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem (opcional)</label>
            <textarea class="form-control" name="mensagem" id="mensagem" rows="3"></textarea>
        </div>
        <input type="hidden" name="produtos_json" id="produtos_json">
        <button type="submit" class="btn btn-primary w-100 fw-bold rounded-pill mb-2">
            <i class="fas fa-paper-plane me-1"></i> Enviar Solicitação
        </button>
        <button type="button" id="btn-gerar-pdf" class="btn btn-outline-secondary w-100 fw-bold rounded-pill mb-2">
            <i class="fas fa-file-pdf me-1"></i> Gerar PDF da Cotação
        </button>
        <a href="https://wa.me/SEUNUMERO?text=Olá,%20gostaria%20de%20acompanhar%20minha%20cotação." target="_blank" class="btn btn-success w-100 fw-bold rounded-pill">
            <i class="fab fa-whatsapp me-1"></i> Falar no WhatsApp
        </a>
    </form>

    <div id="cotacao-aceite" class="text-center mt-4" style="display:none;">
        <button class="btn btn-success fw-bold rounded-pill" id="btn-aceitar-cotacao">
            <i class="fas fa-check-circle me-1"></i> Aceitar Cotação e Formalizar Pedido
        </button>
        <div class="mt-3 text-muted small">
            Após aceitar, entraremos em contato para combinar pagamento e entrega.
        </div>
    </div>
</section>

<?php
// Processamento do formulário (PHP)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['email'], $_POST['produtos_json'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $mensagem = trim($_POST['mensagem']);
    $produtos = json_decode($_POST['produtos_json'], true);

    // Validação básica
    $erros = [];
    if (empty($nome)) $erros[] = "Nome obrigatório.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "E-mail inválido.";
    if (empty($produtos) || !is_array($produtos)) $erros[] = "Nenhum produto selecionado.";

    if (empty($erros)) {
        // Monta o corpo do e-mail com charset UTF-8 e prioridade alta
        $body = "<h2 style='color:#18438f;'>Solicitação de Preço</h2>";
        $body .= "<strong>Nome:</strong> " . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . "<br>";
        $body .= "<strong>E-mail:</strong> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "<br>";
        $body .= "<strong>Telefone:</strong> " . htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8') . "<br>";
        $body .= "<strong>Mensagem:</strong> " . nl2br(htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8')) . "<br><br>";
        $body .= "<h4 style='color:#0096df;'>Produtos Solicitados:</h4>";
        $body .= "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse:collapse;'>";
        $body .= "<tr><th>Categoria</th><th>ID</th><th>Nome</th><th>Potência/Capacidade</th></tr>";
        foreach ($produtos as $p) {
            $body .= "<tr>";
            $body .= "<td style='text-align:center;'>" . htmlspecialchars(ucfirst($p['categoria'] ?? ''), ENT_QUOTES, 'UTF-8') . "</td>";
            $body .= "<td style='text-align:center; font-weight:bold;'>" . htmlspecialchars($p['id'], ENT_QUOTES, 'UTF-8') . "</td>";
            $body .= "<td>" . htmlspecialchars($p['nome'], ENT_QUOTES, 'UTF-8') . "</td>";
            $body .= "<td>" . htmlspecialchars($p['capacidade'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
            $body .= "</tr>";
        }
        $body .= "</table>";

        // --- CADASTRA NO BANCO ---
        $mysqli = new mysqli('localhost', 'root', 'developer', 'loja');
        if (!$mysqli->connect_errno) {
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $produtos_json = json_encode($produtos, JSON_UNESCAPED_UNICODE);
            $stmt = $mysqli->prepare("INSERT INTO solicitacoes_cotacao (nome, email, telefone, mensagem, produtos_json, ip, user_agent) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssssss', $nome, $email, $telefone, $mensagem, $produtos_json, $ip, $user_agent);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
        }

        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alexarcanjo515@gmail.com';
            $mail->Password = 'ypia sbps ytni ezru '; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('alexarcanjo515@gmail.com', 'SOLLAYS - Solicitação');
            $mail->addAddress('alexarcanjo515@gmail.com');
            $mail->addReplyTo($email, $nome);

            $mail->isHTML(true);
            $mail->Subject = '!!! [IMPORTANTE] Nova Solicitação de preço';
            $mail->Body = $body;
            $mail->Priority = 1;
            $mail->AddCustomHeader("X-MSMail-Priority: High");
            $mail->AddCustomHeader("Importance: High");

            $mail->send();
            echo "<div class='alert alert-success text-center mt-4'>Solicitação enviada com sucesso! Em breve entraremos em contato.</div>";
        } catch (Exception $e) {
            echo "<div class='alert alert-danger text-center mt-4'>Erro ao enviar e-mail: {$mail->ErrorInfo}</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center mt-4'>" . implode("<br>", $erros) . "</div>";
    }
}
?>

<script>
// Renderiza a lista de cotação do localStorage
function renderCotacao() {
    const cotacao = JSON.parse(localStorage.getItem('cotacao')) || [];
    const lista = document.getElementById('cotacao-lista');
    const form = document.getElementById('form-cotacao');
    const aceite = document.getElementById('cotacao-aceite');
    if (cotacao.length === 0) {
        lista.innerHTML = `<div class="alert alert-info text-center">
            Sua lista de cotação está vazia.<br>
            Adicione produtos para solicitar um orçamento personalizado.
        </div>`;
        form.style.display = 'none';
        aceite.style.display = 'none';
        return;
    }
    let html = `<div class="row g-4 mb-4">`;
    cotacao.forEach((item, idx) => {
        html += `
        <div class="col-md-6 col-lg-4">
            <div class="card shadow border-0 rounded-4 h-100 p-3 d-flex flex-column align-items-center cotacao-card-azul position-relative">
                <button class="btn btn-sm btn-danger rounded-circle position-absolute top-0 end-0 m-2 remover-cotacao-btn" data-idx="${idx}" title="Remover">
                    <i class="fas fa-times"></i>
                </button>
                <img src="${item.img}" alt="${item.nome}" class="img-fluid mb-3" style="max-height:120px;">
                <div class="fw-bold text-center mb-2" style="color:#18438f;font-size:1.1rem">${item.nome}</div>
                <div class="text-center text-muted mb-2" style="font-size:0.95rem">
                    <i class="fas fa-bolt"></i> <span class="fw-bold">${item.capacidade || ''}</span>
                </div>
                <span class="badge bg-info text-dark mb-2">Preço sob consulta</span>
            </div>
        </div>
        `;
    });
    html += `</div>`;
    lista.innerHTML = html;
    form.style.display = 'block';
    aceite.style.display = 'block';

    // Preenche o campo oculto com os produtos para o PHP
    document.getElementById('produtos_json').value = JSON.stringify(cotacao);

    // Remover produto da cotação
    document.querySelectorAll('.remover-cotacao-btn').forEach(btn => {
        btn.onclick = function() {
            const idx = this.dataset.idx;
            cotacao.splice(idx, 1);
            localStorage.setItem('cotacao', JSON.stringify(cotacao));
            renderCotacao();
        }
    });
}
renderCotacao();

// Validação extra do formulário no frontend
document.getElementById('form-cotacao').addEventListener('submit', function(e) {
    const nome = document.getElementById('nome').value.trim();
    const email = document.getElementById('email').value.trim();
    const cotacao = JSON.parse(localStorage.getItem('cotacao')) || [];
    let erro = '';
    if (!nome) erro = 'Preencha o nome.';
    else if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) erro = 'Preencha um e-mail válido.';
    else if (cotacao.length === 0) erro = 'Adicione ao menos um produto à cotação.';
    if (erro) {
        alert(erro);
        e.preventDefault();
        return false;
    }
    // O campo produtos_json já está preenchido
});

// Aceitar cotação
document.getElementById('btn-aceitar-cotacao').onclick = function() {
    alert('Cotação aceita! Nossa equipe entrará em contato para finalizar o pedido.');
    localStorage.removeItem('cotacao');
    renderCotacao();
};

// Função para gerar e baixar o recibo PDF da solicitação de cotação
function gerarReciboCotacaoPDF(callbackAfter = null) {
    const nome = document.getElementById('nome') ? document.getElementById('nome').value.trim() : '';
    const email = document.getElementById('email') ? document.getElementById('email').value.trim() : '';
    const telefone = document.getElementById('telefone') ? document.getElementById('telefone').value.trim() : '';
    const mensagem = document.getElementById('mensagem') ? document.getElementById('mensagem').value.trim() : '';
    let produtos = [];
    try {
        produtos = JSON.parse(document.getElementById('produtos_json').value);
    } catch (e) {}

    const data = new Date();
    let html = `
    <div id="recibo-cotacao-pdf" style="font-family:Arial,sans-serif;max-width:700px;margin:auto;padding:24px;">
        <div style="text-align:center;margin-bottom:20px;">
            <img src="/assets/images/logo.png" style="width:3cm;max-width:100%;height:auto;">
        </div>

        <h4 style="color:#0096df;">Produtos Solicitados:</h4>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th style="border:1px solid #ccc;padding:6px 4px;background:#f0f6ff;">Categoria</th>
                    <th style="border:1px solid #ccc;padding:6px 4px;background:#f0f6ff;">ID</th>
                    <th style="border:1px solid #ccc;padding:6px 4px;background:#f0f6ff;">Nome</th>
                    <th style="border:1px solid #ccc;padding:6px 4px;background:#f0f6ff;">Potência/Capacidade</th>
                </tr>
            </thead>
            <tbody>
    `;
    produtos.forEach(p => {
        html += `
        <tr>
            <td style="border:1px solid #ccc;padding:6px 4px;">${(p.categoria || '').charAt(0).toUpperCase() + (p.categoria || '').slice(1)}</td>
            <td style="border:1px solid #ccc;padding:6px 4px;">${p.id}</td>
            <td style="border:1px solid #ccc;padding:6px 4px;">${p.nome}</td>
            <td style="border:1px solid #ccc;padding:6px 4px;">${p.capacidade || ''}</td>
        </tr>
        `;
    });
    html += `
            </tbody>
        </table>
        <hr>
        <div style="margin-top:18px;">
            <strong>Contato da Empresa:</strong><br>
            <span>Telefone: <a href="tel:948996080" style="color:#18438f;text-decoration:none;">948996080</a></span><br>
            <span>Localização: Sequele</span><br>
            <span>E-mail: <a href="mailto:suporte@sollays.com" style="color:#18438f;text-decoration:none;">suporte@sollays.com</a></span>
        </div>
                     <div style="margin-bottom:10px;"><strong>Data da Solicitação:</strong> ${data.toLocaleString()}</div>

        <p style="margin-top:30px;font-size:0.95em;color:#888;">Recibo gerado pela Sollays. Guarde este comprovante para seu controle.</p>
    </div>
    `;

    // Cria um elemento temporário para renderizar o recibo
    let tempDiv = document.createElement('div');
    tempDiv.innerHTML = html;
    document.body.appendChild(tempDiv);

    html2canvas(tempDiv.querySelector('#recibo-cotacao-pdf')).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new window.jspdf.jsPDF('p', 'mm', 'a4');
        const pageWidth = pdf.internal.pageSize.getWidth();
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pageWidth - 20;
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        pdf.addImage(imgData, 'PNG', 10, 10, pdfWidth, pdfHeight);
        pdf.save('recibo-cotacao-' + Date.now() + '.pdf');
        document.body.removeChild(tempDiv);
        if (typeof callbackAfter === 'function') callbackAfter();
    });
}

// Botão manual
document.getElementById('btn-gerar-pdf').onclick = function() {
    gerarReciboCotacaoPDF();
};

// Geração automática após envio bem-sucedido
document.addEventListener('DOMContentLoaded', function() {
    const sucesso = document.querySelector('.alert-success');
    const cotacao = localStorage.getItem('cotacao');
    if (sucesso && cotacao && cotacao !== '[]') {
        gerarReciboCotacaoPDF(function() {
            localStorage.removeItem('cotacao');
            renderCotacao();
        });
    }
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style>
.cotacao-card-azul {
    background: #f7faff;
    border: 2px solid #18438f22;
    transition: box-shadow 0.3s, border 0.3s;
}
.cotacao-card-azul:hover {
    border-color: #0096df;
    box-shadow: 0 8px 32px #0096df33;
}
.btn-primary, .btn-primary:focus {
    background: linear-gradient(90deg, #18438f 60%, #0096df 100%) !important;
    border: none;
}
.btn-primary:hover {
    background: linear-gradient(90deg, #0096df 60%, #18438f 100%) !important;
}
</style>

<?php include '../templates/rodape.php'; ?>