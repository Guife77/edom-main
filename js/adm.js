function requestPassword(event) {
    event.preventDefault(); // Previne o redirecionamento padrão
    var senha = "DataShow2020"
    var password = prompt("Por favor, insira a senha:");

    if (password == senha) {
      window.location.href = "excel.php";
    }else{
        alert("Senha incorreta!")
    }
}