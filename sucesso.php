<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relato Enviado com Sucesso</title>
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --success: #27ae60;
            --bg: #f1f4f8;
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

        .card {
            background: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
            border-top: 5px solid var(--success);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background-color: var(--success);
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            margin: 0 auto 25px;
        }

        h1 { color: var(--primary); font-size: 24px; margin-bottom: 15px; }
        p { color: #7f8c8d; line-height: 1.6; margin-bottom: 30px; }

        .btn-group { display: flex; gap: 15px; justify-content: center; }

        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-primary { background-color: var(--primary); color: white; }
        .btn-secondary { background-color: #ebf2f7; color: var(--primary); }

        .btn:hover { opacity: 0.8; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="card">
    <div class="icon-box">✓</div>
    <h1>Relato Enviado!</h1>
    <p>Obrigado por colaborar com a <strong>Mobilidade Urbana</strong>. Sua ocorrência foi registrada e será analisada pela equipe técnica.</p>
    
    <div class="btn-group">
        <a href="index.php" class="btn btn-primary">Novo Relato</a>
        <a href="dashboard.php" class="btn btn-secondary">Ir para Painel</a>
    </div>
</div>

</body>
</html>