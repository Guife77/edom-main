<?php
include_once("config.php"); // Inclua a configuração do banco de dados

if (isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];

    // Previne injeção de SQL
    $cpf = $conexao->real_escape_string($cpf);
 

    // Consulta ao banco de dados
    $sql = "SELECT * FROM pessoa WHERE cpf='$cpf'";
    $query = mysqli_query($conexao, $sql);
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $lote = $row['lote'];

        if ($lote == 1) {
            echo "redirect_lote1";
        } elseif ($lote == 2) {
            echo "redirect_lote2";
        } elseif ($lote == 3) {
            echo "redirect_lote3";
        }else{
            echo "Erro";
        }
    } else {
        echo "CPF disponível";
    }
}
?>
