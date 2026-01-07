<?php
// Incluir arquivo de inicialização
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
} else {
    session_start();
}

// Exemplo de produtos
$produtos = [
    [
        'id' => 1,
        'categoria' => 'painel',
        'img' => '../assets/images/painel1.png',
        'pdf' => '../assets/pdfs/painel6.pdf',
        'nome' => 'Módulo de estrutura preta bifacial monocristalina TOPCOn <br> 415~435W',
        'descricao' => ' SSM10NHB-108',
        'destaque' => false,
    ],
    [
        'id' => 2,
        'categoria' => 'painel',
        'img' => '../assets/images/painel6.png',
        'pdf' => '../assets/pdfs/painel2.pdf',
        'nome' => 'Módulo bifacial monocristalino TOPCon<br><br>465~485W SSM10NHB-120',
        'descricao' => 'Painel robusto, ideal para grandes projetos residenciais e comerciais.',
        'destaque' => false,
    ],
    [
        'id' => 3,
        'categoria' => 'painel',
        'img' => '../assets/images/painel7.png',
        'pdf' => '../assets/pdfs/painel3.pdf',
        'nome' => ' Módulo bifacial monocristalino TOPCon <br><br>560~580W SSM10NHB-144',
        'descricao' => 'Módulo bifacial monocristalino TOPCon',
        'destaque' => true,
    ],
    [
        'id' => 4,
        'categoria' => 'painel',
        'img' => '../assets/images/painel8.png',
        'pdf' => '../assets/pdfs/painel4.pdf',
        'nome' => 'Módulo bifacial monocristalino TOPCon<br><br> 680~700W SSG12NHB-132',
        'descricao' => 'Painel eficiente para uso residencial, com 25 anos de garantia.',
        'destaque' => false,
    ],
    [
        'id' => 5,
        'categoria' => 'painel',
        'img' => '../assets/images/painel9.png',
        'pdf' => '../assets/pdfs/painel5.pdf',
        'nome' => ' Módulo de meio corte monocristalino <br><br>405~425W SSM10PH-108',
        'descricao' => 'Solução econômica para quem busca qualidade e desempenho.',
        'destaque' => false,
    ],
    [
        'id' => 6,
        'categoria' => 'painel',
        'img' => '../assets/images/painel8.png',
        'pdf' => '../assets/pdfs/painel8.pdf',
        'nome' => ' Módulo de meio corte monocristalino <br><br> 455~475W SSM10PH-120',
        'descricao' => 'Ideal para espaços menores, mantendo alta eficiência.',
        'destaque' => false,
    ],
        [
        'id' => 7,
        'categoria' => 'painel',
        'img' => '../assets/images/painel10.png',
        'pdf' => '../assets/pdfs/painel8.pdf',
        'nome' => 'Módulo de meio corte monocristalino <br><br> 485~505W SSG12PH-100',
        'descricao' => 'Ideal para espaços menores, mantendo alta eficiência.',
        'destaque' => false,
    ],

         [
        'id' => 8,
        'categoria' => 'painel',
        'img' => '../assets/images/painel11.png',
        'pdf' => '../assets/pdfs/painel8.pdf',
        'nome' => 'Módulo de meio corte monocristalino<br><br>  485~505W SSG12PT-150',
        'descricao' => 'Ideal para espaços menores, mantendo alta eficiência.',
        'destaque' => false,
    ],
           [
        'id' => 9,
        'categoria' => 'painel',
        'img' => '../assets/images/painel12.png',
        'pdf' => '../assets/pdfs/painel8.pdf',
        'nome' => 'Módulo de meio corte monocristalino<br><br>545~565W SSM10PH-144',
        'descricao' => 'Ideal para espaços menores, mantendo alta eficiência.',
        'destaque' => false,
    ],
              [
        'id' => 10,
        'categoria' => 'painel',
        'img' => '../assets/images/painel13.png',
        'pdf' => '../assets/pdfs/painel8.pdf',
        'nome' => 'Módulo de meio corte monocristalino<br><br> 590~610W SSG12PH-120',
        'descricao' => 'Ideal para espaços menores, mantendo alta eficiência.',
        'destaque' => false,
    ],
                [
        'id' => 11,
        'categoria' => 'painel',
        'img' => '../assets/images/painel14.png',
        'pdf' => '../assets/pdfs/painel8.pdf',
        'nome' => 'Módulo de meio corte monocristalino <br><br>  650~670W SSG12PH-132',
        'descricao' => 'Ideal para espaços menores, mantendo alta eficiência.',
        'destaque' => false,
    ],
                  [
        'id' => 12,
        'categoria' => 'painel',
        'img' => '../assets/images/painel15.png',
        'pdf' => '../assets/pdfs/painel8.pdf',
        'nome' => 'Módulos Personalizados<br><br>  10~360W SSG12PH-132',
        'descricao' => 'Ideal para espaços menores, mantendo alta eficiência.',
        'destaque' => false,
    ],
];
include_once '../templates/menu.php';

?>

<section class="container py-5">
    <h1 class="fw-bold mb-5 text-center"
        style="font-size: 2.2rem; background: linear-gradient(90deg, #18438f 40%, #0096df 80%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;"
        data-aos="fade-up">
        Nossos Painéis Solares
    </h1>

    <!-- Área de Destaques -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="p-4 rounded-4 shadow-lg bg-white d-flex flex-wrap align-items-center justify-content-between" data-aos="fade-right">
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <i class="fas fa-star fa-2x text-warning me-3"></i>
                    <div>
                        <h4 class="fw-bold mb-1" style="color:#18438f;">Destaque: Painel Solar 560~580W</h4>
                        <p class="mb-0 text-muted" style="max-width: 400px;">
                            Alta eficiência, excelente desempenho em baixa luminosidade e 25 anos de garantia de performance linear.
                        </p>
                    </div>
                </div>
                <div>
                    <a href="../assets/pdfs/painel6.pdf" target="_blank" class="btn btn-outline-primary rounded-pill fw-bold me-2">
                        <i class="fas fa-file-pdf me-1"></i> Ficha Técnica
                    </a>
                    <a href="#" class="btn btn-primary rounded-pill fw-bold destaque-preco-btn" style="background: linear-gradient(90deg, #18438f 60%, #0096df 100%); border: none;" data-produto="1">
                        <i class="fas fa-tag me-1"></i> Solicitar Preço
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards dos Produtos -->
    <div class="row g-4">
        <?php foreach ($produtos as $produto) { ?>
        <div class="col-lg-4 col-md-6 col-12" data-aos="zoom-in">
            <div class="card border-0 shadow-lg h-100 position-relative painel-card overflow-visible bg-white rounded-4">
                <?php if (!empty($produto['destaque'])): ?>
                    <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 px-3 py-2 shadow" style="font-size:1rem; z-index:3;">
                        <i class="fas fa-star"></i> Destaque
                    </span>
                <?php endif; ?>
                <div class="painel-img-wrapper-real position-relative d-flex justify-content-center align-items-center bg-white">
                    <img src="<?php echo $produto['img']; ?>" class="card-img-top img-fluid" alt="<?php echo $produto['nome']; ?>" style="max-width:100%; height:auto; display:block;">
                    <div class="painel-hover d-flex flex-column justify-content-center align-items-center">
                        <a href="<?php echo $produto['pdf']; ?>" target="_blank" class="btn btn-light rounded-circle mb-3 shadow painel-pdf-btn" title="Abrir Ficha Técnica">
                            <i class="fas fa-file-pdf fa-2x text-danger"></i>
                        </a>
                        <button class="btn btn-primary rounded-pill fw-bold painel-preco-btn mb-2" 
                                style="background: linear-gradient(90deg, #18438f 60%, #0096df 100%); border: none;"
                                data-produto="<?php echo $produto['id']; ?>"
                                data-nome="<?php echo htmlspecialchars($produto['nome']); ?>">
                            <i class="fas fa-tag me-2"></i>Solicitar Preço
                        </button>
                        <button
                            class="btn btn-success rounded-pill fw-bold adicionar-cotacao-btn mb-2"
                            data-produto-id="<?php echo $produto['id']; ?>"
                            data-produto-categoria="painel"
                            data-produto-img="<?php echo $produto['img']; ?>"
                            data-produto-nome="<?php echo htmlspecialchars(strip_tags($produto['nome'])); ?>"
                            data-produto-capacidade="<?php echo htmlspecialchars(strip_tags($produto['descricao'])); ?>"
                        >
                            <i class="fas fa-list me-1"></i> Adicionar à Cotação
                        </button>
                        <a href="<?php echo $produto['pdf']; ?>" target="_blank" class="btn btn-outline-secondary rounded-pill fw-bold painel-info-btn" 
                                title="Mais informações">
                            <i class="fas fa-info-circle me-1"></i> Detalhes
                        </a>
                    </div>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold mb-2" style="font-size:1.2rem;"><?php echo $produto['nome']; ?></h5>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary">25 anos garantia</span>
                        <span class="badge bg-success bg-opacity-10 text-success">Alta eficiência</span>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<!-- Modal Solicitar Preço -->
<div class="modal fade" id="modalSolicitarPreco" tabindex="-1" aria-labelledby="modalSolicitarPrecoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalSolicitarPrecoLabel"><i class="fas fa-tag me-2"></i>Solicitar Preço</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <form id="formSolicitarPreco" method="post" action="#">
        <div class="modal-body">
          <?php if ($usuario_logado): ?>
            <input type="hidden" name="produto_id" id="produtoIdInput">
            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
            <div class="mb-3">
              <label for="mensagem" class="form-label">Mensagem (opcional):</label>
              <textarea class="form-control" name="mensagem" id="mensagem" rows="3" placeholder="Deseja informar algo?"></textarea>
            </div>
          <?php else: ?>
            <div class="alert alert-warning mb-0">
              Você precisa <a href="login.php" class="alert-link">fazer login</a> para solicitar preço.
            </div>
          <?php endif; ?>
        </div>
        <?php if ($usuario_logado): ?>
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
<div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalSucessoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalSucessoLabel"><i class="fas fa-check-circle me-2"></i>Solicitação enviada</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Solicitação feita com sucesso! Entraremos em contacto por e-mail.</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal Falha -->
<div class="modal fade" id="modalFalha" tabindex="-1" aria-labelledby="modalFalhaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalFalhaLabel"><i class="fas fa-times-circle me-2"></i>Solicitação não efetuada</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-0">Você precisa estar logado para solicitar preço.</p>
      </div>
    </div>
  </div>
</div>

<style>
.painel-img-wrapper-real {
    overflow: visible;
    border-radius: 1rem 1rem 0 0;
    position: relative;
    background: #fff;
    min-height: 40px;
    padding: 20px 0 10px 0;
}
.painel-img-wrapper-real img {
    max-width: 100%;
    height: auto;
    display: block;
    box-shadow: 0 2px 12px #18438f11;
    background: #fff;
    border-radius: 0.5rem;
    transition: transform 0.5s cubic-bezier(.4,2,.3,1);
}
.painel-card:hover .painel-img-wrapper-real img {
    transform: scale(1.04) rotate(-1deg);
    filter: brightness(0.92);
}
.painel-hover {
    position: absolute;
    inset: 0;
    background: rgba(24,67,143,0.82);
    opacity: 0;
    transition: opacity 0.4s;
    z-index: 2;
    border-radius: 1rem 1rem 0 0;
}
.painel-card:hover .painel-hover,
.painel-img-wrapper-real:focus-within .painel-hover {
    opacity: 1;
}
.painel-pdf-btn {
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.painel-preco-btn, .painel-info-btn {
    font-size: 1rem;
    padding: 10px 28px;
    box-shadow: 0 2px 8px #18438f22;
    transition: background 0.3s;
}
.painel-preco-btn:hover {
    background: linear-gradient(90deg, #0096df 60%, #18438f 100%);
}
.painel-info-btn:hover {
    background: #f5f8ff;
    color: #18438f;
}
.card {
    border-radius: 1.25rem;
    transition: box-shadow 0.3s;
}
.card:hover {
    box-shadow: 0 8px 32px #18438f33;
}
.badge {
    font-size: 0.95rem;
    font-weight: 500;
}
</style>

<script>
// Aguardar o DOM estar pronto
document.addEventListener('DOMContentLoaded', function() {
    // Usando apenas Bootstrap e classes JS para abrir os modais
    document.querySelectorAll('.painel-preco-btn, .destaque-preco-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var isLogged = <?php echo $usuario_logado ? 'true' : 'false'; ?>;
            if (!isLogged) {
                // Mostra modal de falha
                var modalFalha = new bootstrap.Modal(document.getElementById('modalFalha'));
                modalFalha.show();
            } else {
                // Preenche o produto_id e mostra modal de solicitação
                document.getElementById('produtoIdInput').value = this.dataset.produto;
                var modalSolicitar = new bootstrap.Modal(document.getElementById('modalSolicitarPreco'));
                modalSolicitar.show();
            }
        });
    });

    // Envio do formulário via AJAX (apenas se logado)
    <?php if ($usuario_logado): ?>
    var formSolicitar = document.getElementById('formSolicitarPreco');
    if (formSolicitar) {
        formSolicitar.addEventListener('submit', function(e) {
            e.preventDefault();
            var produto_id = document.getElementById('produtoIdInput').value;
            var mensagem = document.getElementById('mensagem').value;
            
            fetch('solicitar_preco_ajax.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'produto_id=' + encodeURIComponent(produto_id) + '&mensagem=' + encodeURIComponent(mensagem)
            })
            .then(response => response.json())
            .then(data => {
                var modalSolicitar = bootstrap.Modal.getInstance(document.getElementById('modalSolicitarPreco'));
                if (modalSolicitar) modalSolicitar.hide();
                if(data.sucesso){
                    var modalSucesso = new bootstrap.Modal(document.getElementById('modalSucesso'));
                    modalSucesso.show();
                    // Limpar mensagem
                    document.getElementById('mensagem').value = '';
                } else {
                    var modalFalha = new bootstrap.Modal(document.getElementById('modalFalha'));
                    modalFalha.show();
                }
            })
            .catch((error) => {
                console.error('Erro:', error);
                var modalSolicitar = bootstrap.Modal.getInstance(document.getElementById('modalSolicitarPreco'));
                if (modalSolicitar) modalSolicitar.hide();
                var modalFalha = new bootstrap.Modal(document.getElementById('modalFalha'));
                modalFalha.show();
            });
        });
    }
    <?php endif; ?>

    // Adicionar produto à cotação no localStorage
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
});
</script>
<?php include '../templates/rodape.php'; ?>
