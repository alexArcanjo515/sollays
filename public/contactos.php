<?php
session_start();
include_once '../templates/menu.php';
?>

<section class="container-fluid p-0">
    <!-- Banner Carrossel de Clientes -->
    <div class="clientes-banner position-relative w-100 py-4" style="background: linear-gradient(90deg, #18438f 60%, #0096df 100%); overflow:hidden;">
        <h2 class="text-center text-white mb-4 fw-bold animate__animated animate__fadeInDown" style="letter-spacing:1px;">Nossos Clientes</h2>
        <div class="clientes-marquee">
            <div class="clientes-marquee-inner d-flex align-items-center">
                <?php
                // Exemplo de logos de clientes (substitua pelos seus)
                $clientes = [
                    '../assets/clientes/cliente1.png',
                    '../assets/clientes/cliente2.png',
                    '../assets/clientes/cliente3.png',
                    '../assets/clientes/cliente4.png',
                    '../assets/clientes/cliente5.png',
                    '../assets/clientes/cliente6.png',
                    '../assets/clientes/cliente7.png',
                    '../assets/clientes/cliente8.png',
                ];
                // Repete para efeito infinito
                for ($i = 0; $i < 2; $i++) {
                    foreach ($clientes as $logo) {
                        echo '<div class="mx-4"><img src="'.$logo.'" alt="Cliente" style="height:60px; filter:drop-shadow(0 2px 8px #18438f66);"></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<section class="container py-5">
    <div class="row g-5 align-items-center">
        <div class="col-lg-6 animate__animated animate__fadeInLeft">
            <div class="bg-white rounded-4 shadow-lg p-4">
                <h2 class="fw-bold mb-3" style="color:#18438f;">Fale Conosco</h2>
                <form id="form-contacto" method="post" autocomplete="off" novalidate>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome*</label>
                        <input type="text" class="form-control" id="nome" name="nome" required maxlength="80" autocomplete="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail*</label>
                        <input type="email" class="form-control" id="email" name="email" required maxlength="120" autocomplete="email">
                    </div>
                    <div class="mb-3">
                        <label for="assunto" class="form-label">Assunto*</label>
                        <input type="text" class="form-control" id="assunto" name="assunto" required maxlength="120">
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem*</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required maxlength="1000"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="captcha" class="form-label">Quanto é 3 + 4?*</label>
                        <input type="text" class="form-control" id="captcha" name="captcha" required pattern="7">
                    </div>
                    <button type="submit" class="btn btn-primary rounded-pill fw-bold w-100 py-2">
                        <i class="fas fa-paper-plane me-1"></i> Enviar Mensagem
                    </button>
                </form>
                <div id="form-contacto-feedback" class="mt-3"></div>
            </div>
        </div>
        <div class="col-lg-6 animate__animated animate__fadeInRight">
            <div class="bg-light rounded-4 shadow-lg p-4 h-100">
                <h3 class="fw-bold mb-3" style="color:#0096df;">Nossa Equipe</h3>
                <div class="row g-3">
                    <?php
                    // Exemplo de colaboradores (substitua pelos reais)
                    $colaboradores = [
                        ['nome' => 'Ana Silva', 'cargo' => 'Diretora Comercial', 'img' => '../assets/team/ana.jpg'],
                        ['nome' => 'Carlos Souza', 'cargo' => 'Engenheiro Solar', 'img' => '../assets/team/carlos.jpg'],
                        ['nome' => 'Fernanda Lima', 'cargo' => 'Atendimento', 'img' => '../assets/team/fernanda.jpg'],
                        ['nome' => 'João Pedro', 'cargo' => 'Técnico de Instalação', 'img' => '../assets/team/joao.jpg'],
                    ];
                    foreach ($colaboradores as $col) {
                        echo '
                        <div class="col-6 col-md-6 col-lg-6 text-center">
                            <div class="team-card p-3 rounded-3 bg-white shadow-sm animate__animated animate__zoomIn">
                                <img src="'.$col['img'].'" alt="'.$col['nome'].'" class="rounded-circle mb-2" style="width:80px; height:80px; object-fit:cover; border:3px solid #0096df;">
                                <div class="fw-bold" style="color:#18438f;">'.$col['nome'].'</div>
                                <div class="text-muted small">'.$col['cargo'].'</div>
                            </div>
                        </div>
                        ';
                    }
                    ?>
                </div>
                <div class="mt-4 text-center">
                    <a href="mailto:contato@sollays.com" class="btn btn-outline-primary rounded-pill fw-bold me-2"><i class="fas fa-envelope me-1"></i> Email</a>
                    <a href="https://wa.me/SEUNUMERO" target="_blank" class="btn btn-success rounded-pill fw-bold"><i class="fab fa-whatsapp me-1"></i> WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Animate.css para efeitos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
.clientes-banner {
    min-height: 140px;
    position: relative;
    overflow: hidden;
}
.clientes-marquee {
    width: 100%;
    overflow: hidden;
    position: relative;
}
.clientes-marquee-inner {
    display: flex;
    animation: marquee 22s linear infinite;
}
@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.team-card {
    transition: transform 0.3s, box-shadow 0.3s;
}
.team-card:hover {
    transform: translateY(-8px) scale(1.04) rotate(-1deg);
    box-shadow: 0 8px 32px #0096df33;
}
</style>

<script>
// Validação e envio seguro do formulário de contato
document.getElementById('form-contacto').addEventListener('submit', function(e) {
    e.preventDefault();
    const nome = document.getElementById('nome').value.trim();
    const email = document.getElementById('email').value.trim();
    const assunto = document.getElementById('assunto').value.trim();
    const mensagem = document.getElementById('mensagem').value.trim();
    const captcha = document.getElementById('captcha').value.trim();
    let feedback = document.getElementById('form-contacto-feedback');
    feedback.innerHTML = '';
    // Validação básica
    if (!nome || !email || !assunto || !mensagem || !captcha) {
        feedback.innerHTML = '<div class="alert alert-danger">Preencha todos os campos obrigatórios.</div>';
        return;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        feedback.innerHTML = '<div class="alert alert-danger">E-mail inválido.</div>';
        return;
    }
    if (captcha !== '7') {
        feedback.innerHTML = '<div class="alert alert-danger">Captcha incorreto.</div>';
        return;
    }
    // Envio AJAX seguro
    fetch('enviar_contato.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: new URLSearchParams({
            nome, email, assunto, mensagem
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.sucesso) {
            feedback.innerHTML = '<div class="alert alert-success">Mensagem enviada com sucesso! Retornaremos em breve.</div>';
            document.getElementById('form-contacto').reset();
        } else {
            feedback.innerHTML = '<div class="alert alert-danger">'+(data.msg || 'Erro ao enviar. Tente novamente.')+'</div>';
        }
    })
    .catch(() => {
        feedback.innerHTML = '<div class="alert alert-danger">Erro ao enviar. Tente novamente.</div>';
    });
});
</script>

<?php include '../templates/rodape.php'; ?>