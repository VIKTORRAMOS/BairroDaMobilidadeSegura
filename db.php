<?php
/**
 * ARQUIVO: db.php
 * OBJETIVO: Estabelece a conexão com o banco de dados
 */
/*
$host = "sql211.infinityfree.com";
$user = "if0_41937452";
$pass = "WF8u4cDhJnK";
$db   = "if0_41937452_mobilidade_bairro"; */

$host = "localhost";
$user = "root";
$pass = "";
$db   = "mobilidade_bairro";

// Cria a conexão com o banco de dados
$conn = new mysqli($host, $user, $pass, $db);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Garante o uso de acentuação correta (UTF-8)
$conn->set_charset("utf8");
?>
