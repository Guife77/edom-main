async function fetchSubscriptionCount() {
    try {
        let response = await fetch(`lote.php`);
        let data = await response.json();
        if (data.error) {
            console.error(data.error);
            return;
        }

        let subscriptionCount = data.total;
     

        if (subscriptionCount <= 150) {
            document.querySelector('option[value="Lote 1"]').disabled = true;
            document.querySelector('option[value="Lote 1"]').innerHTML = " ̶L̶o̶t̶e̶ ̶1̶ ̶R̶$̶6̶0̶,̶0̶0̶ ESGOTADO";
            document.querySelector('option[value="Lote 2"]').disabled = false;
            document.querySelector('option[value="Lote 2"]').innerHTML = "Lote 2 R$70,00";
        }
        if (subscriptionCount > 150 && subscriptionCount <= 250) {
            document.querySelector('option[value="Lote 2"]').disabled = true;
            document.querySelector('option[value="Lote 2"]').innerHTML = " ̶L̶o̶t̶e̶ ̶2̶ ̶R̶$̶7̶0̶,̶0̶0̶ ESGOTADO";
            document.querySelector('option[value="Lote 3"]').disabled = false;
            document.querySelector('option[value="Lote 3"]').innerHTML = "Lote 3 R$80,00";
        }
        if (subscriptionCount >= 251 && subscriptionCount <= 300) {
            document.querySelector('option[value="Lote 3"]').innerHTML = " ̶L̶o̶t̶e̶ ̶3̶ ̶R̶$̶8̶0̶,̶0̶0̶ ESGOTADO";
            document.querySelector('option[value="Lote 3"]').disabled = true;
        }
    } catch (error) {
        console.error('Erro ao buscar dados:', error);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    fetchSubscriptionCount();
});

