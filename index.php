<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relato de Mobilidade | Gestão Urbana</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e293b;
            --accent: #2563eb;
            --bg-gradient: linear-gradient(135deg, #f1f5f9 0%, #cbd5e1 100%);
            --card-bg: #ffffff;
            --input-border: #e2e8f0;
            --text-main: #334155;
            --text-muted: #64748b;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg-gradient); 
            margin: 0; padding: 20px; 
            display: flex; justify-content: center; align-items: center; 
            min-height: 100vh; color: var(--text-main);
        }

        .container { 
            width: 100%; max-width: 500px;
            background: var(--card-bg); padding: 40px; 
            border-radius: 28px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .form-header { text-align: center; margin-bottom: 30px; }
        .form-header h1 { margin: 0; font-size: 26px; font-weight: 700; color: var(--primary); }
        .form-header p { color: var(--text-muted); font-size: 14px; margin-top: 6px; }

        .group { margin-bottom: 18px; }
        label { display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); }

        input[type="text"], input[type="tel"], select, textarea {
            width: 100%; padding: 14px; border: 1.5px solid var(--input-border);
            border-radius: 12px; font-size: 15px; font-family: inherit;
            transition: all 0.2s ease; background-color: #f8fafc;
        }

        input:focus, select:focus, textarea:focus {
            outline: none; border-color: var(--accent);
            background-color: #fff; box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        /* Container de Opções Dinâmicas baseadas na categoria */
        .options-container {
            background: #f1f5f9; padding: 18px; 
            border-radius: 16px; margin-top: 5px;
            display: none; /* Inicia escondido */
        }

        .options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .option { display: flex; align-items: center; font-size: 14px; cursor: pointer; font-weight: 500; }
        .option input { width: 18px; height: 18px; margin-right: 10px; accent-color: var(--accent); }

        /* Botões */
        .btn-submit {
            background: var(--accent); color: white; border: none; 
            padding: 18px; width: 100%; border-radius: 14px; 
            font-size: 16px; font-weight: 700; cursor: pointer; 
            margin-top: 25px; transition: 0.3s;
        }
        .btn-submit:hover { background: #1d4ed8; transform: translateY(-2px); }

        .btn-dashboard {
            display: block; text-align: center; margin-top: 15px; 
            padding: 14px; background: #f1f5f9; color: #475569; 
            text-decoration: none; border-radius: 12px; font-size: 14px; 
            font-weight: 600; transition: 0.3s; border: 1px solid #e2e8f0;
        }
        .btn-dashboard:hover { background: #e2e8f0; color: var(--primary); }
    </style>
</head>
<body>

<div class="container">
    <div class="form-header">
        <h1>📍 Mobilidade Urbana</h1>
        <p>Relate problemas e ajude a melhorar sua cidade</p>
    </div>
    
    <form action="processar.php" method="POST">
        <div class="group">
            <label>👤 Seu Nome</label>
            <input type="text" name="nome" placeholder="Ex: João Silva" required>
        </div>

        <div class="group">
            <label>📞 Telefone de Contato</label>
            <input type="tel" name="telefone" placeholder="(00) 00000-0000">
        </div>

        <div class="group">
            <label>🗺️ Local do Problema</label>
            <input type="text" name="local_ref" placeholder="Rua, número ou referência" required>
        </div>

        <div class="group">
            <label>⚠️ Categoria da Ocorrência</label>
            <select name="tipo" id="tipoSelect" onchange="mostrarProblemas()" required>
                <option value="">Selecione...</option>
                <option value="transito">🚦 Fluxo de Trânsito</option>
                <option value="estacionamento">🅿️ Estacionamento / Vagas</option>
            </select>
        </div>

        <div id="containerProblemas" class="options-container">
            <label>🛠️ Marque os problemas identificados</label>
            <div id="gridProblemas" class="options-grid"></div>
        </div>

        <div class="group" style="margin-top: 20px;">
            <label>📝 Informações Adicionais</label>
            <textarea name="descricao" rows="3" placeholder="Detalhes opcionais..."></textarea>
        </div>

        <button type="submit" class="btn-submit">Enviar Relatório</button>
    </form>

    <a href="login.php" class="btn-dashboard">🛡️ Acessar Painel Administrativo</a>
</div>

<script>
function mostrarProblemas() {
    const tipo = document.getElementById('tipoSelect').value;
    const container = document.getElementById('containerProblemas');
    const grid = document.getElementById('gridProblemas');
    
    grid.innerHTML = ''; // Limpa antes de preencher

    const dados = {
        'transito': ['Sinalização Ruim', 'Semáforo Quebrado', 'Engarrafamento', 'Falta de Faixa'],
        'estacionamento': ['Vaga Obstruída', 'Estacionamento Irregular', 'Falta de Vaga Idoso', 'Carga e Descarga']
    };

    if (tipo && dados[tipo]) {
        container.style.display = 'block';
        dados[tipo].forEach(item => {
            const label = document.createElement('label');
            label.className = 'option';
            label.innerHTML = `<input type="checkbox" name="problemas[]" value="${item}"> ${item}`;
            grid.appendChild(label);
        });
    } else {
        container.style.display = 'none';
    }
}
</script>

</body>
</html>