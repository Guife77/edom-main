<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $igreja = $_POST['igreja'];
        $lote = $_POST['lote'];

        $cep = $_POST['cep'];
        $pagamento_final = $_POST['pagamento_final'];
        $data_inscricao = $_POST['data_inscricao'];


        $sqlUpdate = "UPDATE pessoa SET nome='$nome',cpf='$cpf',telefone='$telefone',email='$email',igreja='$igreja',lote='$lote',cep='$cep',pagamento_final='$pagamento_final', data_inscricao='$data_inscricao' WHERE id=$id";
        $result = $conexao->query($sqlUpdate);
        print_r($result);
    }
    header('Location: painel-adm.php');

?>