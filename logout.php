<?php
session_start();
// Remove todas as variáveis de sessão
session_unset();
// Destrói a sessão
session_destroy();

// Redireciona para o formulário principal
header("Location: index.php");
exit();
?>