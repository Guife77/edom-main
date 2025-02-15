<?php
require 'vendor/autoload.php'; // Carrega o autoload do Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Configurações do banco de dados
$servername = "";
$username = "";
$password = ""; // Se você configurou uma senha para o usuário root, adicione-a aqui
$dbname = "";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Executa a consulta SQL
$sql = "SELECT * FROM pessoa";
$result = $conn->query($sql);

// Cria uma nova planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Adiciona os dados à planilha
if ($result->num_rows > 0) {
    // Cabeçalho
    $header = array_keys($result->fetch_assoc());
    $sheet->fromArray($header, NULL, 'A1');
    
    // Dados
    $result->data_seek(0); // Reseta o ponteiro do resultado para o início
    $rowNumber = 2;
    while($row = $result->fetch_assoc()) {
        $sheet->fromArray(array_values($row), NULL, 'A' . $rowNumber++);
    }
} else {
    echo "0 resultados";
    exit;
}

// Fecha a conexão
$conn->close();

// Escreve o arquivo Excel localmente para verificar se está correto
$writer = new Xlsx($spreadsheet);
$filename = 'resultado_local.xlsx';
$writer->save($filename);

// Verifica se o arquivo foi salvo corretamente
if (file_exists($filename)) {
    // Envia o arquivo para download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="resultado.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
} else {
    echo "Erro ao salvar o arquivo Excel.";
}
?>
