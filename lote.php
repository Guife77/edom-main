<?php

include_once("config.php"); // Inclua o arquivo de configuração

header("Content-Type: application/json");

// Use a variável correta para a conexão
if ($conexao->connect_error) {
    die(json_encode(["error" => "Conexão falhou: " . $conexao->connect_error]));
}

// Consulte o número de inscrições
$sql = "SELECT COUNT(*) as total FROM pessoa";
$result = $conexao->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(["total" => (int)$row['total']]);
} else {
    echo json_encode(["error" => "Erro ao executar a consulta: " . $conexao->error]);
}

$conexao->close();
?>
