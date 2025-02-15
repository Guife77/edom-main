<?php
    include_once('config.php');

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];

        $sqlSelect = "SELECT * FROM pessoa WHERE id=$id";
        $result = $conexao->query($sqlSelect);

        if ($result->num_rows > 0) {

            $comando = "UPDATE pessoa SET presenca='Ok' WHERE id=$id";

 
            if ($conexao->query($comando) === TRUE) {
                echo "<body>
                        <div class='sucesso'>Presença confirmada!</div>
                        <script>
                          
                            setTimeout(function() {
                                window.location.href = 'presenca.php';
                            }, 3000);
                        </script>
                      </body>";
            
            } else {
                echo "Erro ao atualizar presença: " . $conexao->error;
            }
        } else {
            echo "Registro com ID $id não encontrado.";
        }
    } else {
        header('Location: presenca.php');
    }
    
?>
<style>

body{
    background-image: url('img/fundo_edom.png');
    background-size:cover;
}

.sucesso {
    color: #28a745;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    padding: 10px;
    width: 600px;

    margin:200px auto;
    border-radius: 5px;
    font-family: Arial, sans-serif;
    font-size: 50px;
    text-align: center;
}
</style>