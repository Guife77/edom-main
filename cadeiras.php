<?php
// Conexão com o banco de dados MySQL
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "edom";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Manipulação de requisições
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Endpoint para reservar cadeira
    $nome = $_POST['nome'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $cadeira = $_POST['cadeira'] ?? null;

    // Validação básica de nome, CPF e cadeira selecionada
    if (!$nome || !$cpf || !$cadeira) {
        echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
        exit;
    }

    // Log para depuração
    error_log('Nome: ' . $nome);
    error_log('CPF: ' . $cpf);
    error_log('Cadeira: ' . $cadeira);

    // Definir o status como 'reservada'
    $status = 'reservada';

    // Inserindo os dados na tabela de reservas existente
    $stmt = $conn->prepare('INSERT INTO cadeiras (nome, cpf, cadeira, reserva) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $nome, $cpf, $cadeira, $status);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Cadeira reservada com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao reservar a cadeira: ' . $stmt->error]);
    }

    $stmt->close();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Endpoint para buscar cadeiras já reservadas
    $reservas = [];
$conn = new mysqli("localhost:3306", "root", "", "edom");
$result = $conn->query('SELECT cadeira FROM cadeiras where status = "reservada"');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reservas[] = $row['cadeira'];
    }
}

    echo json_encode(['reservas' => $reservas]);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>