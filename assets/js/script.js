document.addEventListener("DOMContentLoaded", function () {
    const detailsData = {
        painel: [
            "Produto: Painel Solar 550W",
            "Alta eficiência para residências e empresas",
            "Garantia de 10 anos",
            "Tecnologia de ponta",
            "Certificação internacional"
        ],
        bateria: [
            "Produto: Bateria Solar 200Ah",
            "Armazene energia com segurança",
            "Alta durabilidade",
            "Tecnologia avançada",
            "Ideal para sistemas off-grid"
        ]
    };

    function updateDetails(type) {
        const ul = document.getElementById("productDetails");
        ul.innerHTML = "";
        detailsData[type].forEach(detail => {
            const li = document.createElement("li");
            li.className = "list-group-item";
            li.textContent = detail;
            ul.appendChild(li);
        });
    }

    // Inicializa com o primeiro slide
    updateDetails("painel");

    // Atualiza ao trocar o slide
    const carousel = document.getElementById("bannerCarousel");
    carousel.addEventListener("slide.bs.carousel", function (event) {
        const next = event.relatedTarget;
        const type = next.getAttribute("data-details");
        updateDetails(type);
    });
});