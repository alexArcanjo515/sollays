<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>S.R.ENERGY - Painéis Solares</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <style>

    </style>
</head>

<body>
    <!-- Loader -->
    <div id="loader-bg">
        <div class="loader"></div>
    </div>
    <div style="margin-top: 90px;"></div>
    <div class="top-bar">

    </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand mb-0" href="#">
                    <img src="../assets/images/logo.png" alt="" width="170" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="produtosDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-boxes"></i> Produtos
                            </a>
                            <ul class="dropdown-menu mt-0 border-0 rounded-30 text-center"
                                aria-labelledby="produtosDropdown">
                                <li><a class="dropdown-item" href="../public/painel_solar.php"><i class="fas fa-solar-panel"></i> Painéis
                                        Solares</a></li>
                                <li><a class="dropdown-item" href="../public/baterias.php"><i class="fas fa-battery-full"></i> Baterias</a>
                                </li>
                                <li><a class="dropdown-item" href="../public/inversores.php"><i class="fas fa-bolt"></i> Inversores</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../public/ofertas.php"><i class="fas fa-tags"></i> Ofertas</a>
                        </li>
                        <li class="nav-item position-relative">
                            <span id="cart-count" style="position:absolute;top:-10px;right:10px;z-index:2;background:#dc3545;color:#fff;font-size:13px;padding:2px 7px;border-radius:12px;min-width:22px;text-align:center;display:none;"></span>
                            <a class="nav-link" href="../public/cotacao.php"><i class="fas fa-shopping-cart"></i> Carrinho</a>
                        </li>
                     
                        <li class="nav-item">
                            <a class="nav-link" href="../public/contactos.php"><i class="fas fa-envelope"></i> Contato</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Atualiza o contador do carrinho
        function updateCartCount() {
            let cotacao = [];
            try { cotacao = JSON.parse(localStorage.getItem('cotacao')) || []; } catch(e){}
            const count = cotacao.length;
            const el = document.getElementById('cart-count');
            if (el) {
                el.textContent = count;
                el.style.display = count > 0 ? 'inline-block' : 'none';
            }
        }
        updateCartCount();
        window.addEventListener('storage', updateCartCount);
    });
    </script>
