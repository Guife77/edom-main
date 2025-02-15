<?php
 
 if(isset($_POST['submit'])){

 include_once("config.php");
   $email = $_POST['email'];
   $nome = $_POST['nome'];
   $igreja = $_POST['igreja'];
   $telefone = $_POST['telefone'];

   $lote = $_POST['lote'];
   $cep = $_POST['cep'];
   $logradouro = $_POST['logradouro'];
   $numero = $_POST['numero'];
   $cidade = $_POST['cidade'];
   $estado = $_POST['estado'];
   $comando = "INSERT INTO pessoa(nome,telefone,igreja,email,lote,cep,logradouro,numero,cidade,estado) VALUES('$nome', '$telefone', '$igreja', '$email', '$lote','$cep','$logradouro','$numero','$cidade','$estado')";
   $result = $conexao->query($comando);
  
 }
 ?>


<!DOCTYPE html>
<html lang="pt-br">
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
 <script src="js/lote.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <title>EDOM - 10º Edição</title>
 <link rel="icon" type="image/x-icon" href="img/logo.png">

 <script src="js/validar.js"></script>
 <script src="js/cpf.js"></script>
 <script src="js/endereco.js"></script>


</head>
<body>

<section class="menu">
 <header id="header">
     <img src="img/logo.png"alt="">
  
     <nav id="nav">
       
         <button id="btn-mobile" aria-label="Abrir Menu" aria-haspopup="true" aria-controls="menu" aria-expanded="false">
             <span id="hamburger"></span>
         </button>
         <ul id="menu" role='menu'>
         <li class="a-header"><a href="#inscricao" class="a-header"><button type="submit" name="submit" class=" btn-primeiro" >RESERVAR</button></a></li>
             <li><a href="#pregadores">Pregadores</a></li>
             <li><a href="#localizacao">Localização</a></li>
             <li><a href="#inscricao">Reservar</a></li>

         </ul>
     </nav>
 </header>
 <div class="img_principal"></div>
</section>
   
   
<section class="box-inicio">

     <div class="info">
       <div class="textos">
         <img src="img/logo_ofc.avif" alt="">
        
       </div>

       <div class="info2">
            <div class="info2txt">
          
            <p class="p">📅 <strong>Data:</strong> 09 de novembro de 2024 (Sábado) | Das 9h às 16h</p>
            <p class="p">☕ <strong>Café da manhã completo</strong> </p>
            <p class ="p">📚 <strong>Material didático</strong></p>
            <p class="p">🚗 <strong>Estacionamento gratuito</strong>.</p>
            <p class="p">🍽️ <strong>Espaço Gourmet disponível</strong> (alimentação não inclusa, cada participante pode adquirir suas refeições no local).</p>

         </div>
         <div class="separar">
           <a href="#inscricao"><button type="submit" name="submit" class="glow-on-hover btn-primeiro" onsubmit="validarTelefone(event)" >RESERVAR</button></a>
           <div class="redes-separa">
           <a href="https://www.instagram.com/eusoumensageiros/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#C13584" class="bi bi-instagram" viewBox="0 0 16 16">
                   <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                   </svg></a>
           <a href="https://www.youtube.com/@mensageirosdapalavra1893" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-youtube" viewBox="0 0 16 16">
                     <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                     </svg></a>
             <a href="https://www.facebook.com/eusoumensageiros/?locale=pt_BR" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                     <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                     </svg></a>
                     </div>
           </div>
       </div>
     
     </div>
   </div>

</section>


<section class="mensagem">
   <div class="box-mensagem">
     <div class="txt">
       <h2>Venha viver um dia de transformação ministerial e pessoal, tornando-se um pouco mais semelhante a Cristo!</h2>
       <h3>"Cada vez que você faz uma opção está transformando sua essência em alguma coisa um pouco diferente do que era antes." - C. S. Lewis</h3>
       <div class="dividir-textos">
       <hr>
       <p>Apoio de Mensageiros da Palavra</p>
       </div>

     </div>
   </div>



</section>

 

<section class="pregadores" id="pregadores">
   <div class="dividir-pregador-slides">
         <div class="carrosel">                 
               <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                   <h2>PALESTRANTES</h2>
               <!-- Início indicadores para navegar nos slides do carousel -->
                  
               <!-- Fim indicadores para navegar nos slides do carousel -->

               <!-- Início slide carousel -->
                   <div class="carousel-inner">
                       <div class="carousel-item active">
                           <img src="img/c.avif" class="d-block w-100" alt="Categoria 1" >                            
                               <h3>Pr. Julio César</h3>
                               <p>Esposo da pastora Paula e pai de quatro filhos, é servo integral da casa de Deus junto com sua família, pastor presidente da Mensageiros da palavra, sede do EDOM.</p>              
                        </div>
               
                             <div class="carousel-item">
                               <img src="img/prsezar.avif" class="d-block w-100" alt="Categoria 2">                                         
                                 <h3>Pr. Sezar Cavalcante</h3>        
                               <p>Esposo da Camila Cavalcante e pai de dois filhos, é servo de Deus, pastor da Igreja Genuína de Campinas, Reitor da Faculdade Teológica Betesda e dono da Crescendo na Fé, que tem um espaço exclusivo na rádio Musical FM. </p>
                             </div>
             
                             <div class="carousel-item">
                                 <img src="img/a.avif" class="d-block w-100" alt="Categoria 4">
                                 <h3>Pr. Adson Belo</h3>      
                                 <p>Esposo da pastora Alba Belo e pai de três filhos, é servo de Deus, pastor sênior da IMAFE, escritor e diretor da ITEPA Bible College que prega a teologia da bíblia.</p>
                             </div>
                             <div class="carousel-item">
                                 <img src="img/f.avif" class="d-block w-100" alt="Categoria 5">
                                 <h3 class="mfe">Missionaria Luciana Esoppa</h3>
                                 <p>Ela é mãe, é serva de Deus, missionária da igreja Unidos pela Fé, organizadora do evento Adoradoras, Luciana é apaixonada por sua família e ministrar a palavra de Deus.</p>
                             </div>
                   </div>
               <!-- Fim slide carousel -->

               <!-- Início anterior e próximo slide carousel -->
                   <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                       data-bs-slide="prev">
                       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                       <span class="visually-hidden" >Previous</span>
                   </button>
                   <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                       data-bs-slide="next">
                       <span class="carousel-control-next-icon" aria-hidden="true"></span>
                       <span class="visually-hidden">Next</span>
                   </button>
               <!-- Fim anterior e próximo slide carousel -->

               </div>
               

           </div><!--Carrossel -->
         </div>
     </div>
</section>

<section class="localizacao-principal">
   <div class="localizacao" id="localizacao">
     <div class="text">
       <h2>Localização</h2>
   
       <p>Rua Ushikichi Kamiya, 777, Furnas - São Paulo - SP</p><br>
       <p><a href="https://maps.app.goo.gl/LYpdnSBcmS93qgwu5" target="_blank"><span>VENHA JÁ!</span><img width="48" height="48" src="https://img.icons8.com/fluency/48/google-maps-new.png" alt="google-maps-new"/></a></p>
       <br>
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1088.2917349020433!2d-46.587968213235534!3d-23.440167118767853!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cef4181b93420d%3A0x1a9227ad538a5eaa!2sIgreja%20Evang%C3%A9lica%20Mensageiros%20Da%20Palavra!5e0!3m2!1spt-BR!2sbr!4v1721676722666!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
     </div>
   </div> 
</section>  



<section class="formulario">


 <div class="form" >
     <form id="inscricao" method="POST" action="enviar-email.php" >
         <h2>INSCRIÇÃO</h2>
         <div class="div">
           <label for="nome">Nome: </label>    
             <input type="text" id="nome" required name="nome" placeholder="Seu nome completo:">
         </div>
         <br>   
         <div class="div">
           <label for="cpf">CPF: </label>    
             <input type="text" id="cpf" required name="cpf" onkeypress="apenasNumeros(event)" maxlength="11" placeholder="CPF (APENAS NÚMEROS): ">
         </div>
         <br>              
         <div class="div"> 
           <label for="telefone">Telefone: </label>            
             <input type="text" required name="telefone" id="telefone" onkeypress="apenasNumeros(event)" placeholder="Digite seu telefone: 11999999999"">
         </div>
        <br>
        <div class="div">   
             <label for="email">E-mail: </label>
             <input type="email" required name="email" id="email" placeholder="Digite seu email:">
         </div>
        <br>
        <div class="div">
             <label for="cep">Cep: </label>              
             <input type="text" required name="cep" onblur="buscaCep()" id="cep" placeholder="Digite seu cep:">
         </div>
        <br>
 
      

        <div class="div">
             <label for="igreja">Igreja: </label>              
             <input type="text" required name="igreja" id="igreja" placeholder="Digite sua Igreja:">
         </div>
        <br>
        <div class="div pag">
         <label for="Lote: ">Lote:</label>
         <br>
           <select name="lote" id="mySelect" required>
             <option value="">Selecione um lote:</option>
             <option name = "1" value="1" class="option">Lote 1 R$65,00</option>
             <option name = "2" value="2" class="option" disabled> ̶L̶o̶t̶e̶ ̶2̶ ̶R̶$̶7̶5,̶0̶0̶ INDISPONÍVEL</option>
             <option name = "3" value="3" class="option" disabled> ̶L̶o̶t̶e̶ ̶3̶ ̶R̶$̶8̶5,̶0̶0̶ INDISPONÍVEL</option>
           </select>
  
         </div>
         <br>
        
         <div class="enviar">
             <input type="submit" id="submit-btn" name="enviar" class="glow-on-hover" value="INSCREVA-SE">

         </div>

       
         
     </form>
 </div>
 
</section>


<footer>
 <div class="info">
   <p>&copy; 2024 Mensageiros da Palavra. Todos os direitos reservados.</p>
   
   
   <div class="faq">
   <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="green" class="bi bi-whatsapp" viewBox="0 0 16 16">
<path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
</svg>
       </a>

     <p style="margin-left:10px;"><a href="https://wa.me/+5511952350373" style="color:white;">Rolou alguma dúvida? Clique aqui.</a></p>
   </div>
   <p><a href="politica_privacidade.php">Política de Privacidade
       </a></p>

 </div>
</footer>

  
<script>
document.addEventListener('DOMContentLoaded', function() {
 // Verifica se a URL contém um parâmetro de status
 const urlParams = new URLSearchParams(window.location.search);
 const status = urlParams.get('status');

 if (status === 'cpf_duplicado') {
     alert('CPF já cadastrado. Por favor, verifique seus dados ou entre em contato conosco.');
 } else if (status === 'inscricao_confirmada') {
     alert('Inscrição confirmada! Você tem um prazo de até 5 dias úteis para realizar o pagamento. Em caso de dúvidas, entre em contato conosco pelo Instagram @eusoumensageiros.');
 }
});
</script>

</script>


 <script src="js/cpf.js"></script>
 <script src="js/mobile.js"></script>
 <script src="js/lote.js"></script>
 <script src="js/validar.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
     crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>