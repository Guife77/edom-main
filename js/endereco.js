function buscaCep() {
    const cep = document.getElementById("cep").value.replace(/\D/g, '');

    if (cep !== "") {
        const url = `https://viacep.com.br/ws/${cep}/json/`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (!("erro" in data)) {
                    document.getElementById("logradouro").value = data.logradouro;

                    document.getElementById("cidade").value = data.localidade;
                    document.getElementById("estado").value = data.uf;
                } else {
                    alert("CEP não encontrado.");
                }
            })
            .catch(error => console.error("Erro ao buscar CEP:", error));
    } else {
        alert("Formato de CEP inválido.");
    }
}
