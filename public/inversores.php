<?php
session_start();

// Simulação de login (remova em produção)
$_SESSION['usuario_id'] = 1;
$_SESSION['usuario_email'] = 'cliente@exemplo.com';

// Exemplo de inversores
$inversores = [
    [
        'id' => 1,
        'categoria' => 'inversor',
        'img' => '../assets/images/inversor.png',
        'pdf' => '../assets/pdfs/inversor1.pdf',
        'nome' => 'CAIXA INVERSORA',
        'descricao' => 'Caixa de geração de energia-armazenamento-inversor',
        'potencia' => '10/12/15kWh',
        'garantia' => '8 anos',
        'destaque' => true,
    ],
    [
        'id' => 2,
        'categoria' => 'inversor',
        'img' => '../assets/images/inversor1.png',
        'pdf' => '../assets/pdfs/inversor2.pdf',
        'nome' => 'CAIXA INVERSORA',
        'descricao' => 'Caixa de geração de energia-armazenamento-inversor',
        'potencia' => '5/6/7.2kWh',
        'garantia' => '10 anos',
        'destaque' => false,
    ],
    [
        'id' => 3,
        'categoria' => 'inversor',
        'img' => '../assets/images/inversor2.png',
        'pdf' => '../assets/pdfs/inversor3.pdf',
        'nome' => 'Sistema integrado de aplicação de armazenamento solar',
        'descricao' => 'Sistema de energia solar',
        'potencia' => '1kWh',
        'garantia' => '7 anos',
        'destaque' => false,
    ],
    [
        'id' => 4,
        'categoria' => 'inversor',
        'img' => '../assets/images/inversor3.png',
        'pdf' => '../assets/pdfs/inversor4.pdf',
        'nome' => 'BCT-SOLAR BOX 1.0',
        'descricao' => 'Tem uma bateria LiFePO₄ de 1.5kWh',
        'potencia' => '1.5kWh',
        'garantia' => '5 anos',
        'destaque' => false,
    ],
    [
        'id' => 5,
        'categoria' => 'inversor',
        'img' => '../assets/images/inversor4.png',
        'pdf' => '../assets/pdfs/inversor5.pdf',
        'nome' => 'Inversor de energia solar híbrido MPPT',
        'descricao' => '',
        'potencia' => '3-12 kW 6-10 kVA 24/48 V',
        'garantia' => '10 anos',
        'destaque' => false,
    ],
];
include_once '../templates/menu.php';
?>

<section class="container py-5">
    <h1 class="fw-bold mb-5 text-center"
        style="font-size: 2.2rem; background: linear-gradient(90deg, #18438f 40%, #0096df 80%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
        Inversores Solares
    </h1>

    <div class="row g-4 justify-content-center">
        <?php foreach ($inversores as $inv): ?>
        <div class="col-xl-4 col-md-6 col-12">
            <div class="inversor-card-azul shadow-lg border-0 rounded-5 bg-white position-relative h-100 d-flex flex-column animate__animated animate__fadeInDown">
                <?php if ($inv['destaque']): ?>
                    <span class="badge badge-destaque-azul position-absolute top-0 start-50 translate-middle-x mt-3 px-4 py-2 shadow">
                        <i class="fas fa-star"></i> Destaque
                    </span>
                <?php endif; ?>
                <div class="inversor-img-wrapper-azul d-flex justify-content-center align-items-center py-5">
                    <img src="<?php echo $inv['img']; ?>" alt="<?php echo strip_tags($inv['nome']); ?>" class="img-fluid inversor-img-azul" style="max-height: 420px;">
                </div>
                <div class="px-4 pb-4 flex-grow-1 d-flex flex-column">
                    <h5 class="fw-bold mb-2 text-center inversor-title-azul"><?php echo $inv['nome']; ?></h5>
                    <p class="text-muted small text-center mb-2"><?php echo $inv['descricao']; ?></p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge inversor-badge-azul"><i class="fas fa-bolt me-1"></i> <?php echo $inv['potencia']; ?></span>
                        <span class="badge inversor-badge2-azul"><i class="fas fa-shield-alt me-1"></i> <?php echo $inv['garantia']; ?> garantia</span>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-auto">
                        <a href="<?php echo $inv['pdf']; ?>" target="_blank" class="btn btn-outline-primary rounded-pill fw-bold inversor-btn-azul">
                            <i class="fas fa-file-pdf me-1"></i> Ficha Técnica
                        </a>
                        <button
                            class="btn btn-inversor-azul rounded-pill fw-bold adicionar-cotacao-btn"
                            data-produto-id="<?php echo $inv['id']; ?>"
                            data-produto-categoria="inversor"
                            data-produto-img="<?php echo $inv['img']; ?>"
                            data-produto-nome="<?php echo htmlspecialchars($inv['nome']); ?>"
                            data-produto-capacidade="<?php echo htmlspecialchars($inv['potencia']); ?>"
                        >
                            <i class="fas fa-list me-1"></i> Adicionar à Cotação
                        </button>
                       
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Modal Solicitar Preço Inversor -->
<div class="modal fade" id="modalSolicitarInversor" tabindex="-1" aria-labelledby="modalSolicitarInversorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, #18438f 60%, #0096df 100%); color: #fff;">
        <h5 class="modal-title" id="modalSolicitarInversorLabel"><i class="fas fa-tag me-2"></i>Solicitar Preço</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <form id="formSolicitarInversor" method="post" action="solicitar_preco.php">
        <div class="modal-body">
          <?php if (isset($_SESSION['usuario_id'])): ?>
            <input type="hidden" name="inversor_id" id="inversorIdInput">
            <div class="mb-3">
              <label for="mensagemInversor" class="form-label">Mensagem (opcional):</label>
              <textarea class="form-control" name="mensagem" id="mensagemInversor" rows="3" placeholder="Deseja informar algo?"></textarea>
            </div>
          <?php else: ?>
            <div class="alert alert-warning mb-0">
              Você precisa <a href="login.php" class="alert-link">fazer login</a> para solicitar preço.
            </div>
          <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary rounded-pill fw-bold">
            <i class="fas fa-paper-plane me-1"></i> Enviar Solicitação
          </button>
        </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>

<!-- Modal Sucesso -->
<div class="modal fade" id="modalSucessoInversor" tabindex="-1" aria-labelledby="modalSucessoInversorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: linear-gradient(90deg, #18438f 60%, #0096df 100%); color: #fff;">
        <h5 class="modal-title" id="modalSucessoInversorLabel"><i class="fas fa-check-circle me-2"></i>Solicitação enviada</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Solicitação feita com sucesso! Entraremos em contato por e-mail.</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal Falha -->
<div class="modal fade" id="modalFalhaInversor" tabindex="-1" aria-labelledby="modalFalhaInversorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalFalhaInversorLabel"><i class="fas fa-times-circle me-2"></i>Solicitação não efetuada</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Você precisa estar logado para solicitar preço.</p>
      </div>
    </div>
  </div>
</div>

<!-- Animate.css para animações -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
.inversor-card-azul {
    border: 2px solid #18438f22;
    background: #f7faff;
    min-height: 440px;
    transition: box-shadow 0.3s, border 0.3s, transform 0.3s;
    box-shadow: 0 2px 12px #18438f11;
    overflow: hidden;
}
.inversor-card-azul:hover {
    border-color: #0096df;
    box-shadow: 0 12px 32px #18438f33;
    transform: translateY(-8px) scale(1.04) rotate(-1deg);
}
.inversor-img-wrapper-azul {
    min-height: 160px;
    background: linear-gradient(90deg, #18438f 10%, #0096df 90%);
    border-radius: 2rem 2rem 0 0;
    transition: background 0.3s;
}
.inversor-card-azul:hover .inversor-img-wrapper-azul {
    background: linear-gradient(90deg, #0096df 10%, #18438f 90%);
}
.inversor-img-azul {
    filter: drop-shadow(0 4px 12px #18438f33);
    transition: filter 0.3s;
}
.inversor-card-azul:hover .inversor-img-azul {
    filter: drop-shadow(0 8px 24px #0096df66);
}
.inversor-title-azul {
    letter-spacing: 0.5px;
    color: #18438f;
}
.badge-destaque-azul {
    background: linear-gradient(90deg, #18438f 60%, #0096df 100%);
    color: #fff;
    font-size: 1rem;
    z-index: 3;
    border-radius: 2rem;
    box-shadow: 0 2px 8px #18438f33;
}
.inversor-badge-azul {
    background: #e3edfa;
    color: #18438f;
    font-weight: 500;
}
.inversor-badge2-azul {
    background: #d1f2ff;
    color: #0096df;
    font-weight: 500;
}
.inversor-btn-azul {
    border-color: #0096df;
    color: #0096df;
}
.inversor-btn-azul:hover {
    background: #0096df;
    color: #fff;
}
.btn-inversor-azul {
    background: linear-gradient(90deg, #18438f 60%, #0096df 100%);
    border: none;
    color: #fff;
    transition: background 0.3s;
}
.btn-inversor-azul:hover {
    background: linear-gradient(90deg, #0096df 60%, #18438f 100%);
    color: #fff;
}
</style>

<script>
document.querySelectorAll('.solicitar-inversor-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        var isLogged = <?php echo isset($_SESSION['usuario_id']) ? 'true' : 'false'; ?>;
        if (!isLogged) {
            var modalFalha = new bootstrap.Modal(document.getElementById('modalFalhaInversor'));
            modalFalha.show();
        } else {
            document.getElementById('inversorIdInput').value = this.dataset.inversor;
            var modalSolicitar = new bootstrap.Modal(document.getElementById('modalSolicitarInversor'));
            modalSolicitar.show();
        }
    });
});

// AJAX para envio do formulário (opcional)
<?php if (isset($_SESSION['usuario_id'])): ?>
document.getElementById('formSolicitarInversor').addEventListener('submit', function(e) {
    e.preventDefault();
    var inversor_id = document.getElementById('inversorIdInput').value;
    var mensagem = document.getElementById('mensagemInversor').value;
    fetch('solicitar_preco_ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'inversor_id=' + encodeURIComponent(inversor_id) + '&mensagem=' + encodeURIComponent(mensagem)
    })
    .then(response => response.json())
    .then(data => {
        var modalSolicitar = bootstrap.Modal.getInstance(document.getElementById('modalSolicitarInversor'));
        if (modalSolicitar) modalSolicitar.hide();
        if(data.sucesso){
            var modalSucesso = new bootstrap.Modal(document.getElementById('modalSucessoInversor'));
            modalSucesso.show();
        } else {
            var modalFalha = new bootstrap.Modal(document.getElementById('modalFalhaInversor'));
            modalFalha.show();
        }
    })
    .catch(() => {
        var modalSolicitar = bootstrap.Modal.getInstance(document.getElementById('modalSolicitarInversor'));
        if (modalSolicitar) modalSolicitar.hide();
        var modalFalha = new bootstrap.Modal(document.getElementById('modalFalhaInversor'));
        modalFalha.show();
    });
});
document.querySelectorAll('.adicionar-cotacao-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const produto = {
            id: this.dataset.produtoId,
            categoria: this.dataset.produtoCategoria,
            nome: this.dataset.produtoNome,
            img: this.dataset.produtoImg,
            capacidade: this.dataset.produtoCapacidade
        };
        let cotacao = JSON.parse(localStorage.getItem('cotacao')) || [];
        // Verifica duplicidade por id + categoria
        if (!cotacao.some(item => item.id == produto.id && item.categoria == produto.categoria)) {
            cotacao.push(produto);
            localStorage.setItem('cotacao', JSON.stringify(cotacao));
            alert('Produto adicionado à cotação!');
        } else {
            alert('Produto já está na cotação.');
        }
    });
});
<?php endif; ?>
</script>
<?php include '../templates/rodape.php'; ?>
