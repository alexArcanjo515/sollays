<?php
// Incluir arquivo de inicialização
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
} else {
    session_start();
}

// Exemplo de produtos de baterias
$baterias = [
    [
        'id' => 1,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria.png',
        'pdf' => '../assets/pdfs/bateria1.pdf',
        'nome' => 'SS-V-48-200/250/300',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '<br><br>10240 Wh <br>12800 Wh <br>15360 Wh',
        'garantia' => '10 anos',
        'destaque' => true,
    ],
    [
        'id' => 2,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria1.png',
        'pdf' => '../assets/pdfs/bateria2.pdf',
        'nome' => 'SS-V-48-200/250/300',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '<br><br>5120 Wh <br>6400 Wh <br>7680 Wh',
        'garantia' => '5 anos',
        'destaque' => false,
    ],
    [
        'id' => 3,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria2.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'SS-V-24-100/120',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '2560 Wh <br>3507 Wh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],

    [
        'id' => 4,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria3.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'SS-V-48-100',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '2560 Wh <br>3507 Wh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],
     [
        'id' => 5,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria4.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'SMART-SS-V-48-100(P)',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '5120 Wh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],
       [
        'id' => 6,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria5.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'SMART-SS-V-48-200/250/300(P)',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '10240 Wh <br>12800 Wh <br>15360 Wh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],
        [
        'id' => 7,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria6.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'SS-UU 48-200/250/300',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '10240 Wh <br>12800 Wh <br>15360 Wh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],   
       [
        'id' => 8,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria7.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'SS-UU 24-200/250/300',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '5120 Wh <br>6400 Wh <br>7680 Wh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],
        [
        'id' => 9,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria8.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'UU 12-200/250/300',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '2560 Wh <br>3200 Wh <br>3840 Wh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],
           [
        'id' => 10,
        'categoria' => 'bateria',
        'img' => '../assets/images/bateria9.png',
        'pdf' => '../assets/pdfs/bateria3.pdf',
        'nome' => 'CAIXA DE CARBONO',
        'descricao' => 'Bateria Solar LiFePO4',
        'capacidade' => '1.5 kwh',
        'garantia' => '6 anos',
        'destaque' => false,
    ],
];
include_once '../templates/menu.php';
?>

<section class="container py-5">
    <h1 class="fw-bold mb-5 text-center"
        style="font-size: 2.2rem; background: linear-gradient(90deg, #18438f 40%, #0096df 80%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
        Baterias Solares
    </h1>

    <div class="row g-4 justify-content-center">
        <?php foreach ($baterias as $bateria): ?>
        <div class="col-xl-4 col-md-6 col-12">
            <div class="battery-card shadow-lg rounded-4 bg-light position-relative h-100 d-flex flex-column">
                <?php if ($bateria['destaque']): ?>
                    <span class="badge badge-destaque-azul position-absolute top-0 end-0 m-3 px-3 py-2 shadow" style="font-size:1rem; z-index:3;">
                        <i class="fas fa-bolt"></i> Destaque
                    </span>
                <?php endif; ?>
                <div class="battery-img-wrapper d-flex justify-content-center align-items-center py-4">
                    <img src="<?php echo $bateria['img']; ?>" alt="<?php echo strip_tags($bateria['nome']); ?>" class="img-fluid" style="max-height: 240px;">
                </div>
                <div class="px-4 pb-4 flex-grow-1 d-flex flex-column">
                    <h5 class="fw-bold mb-2 text-center inversor-title-azul"><?php echo $bateria['nome']; ?></h5>
                    <p class="text-muted small text-center mb-2"><?php echo $bateria['descricao']; ?></p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="badge inversor-badge-azul"><i class="fas fa-battery-full me-1"></i> <?php echo $bateria['capacidade']; ?></span>
                        <span class="badge inversor-badge2-azul"><i class="fas fa-shield-alt me-1"></i> <?php echo $bateria['garantia']; ?> garantia</span>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-auto">
                        <a href="<?php echo $bateria['pdf']; ?>" target="_blank" class="btn btn-outline-primary rounded-pill fw-bold inversor-btn-azul">
                            <i class="fas fa-file-pdf me-1"></i> Ficha Técnica
                        </a>
                       
                        <button
                            class="btn btn-primary adicionar-cotacao-btn btn btn-inversor-azul rounded-pill fw-bold"
                            data-produto-id="<?php echo $bateria['id']; ?>"
                            data-produto-categoria="bateria"
                            data-produto-img="<?php echo $bateria['img']; ?>"
                            data-produto-nome="<?php echo htmlspecialchars($bateria['nome']); ?>"
                            data-produto-capacidade="<?php echo strip_tags($bateria['capacidade']); ?>"
                        >
                         <i class="fas fa-tag me-1"></i>
                            Adicionar à Cotação
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Modal Solicitar Preço Bateria -->
<div class="modal fade" id="modalSolicitarBateria" tabindex="-1" aria-labelledby="modalSolicitarBateriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalSolicitarBateriaLabel"><i class="fas fa-tag me-2"></i>Solicitar Preço</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <form id="formSolicitarBateria" method="post" action="solicitar_preco.php">
        <div class="modal-body">
          <?php if (isset($_SESSION['usuario_id'])): ?>
            <input type="hidden" name="bateria_id" id="bateriaIdInput">
            <div class="mb-3">
              <label for="mensagemBateria" class="form-label">Mensagem (opcional):</label>
              <textarea class="form-control" name="mensagem" id="mensagemBateria" rows="3" placeholder="Deseja informar algo?"></textarea>
            </div>
          <?php else: ?>
            <div class="alert alert-warning mb-0">
              Você precisa <a href="login.php" class="alert-link">fazer login</a> para solicitar preço.
            </div>
          <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success rounded-pill fw-bold">
            <i class="fas fa-paper-plane me-1"></i> Enviar Solicitação
          </button>
        </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>

<!-- Modal Sucesso -->
<div class="modal fade" id="modalSucessoBateria" tabindex="-1" aria-labelledby="modalSucessoBateriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalSucessoBateriaLabel"><i class="fas fa-check-circle me-2"></i>Solicitação enviada</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Solicitação feita com sucesso! Entraremos em contato por e-mail.</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal Falha -->
<div class="modal fade" id="modalFalhaBateria" tabindex="-1" aria-labelledby="modalFalhaBateriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalFalhaBateriaLabel"><i class="fas fa-times-circle me-2"></i>Solicitação não efetuada</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Você precisa estar logado para solicitar preço.</p>
      </div>
    </div>
  </div>
</div>

<style>
.battery-card {
    border: 2px solid #18438f33;
    background: #f7faff;
    min-height: 420px;
    transition: box-shadow 0.3s, border 0.3s;
}
.battery-card:hover {
    border-color: #0096df;
    box-shadow: 0 8px 32px #0096df33;
}
.battery-img-wrapper {
    min-height: 160px;
    background: linear-gradient(90deg, #e3edfa 60%, #f7faff 100%);
    border-radius: 1rem 1rem 0 0;
}
.badge-destaque-azul {
    background: linear-gradient(90deg, #18438f 60%, #0096df 100%);
    color: #fff;
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
document.querySelectorAll('.solicitar-bateria-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        var isLogged = <?php echo isset($_SESSION['usuario_id']) ? 'true' : 'false'; ?>;
        if (!isLogged) {
            var modalFalha = new bootstrap.Modal(document.getElementById('modalFalhaBateria'));
            modalFalha.show();
        } else {
            document.getElementById('bateriaIdInput').value = this.dataset.bateria;
            var modalSolicitar = new bootstrap.Modal(document.getElementById('modalSolicitarBateria'));
            modalSolicitar.show();
        }
    });
});

// AJAX para envio do formulário (opcional, se quiser usar AJAX)
<?php if (isset($_SESSION['usuario_id'])): ?>
document.getElementById('formSolicitarBateria').addEventListener('submit', function(e) {
    e.preventDefault();
    var bateria_id = document.getElementById('bateriaIdInput').value;
    var mensagem = document.getElementById('mensagemBateria').value;
    fetch('solicitar_preco_ajax.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'bateria_id=' + encodeURIComponent(bateria_id) + '&mensagem=' + encodeURIComponent(mensagem)
    })
    .then(response => response.json())
    .then(data => {
        var modalSolicitar = bootstrap.Modal.getInstance(document.getElementById('modalSolicitarBateria'));
        if (modalSolicitar) modalSolicitar.hide();
        if(data.sucesso){
            var modalSucesso = new bootstrap.Modal(document.getElementById('modalSucessoBateria'));
            modalSucesso.show();
        } else {
            var modalFalha = new bootstrap.Modal(document.getElementById('modalFalhaBateria'));
            modalFalha.show();
        }
    })
    .catch(() => {
        var modalSolicitar = bootstrap.Modal.getInstance(document.getElementById('modalSolicitarBateria'));
        if (modalSolicitar) modalSolicitar.hide();
        var modalFalha = new bootstrap.Modal(document.getElementById('modalFalhaBateria'));
        modalFalha.show();
    });
});
<?php endif; ?>

// Adiciona produto à cotação no localStorage
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
        // Evita duplicidade por id + categoria
        if (!cotacao.some(item => item.id == produto.id && item.categoria == produto.categoria)) {
            cotacao.push(produto);
            localStorage.setItem('cotacao', JSON.stringify(cotacao));
            alert('Produto adicionado à cotação!');
        } else {
            alert('Produto já está na cotação.');
        }
    });
});
</script>
<?php include '../templates/rodape.php'; ?>
