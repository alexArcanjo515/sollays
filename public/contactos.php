<?php
// Incluir arquivo de inicialização
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
} else {
    session_start();
}
include_once '../templates/menu.php';
?>

<section class="container-fluid p-0">
    <!-- Banner Carrossel de Clientes com Animação -->
    <div class="clientes-banner position-relative w-100 py-5" style="background: linear-gradient(135deg, #18438f 0%, #0096df 50%, #00d4ff 100%); overflow:hidden;">
        <h2 class="text-center text-white mb-4 fw-bold animate__animated animate__fadeInDown" style="letter-spacing: 2px; font-size: 2.5rem; text-shadow: 2px 2px 8px rgba(0,0,0,0.3);">
            <i class="fas fa-handshake me-3" style="color: #FFD700;"></i>Nossos Clientes Satisfeitos
        </h2>
        <div class="clientes-marquee">
            <div class="clientes-marquee-inner d-flex align-items-center">
                <?php
                // Logos de clientes (substitua pelos seus)
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
                        echo '<div class="mx-5 client-logo-wrapper"><img src="'.$logo.'" alt="Cliente" style="height:70px; filter:drop-shadow(0 4px 12px #00000033); transition: transform 0.3s;"></div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>



<!-- Animate.css para efeitos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
.clientes-banner {
    min-height: 160px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
}

.clientes-marquee {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.clientes-marquee-inner {
    display: flex;
    animation: marquee 25s linear infinite;
}

.client-logo-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 120px;
}

.client-logo-wrapper img {
    transition: transform 0.3s, filter 0.3s;
}

.client-logo-wrapper:hover img {
    transform: scale(1.15) rotate(-2deg);
    filter: drop-shadow(0 6px 16px rgba(255, 215, 0, 0.4)) brightness(1.2);
}

@keyframes marquee {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Seção de Contato com Personalização */
.contacto-section {
    background: linear-gradient(135deg, #0a1e3a 0%, #18438f 40%, #0096df 100%);
    position: relative;
    overflow: hidden;
    min-height: 600px;
    display: flex;
    align-items: center;
}

.contacto-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
}

.contacto-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(24, 67, 143, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    animation: float 10s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) scale(1); }
    50% { transform: translateY(30px) scale(1.05); }
}

.contacto-form-container {
    position: relative;
    z-index: 2;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 255, 255, 0.2);
    animation: slideIn 0.8s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.contacto-form-title {
    background: linear-gradient(135deg, #18438f 0%, #0096df 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 2.2rem;
    font-weight: 800;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
}

.form-control {
    border: 2px solid #e0e7ff;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: all 0.3s;
    background: #f8fbff;
}

.form-control:focus {
    border-color: #0096df;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(0, 150, 223, 0.1);
    outline: none;
}

.form-label {
    font-weight: 700;
    color: #18438f;
    margin-bottom: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.form-label i {
    color: #0096df;
    font-size: 1.3rem;
}

.btn-submit {
    background: linear-gradient(135deg, #18438f 0%, #0096df 100%);
    border: none;
    border-radius: 12px;
    padding: 14px 32px;
    font-weight: 700;
    font-size: 1.1rem;
    color: white;
    transition: all 0.3s;
    box-shadow: 0 8px 25px rgba(0, 150, 223, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, transparent 100%);
    transition: left 0.5s;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0, 150, 223, 0.4);
    background: linear-gradient(135deg, #0096df 0%, #18438f 100%);
}

.btn-submit:hover::before {
    left: 100%;
}

.btn-submit:active {
    transform: translateY(-1px);
}

#form-contacto-feedback {
    min-height: 30px;
    margin-top: 1.5rem;
}

.alert {
    border-radius: 12px;
    border: none;
    padding: 15px 20px;
    font-weight: 600;
    animation: slideAlert 0.4s ease-out;
}

@keyframes slideAlert {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-left: 5px solid #28a745;
    color: #155724;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    border-left: 5px solid #dc3545;
    color: #721c24;
}

/* Info Cards */
.info-card {
    background: rgba(24, 67, 143, 0.05);
    border-left: 4px solid #0096df;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 1rem;
    transition: all 0.3s;
}

.info-card:hover {
    background: rgba(0, 150, 223, 0.1);
    border-left-color: #00d4ff;
    transform: translateX(5px);
}

.info-card i {
    color: #0096df;
    font-size: 1.5rem;
    margin-right: 1rem;
}

.info-card-title {
    font-weight: 700;
    color: #18438f;
    margin-bottom: 0.5rem;
}

.info-card-text {
    color: #555;
    font-size: 0.95rem;
}

/* Mapa com Estilo */
.map-container {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
    margin-top: 2rem;
}

.map-container iframe {
    border-radius: 20px;
    border: none;
}

/* Responsive */
@media (max-width: 768px) {
    .contacto-section {
        min-height: auto;
        padding: 2rem 0;
    }

    .contacto-form-title {
        font-size: 1.8rem;
    }

    .contacto-section::before,
    .contacto-section::after {
        display: none;
    }

    .map-container iframe {
        height: 400px !important;
    }
}
</style>

<script>
// Esperar o DOM carregar completamente
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-contacto');
    
    if (!form) {
        console.error('Formulário não encontrado!');
        return;
    }

    // Validação e envio seguro do formulário de contato
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nome = document.getElementById('nome').value.trim();
        const email = document.getElementById('email').value.trim();
        const assunto = document.getElementById('assunto').value.trim();
        const mensagem = document.getElementById('mensagem').value.trim();
        const feedback = document.getElementById('form-contacto-feedback');
        
        if (!feedback) {
            console.error('Elemento de feedback não encontrado!');
            return;
        }
        
        feedback.innerHTML = '';

        // Validação básica no frontend
        if (!nome || !email || !assunto || !mensagem) {
            feedback.innerHTML = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Preencha todos os campos obrigatórios.</div>';
            return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            feedback.innerHTML = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>E-mail inválido.</div>';
            return;
        }

        if (nome.length < 3 || nome.length > 100) {
            feedback.innerHTML = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Nome deve ter entre 3 e 100 caracteres.</div>';
            return;
        }

        if (mensagem.length < 10 || mensagem.length > 5000) {
            feedback.innerHTML = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i>Mensagem deve ter entre 10 e 5000 caracteres.</div>';
            return;
        }

        // Mostrar carregamento
        const btnSubmit = form.querySelector('.btn-submit');
        const originalText = btnSubmit.innerHTML;
        btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
        btnSubmit.disabled = true;

        // Preparar dados
        const formData = new URLSearchParams();
        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('assunto', assunto);
        formData.append('mensagem', mensagem);

        console.log('Enviando formulário com dados:', {nome, email, assunto, mensagem: mensagem.substring(0, 50) + '...'});

        // Envio AJAX seguro
        fetch('enviar_contato.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData.toString()
        })
        .then(res => {
            console.log('Resposta recebida. Status:', res.status);
            if (!res.ok) {
                console.error('HTTP Error:', res.status);
            }
            return res.json();
        })
        .then(data => {
            console.log('Dados JSON recebidos:', data);
            
            if (data.sucesso) {
                feedback.innerHTML = '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i><strong>Sucesso!</strong> ' + data.msg + '</div>';
                form.reset();
                
                // Rolar para o feedback
                setTimeout(() => {
                    feedback.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 200);
                
                // Resetar contador
                const contador = document.querySelector('#mensagem ~ small');
                if (contador) contador.textContent = '0/5000 caracteres';
            } else {
                feedback.innerHTML = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i><strong>Erro:</strong> ' + (data.msg || 'Erro desconhecido ao enviar.') + '</div>';
            }
        })
        .catch(err => {
            console.error('Erro de requisição:', err);
            feedback.innerHTML = '<div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i><strong>Erro de conexão:</strong> Verifique sua conexão de internet e tente novamente.</div>';
        })
        .finally(() => {
            btnSubmit.innerHTML = originalText;
            btnSubmit.disabled = false;
        });
    });

    // Contador de caracteres para mensagem
    const textareaMsg = document.getElementById('mensagem');
    if (textareaMsg) {
        textareaMsg.addEventListener('input', function() {
            const contador = this.nextElementSibling;
            const caracteres = this.value.length;
            
            if (contador) {
                contador.textContent = `${caracteres}/5000 caracteres`;
                
                if (caracteres < 10) {
                    contador.style.color = '#dc3545';
                } else if (caracteres > 4500) {
                    contador.style.color = '#fd7e14';
                } else {
                    contador.style.color = '#6c757d';
                }
            }
        });
        
        // Inicializar contador
        const contadorInit = textareaMsg.nextElementSibling;
        if (contadorInit) {
            contadorInit.textContent = '0/5000 caracteres';
        }
    }
});
</script>
 <section class="contacto-section">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <!-- Coluna de Informações -->
            <div class="col-lg-5" data-aos="fade-right">
                <h2 class="contacto-form-title mb-4" style="font-size: 2.5rem;">
                    <i class="fas fa-phone-alt me-2" style="color: #0096df;"></i>Entre em Contato
                </h2>
                <p class="text-white mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                    Tem alguma dúvida ou sugestão? Entre em contato conosco através do formulário ao lado ou use um dos canais abaixo. Nossa equipe responde em até 24 horas!
                </p>

                <div class="info-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <div class="info-card-title">Localização</div>
                        <div class="info-card-text">Sequele, Angola</div>
                    </div>
                </div>

                <div class="info-card">
                    <i class="fas fa-phone"></i>
                    <div>
                        <div class="info-card-title">Telefone</div>
                        <div class="info-card-text"><a href="tel:+244948996080" class="text-decoration-none" style="color: #0096df; font-weight: 600;">+244 948 996 080</a></div>
                    </div>
                </div>

                <div class="info-card">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <div class="info-card-title">E-mail</div>
                        <div class="info-card-text"><a href="mailto:suporte@sollays.com" class="text-decoration-none" style="color: #0096df; font-weight: 600;">suporte@sollays.com</a></div>
                    </div>
                </div>

                <div class="info-card">
                    <i class="fas fa-clock"></i>
                    <div>
                        <div class="info-card-title">Horário de Atendimento</div>
                        <div class="info-card-text">Segunda a Sexta: 08:00 - 17:00<br>Sábado: 09:00 - 13:00</div>
                    </div>
                </div>

                <!-- Redes Sociais -->
                <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                    <a href="#" class="btn btn-sm rounded-circle" style="background: rgba(255,255,255,0.2); color: white; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-sm rounded-circle" style="background: rgba(255,255,255,0.2); color: white; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="#" class="btn btn-sm rounded-circle" style="background: rgba(255,255,255,0.2); color: white; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-sm rounded-circle" style="background: rgba(255,255,255,0.2); color: white; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Coluna do Formulário -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="contacto-form-container p-5">
                    <h3 class="contacto-form-title mb-4">
                        <i class="fas fa-envelope-open-text me-2"></i>Envie sua Mensagem
                    </h3>
                    <form id="form-contacto" autocomplete="off">
                        <div class="mb-4">
                            <label for="nome" class="form-label">
                                <i class="fas fa-user"></i> Seu Nome *
                            </label>
                            <input type="text" class="form-control form-control-lg" id="nome" 
                                   placeholder="João Silva" required maxlength="100">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Seu E-mail *
                            </label>
                            <input type="email" class="form-control form-control-lg" id="email" 
                                   placeholder="joao@email.com" required maxlength="100">
                        </div>

                        <div class="mb-4">
                            <label for="assunto" class="form-label">
                                <i class="fas fa-heading"></i> Assunto *
                            </label>
                            <select class="form-control form-control-lg" id="assunto" required>
                                <option value="">-- Selecione um assunto --</option>
                                <option value="Dúvida sobre produtos">Dúvida sobre produtos</option>
                                <option value="Sugestão de melhoria">Sugestão de melhoria</option>
                                <option value="Reclamação">Reclamação</option>
                                <option value="Parceria">Parceria comercial</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="mensagem" class="form-label">
                                <i class="fas fa-comment-dots"></i> Mensagem *
                            </label>
                            <textarea class="form-control form-control-lg" id="mensagem" rows="5" 
                                      placeholder="Digite sua mensagem aqui..." required maxlength="5000"
                                      style="resize: vertical;"></textarea>
                            <small class="text-muted d-block mt-2">0/5000 caracteres</small>
                        </div>

                        <div id="form-contacto-feedback"></div>

                        <button type="submit" class="btn btn-submit w-100 btn-lg mt-4">
                            <i class="fas fa-paper-plane me-2"></i>Enviar Mensagem
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

  <section class="container-fluid py-5" style="background: #f8fbff;">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold" style="font-size: 2rem; color: #18438f;">
            <i class="fas fa-map-marked-alt me-2" style="color: #0096df;"></i>Nos Localize
        </h2>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5574.701785271798!2d13.484805034121734!3d-8.88801210685292!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a51ffa5169bed47%3A0x7ba0a99ba9f1be7!2sCentralidade%20do%20Sequele!5e0!3m2!1spt-PT!2sao!4v1747825486072!5m2!1spt-PT!2sao" 
                    width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php include '../templates/rodape.php'; ?>