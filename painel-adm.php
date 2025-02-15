<?php
session_start();
include_once('config.php');

$sql = "";
$stmt = null;

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM pessoa WHERE id LIKE ? OR nome LIKE ? OR cpf LIKE ? OR email LIKE ? OR telefone LIKE ? OR lote LIKE ? OR pagamento_final LIKE ? ORDER BY id DESC";
    $stmt = $conexao->prepare($sql);
    $param = '%' . $data . '%';
    $stmt->bind_param('sssssss', $param, $param, $param, $param, $param, $param, $param);
} else {
    $sql = "SELECT * FROM pessoa ORDER BY id DESC";
    $stmt = $conexao->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    // Erro na consulta SQL
    echo "Erro na consulta SQL: " . $conexao->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">  
    <meta charset="UTF-8">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-edit.css">
    <script src="js/lote.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>EDOM - 10º Edição</title>
    <link rel="icon" type="image/x-icon" href="img/logo.png">

    <script src="js/adm.js"></script>


</head>
</head>
<body>
    <nav class="navbar ">
            <div class="container-fluid" style="display:flex; flex-direction:column;">
                <h1 >Edom MP</h1>
                <h2 >Gerenciador de Inscrições</h2>
            </div>
      
    </nav>
    <div class="box-search" style="width:100%; display:flex;justify-content:center; align-itens:center;">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary" style="margin-left:10px;";>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <div class="clean" style="float: none;"></div>
    <div class="m-5">
        <table class="table text-white table-bg" >
            <thead style="color:black;">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Igreja</th>
                    <th scope="col">CEP</th>
     
                   
                    <th scope="col">Lote</th>
                    <th scope="col">Pago</th>
                    <th scope="col">Dt Inscrição</th>
                    
                </tr>
            </thead>
            <tbody style="color:black;">
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['cpf']."</td>";
                        echo "<td>".$user_data['telefone']."</td>";
                        echo "<td>".$user_data['email']."</td>";
                        echo "<td>".$user_data['igreja']."</td>";
                        echo "<td>".$user_data['cep']."</td>";
                     
                        echo "<td>".$user_data['lote']."</td>";
                        echo "<td>".$user_data['pagamento_final']."</td>";
                        echo "<td>".$user_data['data_inscricao']."</td>";
            
                        
                        echo "<td>
                        <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                            </a> 
                            <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]' title='Deletar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                </svg>
                            </a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>



<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'painel-adm.php?search='+search.value;
    }
</script>


    
        
</body>
</html>