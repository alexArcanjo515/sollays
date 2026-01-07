<?php
// Incluir arquivo de inicialização
if (file_exists(__DIR__ . '/../templates/init.php')) {
    include_once __DIR__ . '/../templates/init.php';
} else {
    session_start();
}

// Variáveis de controle
$erro = '';
$sucesso = '';

// Processar o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conexao, $_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validar campos vazios
    if (empty($email) || empty($password)) {
        $erro = 'Por favor, preencha todos os campos!';
    } else {
        // Buscar usuário no banco de dados
        $query = "SELECT id, username, email, password FROM clientes WHERE email = '$email' LIMIT 1";
        $resultado = mysqli_query($conexao, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $usuario_dados = mysqli_fetch_assoc($resultado);
            
            // Verificar a senha
            if (password_verify($password, $usuario_dados['password'])) {
                // Login bem sucedido
                $_SESSION['usuario_id'] = $usuario_dados['id'];
                $_SESSION['usuario_nome'] = $usuario_dados['username'];
                $_SESSION['usuario_email'] = $usuario_dados['email'];
                
                header('Location: index.php');
                exit();
            } else {
                $erro = 'Senha incorreta!';
            }
        } else {
            $erro = 'Usuário não encontrado!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sollays</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #45a049;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-links {
            text-align: center;
            margin-top: 20px;
        }

        .form-links a {
            color: #4CAF50;
            text-decoration: none;
            margin: 0 10px;
        }

        .form-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include '../templates/menu.php'; ?>

    <div class="login-container">
        <h2>Login</h2>

        <?php if ($erro): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <?php if ($sucesso): ?>
            <div class="sucesso"><?php echo $sucesso; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <div class="form-links">
            <p>Não tem conta? <a href="register.php">Registre-se aqui</a></p>
        </div>
    </div>

    <?php include '../templates/rodape.php'; ?>
</body>
</html>
