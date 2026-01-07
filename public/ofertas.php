<?php 
// Incluir arquivo de inicialização
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
}
include_once '../templates/menu.php';
?>

<section class="container py-5">
    <h1 class="fw-bold mb-5 text-center"
        style="font-size: 2.2rem; background: linear-gradient(90deg, #18438f 40%, #0096df 80%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; color: transparent;">
        Ofertas Especiais
    </h1>

    <div class="row g-4">
        <!-- Exemplo de oferta -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="oferta-card shadow-lg rounded-4 bg-white position-relative h-100 d-flex flex-column border border-primary">
                <span class="badge oferta-badge-azul position-absolute top-0 start-0 m-3 px-3 py-2 shadow" style="font-size:1rem; z-index:3;">
                    <i class="fas fa-fire"></i> Oferta do Dia
                </span>
                <div class="oferta-img-wrapper d-flex justify-content-center align-items-center py-4">
                    <img src="../assets/images/painel1.png" alt="Painel Solar" class="img-fluid" style="max-height: 120px;">
                </div>
                <div class="px-4 pb-4 flex-grow-1 d-flex flex-column">
                    <h5 class="fw-bold mb-2 text-center" style="color:#18438f;">Painel Solar 415W</h5>
                    <p class="text-muted small text-center mb-2">Alta eficiência, 25 anos de garantia.</p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                       <!-- <span class="badge bg-secondary-subtle text-secondary"><del>Kz 1.999,00</del></span>
                        <span class="badge oferta-preco-azul text-white fw-bold" style="font-size:1.1rem;">Kz 1.499,00</span>-->
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-auto">
                        <a href="../assets/pdfs/painel6.pdf" target="_blank" class="btn btn-outline-primary rounded-pill fw-bold">
                            <i class="fas fa-file-pdf me-1"></i> Ficha Técnica
                        </a>
                        <button class="btn btn-oferta-azul rounded-pill fw-bold solicitar-oferta-btn">
                            <i class="fas fa-shopping-cart me-1"></i> Aproveitar Oferta
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Repita o bloco acima para outras ofertas -->
    </div>
</section>

<style>
.oferta-card {
    border: 2px solid #18438f33;
    background: #f7faff;
    min-height: 380px;
    transition: box-shadow 0.3s, border 0.3s;
}
.oferta-card:hover {
    border-color: #0096df;
    box-shadow: 0 8px 32px #0096df33;
}
.oferta-img-wrapper {
    min-height: 120px;
    background: linear-gradient(90deg, #e3edfa 60%, #f7faff 100%);
    border-radius: 1rem 1rem 0 0;
}
.oferta-badge-azul {
    background: linear-gradient(90deg, #18438f 60%, #0096df 100%);
    color: #fff;
}
.oferta-preco-azul {
    background: linear-gradient(90deg, #18438f 60%, #0096df 100%);
    color: #fff;
}
.btn-oferta-azul {
    background: linear-gradient(90deg, #18438f 60%, #0096df 100%);
    border: none;
    color: #fff;
    transition: background 0.3s;
}
.btn-oferta-azul:hover {
    background: linear-gradient(90deg, #0096df 60%, #18438f 100%);
    color: #fff;
}
</style>

<script>
document.querySelectorAll('.solicitar-oferta-btn').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        alert('Oferta aproveitada! Em breve entraremos em contato.');
        // Aqui você pode abrir um modal ou enviar um AJAX, se desejar.
    });
});
</script>

<?php include '../templates/rodape.php'; ?>