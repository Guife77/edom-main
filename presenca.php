<?php
session_start();
include_once('config.php');

$sql = "";
$stmt = null;

// Verifica se o parâmetro 'search' está presente e não está vazio
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = " 
    SELECT p.cpf, p.nome, p.telefone, p.email, p.igreja, p.cep, p.lote, p.pagamento_final, p.id, c.cadeira 
    FROM pessoa p
    INNER JOIN cadeiras c ON p.cpf = c.cpf 
    WHERE p.cpf LIKE ?";
   
    $stmt = $conexao->prepare($sql);
    $param = '%' . $data . '%';
    $stmt->bind_param('s', $param); // Vincula apenas um parâmetro
} else {
    // Se não houver pesquisa, não faz a consulta
    $sql = ""; // Nenhuma consulta a ser executada
}

// Verifica se há uma consulta para executar
if (!empty($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        // Erro na consulta SQL
        echo "Erro na consulta SQL: " . $conexao->error;
        exit();
    }
} else {
    // Se não houver pesquisa, cria um resultado vazio
    $result = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-edit.css">
    <script src="js/lote.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>EDOM - 10º Edição</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <script src="js/adm.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container-fluid" style="display:flex; flex-direction:column;">
            <h1>Edom MP</h1>
            <h2>Consulta Inscrição</h2>
            <h3>Digite seu CPF</h3>
        </div>
    </nav>
    <div class="box-search" style="width:100%; display:flex; justify-content:center; align-items:center;">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary" style="margin-left:10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead style="color:black;">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Igreja</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Lote</th>
                    <th scope="col">Cadeira</th>
                    <th scope="col">Pago</th>
                    <th scope="col">Confirmar Presença</th>
                </tr>
            </thead>
            <tbody id="resultTable" style="color:black;">
                <?php
                if (!empty($sql)) {
                    if ($result->num_rows > 0) {
                        while ($user_data = mysqli_fetch_assoc($result)) {
                 
                            echo "<td>" . $user_data['nome'] . "</td>";
                            echo "<td>" . $user_data['cpf'] . "</td>";
                            echo "<td>" . $user_data['telefone'] . "</td>";
                            echo "<td>" . $user_data['email'] . "</td>";
                            echo "<td>" . $user_data['igreja'] . "</td>";
                            echo "<td>" . $user_data['cep'] . "</td>";
                            echo "<td>" . $user_data['lote'] . "</td>";
                            echo "<td>" . $user_data['cadeira'] . "</td>";
                            echo "<td>" . $user_data['pagamento_final'] . "</td>";
                            echo "<td>
                                <a class='btn btn-sm btn-primary' href='confirmar.php?id=" . $user_data['id'] . "' title='Confirmar'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check' viewBox='0 0 16 16'>
                                        <path d='M13.485 1.757a.5.5 0 0 1 .03.707l-8 9a.5.5 0 0 1-.756-.033L1.818 8.925a.5.5 0 1 1 .764-.64l2.636 3.154L12.778 2.46a.5.5 0 0 1 .707-.03z'/>
                                    </svg>
                                </a>
                            </td>";
                           
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Nenhum registro encontrado.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Por favor, faça uma pesquisa para exibir os resultados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        var query = encodeURIComponent(search.value);
        window.location = 'presenca.php?search=' + query;
    }

    function removeRow(id) {
        var row = document.getElementById('row-' + id);
        if (row) {
            row.style.display = 'none'; // Remove a linha da tela
        }
    }
</script>
</body>
</html>
