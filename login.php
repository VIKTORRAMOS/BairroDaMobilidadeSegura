<?php
session_start();

// Configuração de acesso
$senha_definida = "1234"; // Altere para a sua senha de preferência

if (isset($_POST['senha'])) {
    if ($_POST['senha'] === $senha_definida) { 
        $_SESSION['logado'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Senha incorreta! Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Gestão de Mobilidade</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --bg: #f1f4f8;
            --danger: #e74c3c;
        }

        body { 
            font-family: 'Segoe UI', sans-serif; 
            background-color: var(--bg); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0;
        }

        .login-card { 
            background: white; 
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
            width: 100%; 
            max-width: 350px; 
            text-align: center;
        }

        .icon-lock {
            font-size: 50px;
            margin-bottom: 20px;
            display: inline-block;
        }

        h2 { 
            color: var(--primary); 
            margin: 0 0 10px 0; 
            font-size: 22px;
        }

        p { 
            color: #7f8c8d; 
            font-size: 14px; 
            margin-bottom: 30px;
        }

        .error-msg {
            background: #fff5f5;
            color: var(--danger);
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #fed7d7;
        }

        label {
            display: block;
            text-align: left;
            font-weight: 600;
            font-size: 13px;
            color: var(--primary);
            margin-bottom: 8px;
        }

        input[type="password"] { 
            width: 100%; 
            padding: 14px; 
            margin-bottom: 20px; 
            border: 1px solid #dee2e6; 
            border-radius: 10px; 
            box-sizing: border-box; 
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--accent);
        }

        button { 
            width: 100%; 
            padding: 14px; 
            background: var(--accent); 
            color: white; 
            border: none; 
            border-radius: 10px; 
            font-size: 16px; 
            font-weight: bold;
            cursor: pointer; 
            transition: background 0.3s, transform 0.2s;
        }

        button:hover { 
            background: #2980b9; 
            transform: translateY(-2px);
        }

        .back-link {
            display: block;
            margin-top: 25px;
            text-decoration: none;
            color: #95a5a6;
            font-size: 13px;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="icon-lock">🔐</div>
    <h2>Acesso Restrito</h2>
    <p>Área exclusiva para administradores da Mobilidade Urbana.</p>

    <?php if(isset($erro)): ?>
        <div class="error-msg"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Chave de Acesso</label>
        <input type="password" name="senha" placeholder="Digite a senha" required autofocus>
        <button type="submit">Entrar no Painel</button>
    </form>

    <a href="index.php" class="back-link">← Voltar ao Formulário Público</a>
</div>

</body>
</html>