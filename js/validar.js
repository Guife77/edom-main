document.getElementById("inscricao").reset();

        document.getElementById('inscricao').addEventListener('submit', function(event) {
            const telefone = document.getElementById('telefone').value;
            const regexTelefone = /^\d{11}$/; // Altere para aceitar exatamente 11 dígitos

            if (!regexTelefone.test(telefone)) {
                event.preventDefault(); // Impede o envio do formulário
                alert('Número de telefone inválido. Certifique-se de inserir um número com 11 dígitos. (Ex: 11999999999). Sem os ()!');
                return;
            }

            const cpf = document.getElementById('cpf').value;
            if (!validaCPF(cpf)) {
                event.preventDefault(); // Impede o envio do formulário
                alert('CPF Inválido! (Ex: 00000000000)');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "verificar_cpf.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
        
                    if (xhr.responseText.trim() == "redirect_lote1") {
                        alert('CPF já cadastrado! Redirecionando para o pagamento...');
                        window.location.href = 'https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=547002861-ec1ea5f5-e85e-4255-a02f-638c398fc371';
                    } else if (xhr.responseText.trim() == "redirect_lote2") {
                        alert('CPF já cadastrado! Redirecionando para o pagamento...');
                        window.location.href = 'https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=547002861-677f20e4-903d-4e0d-a597-e1df9619fd20';
                    } else if(xhr.responseText.trim() == "redirect_lote3" ){
                        alert('CPF já cadastrado! Redirecionando para o pagamento...');
                        window.location.href = 'https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=547002861-9fd5f3e1-528a-4dfc-a2de-e6c3e71b22a9';
                    } else if (xhr.responseText.trim() == "CPF disponível") {
                        alert('Inscrição confirmada! Você tem um prazo de até 5 dias úteis para realizar o pagamento!');
                        setTimeout(function() {
                            document.getElementById("inscricao").submit();
                        }, 10000);
                    } else {
                        alert(xhr.responseText);
                    }
                } else {
                    console.log("Erro na requisição:", xhr.status, xhr.statusText);
                }
            };
            xhr.send("cpf=" + encodeURIComponent(cpf));
        });

        function apenasNumeros(event) {
            const charCode = event.which ? event.which : event.keyCode;
            if (charCode < 48 || charCode > 57) {
                event.preventDefault();
            }
        }

        function validaCPF(cpf) {
            let Soma = 0;
            let Resto;
          
            const strCPF = String(cpf).replace(/[^\d]/g, '');
            
            if (strCPF.length !== 11 || /^(\d)\1{10}$/.test(strCPF)) {
                return false;
            }
          
            for (let i = 1; i <= 9; i++) {
                Soma += parseInt(strCPF.substring(i - 1, i)) * (11 - i);
            }
          
            Resto = (Soma * 10) % 11;
            if (Resto === 10 || Resto === 11) Resto = 0;
            if (Resto !== parseInt(strCPF.substring(9, 10))) {
                return false;
            }
          
            Soma = 0;
            for (let i = 1; i <= 10; i++) {
                Soma += parseInt(strCPF.substring(i - 1, i)) * (12 - i);
            }
          
            Resto = (Soma * 10) % 11;
            if (Resto === 10 || Resto === 11) Resto = 0;
            if (Resto !== parseInt(strCPF.substring(10, 11))) {
                return false;
            }
          
            return true;
        }