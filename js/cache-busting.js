// Adicione um parâmetro único à URL do arquivo
const url = 'https://mensageirosdapal1.websiteseguro.com/?v=' + Date.now();

// Carregue o arquivo usando a nova URL
const script = document.createElement('script');
script.src = url;
document.head.appendChild(script);