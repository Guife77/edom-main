<?php
    include_once('config.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM pessoa WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $nome = $user_data['nome'];
                $telefone = $user_data['telefone'];
                $cpf = $user_data['cpf'];
                $email = $user_data['email'];
                $igreja = $user_data['igreja'];
                $lote = $user_data['lote'];
      
                $cep = $user_data['cep'];
                $pagamento_final = $user_data['pagamento_final'];
                $data_inscricao = $user_data['data_inscricao'];
               
                

  
            }
        }
        else
        {
            header('Location: painel-adm.php');
        }
    }
    else
    {
        header('Location: painel-adm.php');
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clientes GETS Burguer</title>
    <link rel="stylesheet" type="text/css" href="css/style_formulario.css">
    <style>
       
    </style>
</head>
<body>
    <a href="painel-adm.php">Voltar</a>
    <div class="box">
        <form action="editSave.php" method="POST">
            <fieldset>
                <legend><br>Inscrições EDOM</br></legend>
                <br>
                <div class="inputBox">
                    <label for="nome" class="labelInput">Nome completo: </label>
                    <input type="text" name="nome" id="nome" class="inputUser"  value="<?php echo $nome;?>" required>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="cpf" class="labelInput">CPF: </label>
                    <input type="text" name="cpf" id="cpf" class="inputUser"  value="<?php echo $cpf;?>" required>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="telefone" class="labelInput">Telefone: </label>
                    <input type="teste" name="telefone" id="telefone" class="inputUser" value="<?php echo $telefone;?>" required>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="email" class="labelInput">Email: </label>
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email;?>" required>
                </div>
                <br><br>
                <div class="inputBox">
                    <label for="cep" class="labelInput">CEP: </label>
                    <input type="text" name="cep" id="cep" class="inputUser" value="<?php echo $cep;?>" required>
                </div>
                <br><br>
         
            
                <div class="inputBox">
                    <label for="telefone" class="labelInput">Igreja: </label>
                    <input type="text" name="igreja" id="igreja" class="inputUser" value="<?php echo $igreja;?>" required>
                </div>        
                <br><br>
                <label for="lote"><b>Lote:</b></label>
                <input type="text" name="lote" id="lote" value="<?php echo $lote;?>" required>
                <br>
                <div class="inputBox">
                    <label for="pagamento_final" class="labelInput">Pago: </label>
                    <input type="text" name="pagamento_final" id="pagamento_final" class="inputUser" value="<?php echo $pagamento_final;?>" >
                </div>    

                <br><br>
                 <div class="inputBox">
                        <label for="data_inscricao" class="labelInput">Data e Hora de Inscrição: </label>
                        <input type="datetime-local" name="data_inscricao" id="data_inscricao" class="inputUser" 
                            value="<?php echo date('Y-m-d\TH:i', strtotime($data_inscricao)); ?>" required>
                    </div>
                    <br><br>
              
                <input type="hidden" name="id" value=<?php echo $id;?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    
    </div>

   
</body>

</html>
    
</body>
</html>