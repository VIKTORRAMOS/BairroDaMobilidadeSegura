<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $local_ref = $_POST['local_ref'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $status = 'pendente';

    // 1. Insere a ocorrência principal
    $sql = "INSERT INTO ocorrencias (nome, telefone, local_ref, tipo, descricao, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nome, $telefone, $local_ref, $tipo, $descricao, $status);

    if ($stmt->execute()) {
        $ocorrencia_id = $conn->insert_id;

        // 2. Verifica se houve problemas marcados no formulário dinâmico
        if (isset($_POST['problemas']) && is_array($_POST['problemas'])) {
            $sql_problema = "INSERT INTO problemas_relatados (ocorrencia_id, problema) VALUES (?, ?)";
            $stmt_prob = $conn->prepare($sql_problema);

            foreach ($_POST['problemas'] as $item) {
                $stmt_prob->bind_param("is", $ocorrencia_id, $item);
                $stmt_prob->execute();
            }
        }

        header("Location: sucesso.php");
        exit();
    } else {
        echo "Erro ao registrar: " . $conn->error;
    }
}
?>