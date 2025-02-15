<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inicializa variáveis
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cadeiraSelecionada = $_POST['cadeira'];
    $errors = [];

    // Validação simples dos campos
    if (empty($nome)) {
        $errors[] = "O nome é obrigatório.";
    }

    if (empty($cpf)) {
        $errors[] = "O CPF é obrigatório.";
    } elseif (!preg_match("/^[0-9]{11}$/", $cpf)) {
        $errors[] = "O CPF deve conter 11 dígitos numéricos.";
    }

    if (empty($cadeiraSelecionada)) {
        $errors[] = "A seleção de uma cadeira é obrigatória.";
    }

    // Se não houver erros, processa a reserva
    if (empty($errors)) {
        // Conexão com o banco de dados
          $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $dbname = "edom";
       
    
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
        }

        // Verificar se o CPF já está cadastrado
        $stmt = $conn->prepare('SELECT cpf FROM cadeiras WHERE cpf = ?');
        $stmt->bind_param('s', $cpf);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows >= 1) {
            // Se o CPF já existe, retorna uma mensagem de erro e não processa a reserva
            echo "<script>alert('CPF já cadastrado. Por favor, insira um CPF diferente.');</script>";
            echo "<script>console.log('CPF Já FOi')</script>";
        } else {
            // CPF não cadastrado, processa a reserva
            $reserva = 'reservada';
            $stmt = $conn->prepare('INSERT INTO cadeiras (nome, cpf, cadeira, status) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $nome, $cpf, $cadeiraSelecionada, $reserva);

            if ($stmt->execute()) {
                echo "<script>alert('Reserva realizada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao reservar a cadeira.');</script>";
            }
        }

        $stmt->close();
        $conn->close();
        
        // Redireciona para a mesma página após a reserva
        echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
        exit;
    } else {
        // Exibe os erros de validação
        foreach ($errors as $error)   {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Cadeiras</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      padding: 20px;
      background-color: #f7f7f7;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    #reservaForm {
      width: 300px;
      margin: 0 auto; 
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 2px;
    }

    input[type="text"] {
      width: 100%;
      padding: 1px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #75a1a7; /* Cor de hover */
    }

    /* Ajustando o layout do canvas para a seleção de cadeiras */
    canvas {
   
      display: block;
      margin: 0 auto; /* Centraliza o canvas */
      border: 1px solid #ccc;
    }
    </style>
</head>
<body>
    <h1>Reserva de Cadeiras</h1>

    <!-- Exibe erros, se houver -->
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="reservaForm" method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo isset($nome) ? htmlspecialchars($nome) : ''; ?>" required><br><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo isset($cpf) ? htmlspecialchars($cpf) : ''; ?>" required><br><br>

        <input type="hidden" id="cadeiraSelecionada" name="cadeira" value="<?php echo isset($cadeiraSelecionada) ? htmlspecialchars($cadeiraSelecionada) : ''; ?>">
        <button type="submit">Reservar Cadeira</button>
    </form>

    <script>
        
        let seatColors = [];
        let seatGrid = [];
        let rows = 20;
        let columns = 20;
        let seatSize = 40;
        let spacing = 10;
        let rowSpacing = 50;
        let middleSpacing = 100;
        let cadeiraSelecionada = <?php echo json_encode(isset($cadeiraSelecionada) ? $cadeiraSelecionada : null); ?>;

        function setup() {
            createCanvas(1100 , 1200);
          
            let orangeSeats = 100;
            let blackSeats = 140;
            let yellowSeats = 60;

            seatColors = Array(orangeSeats).fill('orange')
                        .concat(Array(blackSeats).fill('black'))
                        .concat(Array(yellowSeats).fill('red'));

            seatGrid = Array(rows).fill().map(() => Array(columns).fill(null));
            let flatIndex = 0;
            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < columns; j++) {
                    if (flatIndex < seatColors.length) {
                        seatGrid[i][j] = { color: seatColors[flatIndex], reserved: false };
                        flatIndex++;
                    }
                }
            }

            noLoop();
            loadReservedSeats();
        }

        function loadReservedSeats() {
            fetch('cadeiras.php')
    .then(response => response.json())
    .then(data => {
        console.log('Dados recebidos da API:', data); // Adicione essa linha para ver os dados
        if (data.reservas) {
            data.reservas.forEach(cadeira => {
                const seatNum = parseInt(cadeira);
                if (seatNum > 0) {
                    markSeatAsReserved(seatNum);
                }
            });
        }
    })
    .catch(error => console.error('Erro ao carregar cadeiras reservadas:', error));

}

        function markSeatAsReserved(seatNum) {
    let numCadeira = 1;
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < 20; j++) { // Itera por todas as 20 cadeiras
            if (numCadeira == seatNum) {
                seatGrid[i][j].reserved = true; // Marca a cadeira como reservada
            
            }
            numCadeira++;
        }
    }
    redraw(); // Redesenha a tela
}
function draw() {
    background(255);
    let numCadeira = 1;
    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < 20; j++) { // Loop por todas as cadeiras
            let cadeira = seatGrid[i][j];
            if (cadeira) {
                let x = (j < 10) ? j * (seatSize + spacing) : (j - 10) * (seatSize + spacing) + middleSpacing + 10 * (seatSize + spacing);
                let y = i * rowSpacing + 100;

                // Desenha a cadeira
                fillSeat(cadeira, x, y, seatSize, numCadeira);

                // Se a cadeira estiver reservada, desenha um "X"
                if (cadeira.reserved) {
                    drawX(x, y, seatSize); // Desenha o "X"
                }
                numCadeira++;
            }
        }
    }

    // Desenha o texto do altar
    fill(200);
    rect(0, 50, (seatSize + spacing) * 20 + middleSpacing, 40);
    fill(0);
    textSize(16);
    textAlign(CENTER, CENTER);
    text('Altar', (seatSize + spacing) * 10 + middleSpacing / 2, 70);

    drawLegenda();
}

function drawLegenda() {
    let legendX = 50;
    let legendY = height - 300;
    let legendSize = 30;
    let spacing = 20;

    // Lote 1 - Amarelo
    fill('orange');
    rect(legendX, legendY, legendSize, legendSize);
    fill(0);
    textAlign(LEFT, CENTER);
    text('LOTE 1 - AMARELO', legendX + legendSize + spacing, legendY + legendSize / 2);

    // Lote 2 - Preto
    fill('black');  
    rect(legendX, legendY + legendSize + spacing, legendSize, legendSize);
    fill(0);
    text('LOTE 2 - PRETO', legendX + legendSize + spacing, legendY + legendSize + spacing + legendSize / 2);

    // Lote 3 - Vermelho
    fill('red');
    rect(legendX, legendY + 2 * (legendSize + spacing), legendSize, legendSize);
    fill(0);
    text('LOTE 3 - VERMELHO', legendX + legendSize + spacing, legendY + 2 * (legendSize + spacing) + legendSize / 2);

    fill('grey')
    rect(legendX, legendY + 3 * (legendSize + spacing), legendSize, legendSize);
    fill(0);
    text('OCUPADO', legendX + legendSize + spacing, legendY + 3 * (legendSize + spacing) + legendSize /2)
}
      
function drawX(x, y, size) {
    stroke('red'); // Cor do "X"
    line(x, y, x + size, y + size); // Desenha linha diagonal do "X"
    line(x + size, y, x, y + size); // Desenha a outra linha diagonal do "X"
}
        function fillSeat(cadeira, x, y, size, numCadeira) {
            if (cadeiraSelecionada === numCadeira) {
                fill('blue');  // Cor para a cadeira selecionada
            } else if (cadeira.reserved) {
                fill('gray');  // Cor para cadeiras reservadas (mudada para cinza)
            } else {
                fill(cadeira.color);
            }

            rect(x, y, size, size);
            fill(255);
            textSize(16);
            textAlign(CENTER, CENTER);
            text(numCadeira, x + size / 2, y + size / 2);
        }

        function mousePressed() {
            let numCadeira = 1;
            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < 10; j++) {
                    let x = j * (seatSize + spacing);
                    let y = i * rowSpacing + 100;
                    if (mouseX >= x && mouseX <= x + seatSize && mouseY >= y && mouseY <= y + seatSize) {
                        if (seatGrid[i][j].reserved) {
                            alert('Essa cadeira já está reservada.');
                        } else {
                            cadeiraSelecionada = numCadeira;
                            document.getElementById('cadeiraSelecionada').value = numCadeira;
                            redraw();
                        }
                        return;
                    }
                    numCadeira++;
                }

                for (let j = 10; j < 20; j++) {
                    let x = (j - 10) * (seatSize + spacing) + middleSpacing + 10 * (seatSize + spacing);
                    let y = i * rowSpacing + 100;
                    if (mouseX >= x && mouseX <= x + seatSize && mouseY >= y && mouseY <= y + seatSize) {
                        if (seatGrid[i][j].reserved) {
                            alert('Essa cadeira já está reservada.');
                        } else {
                            cadeiraSelecionada = numCadeira;
                            document.getElementById('cadeiraSelecionada').value = numCadeira;
                            redraw();
                        }
                        return;
                    }
                    numCadeira++;
                }
            }
        }
       
    </script>
</body>
</html>