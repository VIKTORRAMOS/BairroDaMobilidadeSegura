<?php
session_start();

// 1. Verificação de Segurança (Login)
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

// 2. Consulta SQL Otimizada (A parte a ser adicionada/ajustada)
// Esta consulta agrupa os problemas da tabela 'problemas_relatados' em uma única linha
$sql = "SELECT o.*, GROUP_CONCAT(p.problema SEPARATOR ', ') as problemas_marcados 
        FROM ocorrencias o
        LEFT JOIN problemas_relatados p ON o.id = p.ocorrencia_id
        GROUP BY o.id
        ORDER BY o.data_registro DESC";

$resultado = $conn->query($sql);

// 3. Inicialização de segurança para evitar erro de variável indefinida
$total_registros = ($resultado) ? $resultado->num_rows : 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle | Mobilidade Urbana</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e293b;
            --accent: #2563eb;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --bg: #f8fafc;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg); 
            margin: 0; padding: 20px; 
            color: var(--primary);
        }

        .container { 
            max-width: 1200px; margin: auto; 
            background: white; padding: 30px; 
            border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        }

        .header-painel { 
            display: flex; justify-content: space-between; align-items: center; 
            margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #e2e8f0;
        }

        .titulo-container h1 { margin: 0; font-size: 24px; color: var(--primary); }
        .titulo-container p { margin: 5px 0 0; color: #64748b; font-size: 14px; }
        
        .btn-sair { 
            background: var(--primary); color: white; padding: 10px 20px; 
            text-decoration: none; border-radius: 10px; font-size: 14px; font-weight: 600;
        }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }

        th { 
            background-color: #f1f5f9; color: #64748b; 
            padding: 15px; text-align: left; font-size: 11px; 
            text-transform: uppercase; letter-spacing: 1px;
            border-bottom: 1px solid #e2e8f0;
        }

        td { padding: 15px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }

        /* Estilo dos Status */
        .badge {
            padding: 5px 12px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; display: inline-block;
        }
        .status-pendente { background: #fef3c7; color: var(--warning); }
        .status-resolvido { background: #d1fae5; color: var(--success); }
        .status-nao_resolvido { background: #fee2e2; color: var(--danger); }

        /* Botões de Ação */
        .btn-status { 
            text-decoration: none; font-size: 11px; padding: 6px 10px; 
            border: 1px solid #e2e8f0; background: white; color: var(--primary); 
            border-radius: 6px; transition: 0.2s; display: inline-block; margin-right: 4px;
        }
        .btn-status:hover { background: var(--accent); color: white; border-color: var(--accent); }

        .id-pill { background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-weight: 700; color: #475569; }
        .tipo-label { color: var(--accent); font-weight: 700; display: block; margin-bottom: 3px; }
        .problemas-txt { font-size: 12px; color: #64748b; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-painel">
        <div class="titulo-container">
            <h1>📍 Monitoramento de Mobilidade</h1>
            <p>Gestão de ocorrências e infraestrutura do bairro</p>
        </div>
        <a href="logout.php" class="btn-sair">Encerrar Sessão</a>
    </div>

    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Ref</th>
                    <th>Data/Hora</th>
                    <th>Solicitante</th>
                    <th>Localização</th>
                    <th>Tipo / Problema</th>
                    <th>Status</th>
                    <th>Ações de Gestão</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total_registros > 0): ?>
                    <?php while($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><span class="id-pill">#<?php echo $row['id']; ?></span></td>
                            <td>
                                <strong><?php echo date('d/m/Y', strtotime($row['data_registro'])); ?></strong><br>
                                <small style="color:#94a3b8;"><?php echo date('H:i', strtotime($row['data_registro'])); ?></small>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($row['nome']); ?></strong><br>
                                <small><?php echo htmlspecialchars($row['telefone']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($row['local_ref']); ?></td>
                            <td>
                                <span class="tipo-label"><?php echo strtoupper($row['tipo']); ?></span>
                                <span class="problemas-txt">
                                    <?php echo htmlspecialchars($row['problemas_marcados'] ?: 'Nenhum item marcado'); ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge status-<?php echo $row['status']; ?>">
                                    <?php echo str_replace('_', ' ', $row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="atualizar_status.php?id=<?php echo $row['id']; ?>&status=pendente" class="btn-status">Pendente</a>
                                <a href="atualizar_status.php?id=<?php echo $row['id']; ?>&status=resolvido" class="btn-status">Resolvido</a>
                                <a href="atualizar_status.php?id=<?php echo $row['id']; ?>&status=nao_resolvido" class="btn-status">Não Resolvido</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding: 60px; color: #94a3b8;">
                            Nenhum relato encontrado no sistema.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>