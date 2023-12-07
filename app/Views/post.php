<!DOCTYPE html>
<html>
<head>    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="icon" href="favicon.png" type="image/png">   
  <title>Formulário de Entrega</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="icon" href="favicon.png" type="image/png">    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
</head>
<body>
<div class="container">
    <h2>Formulário de Entrega</h2>
    <form id="form-entrega" novalidate>
      <div class="form-group">
        <label for="local_de_entrega">Local de Entrega:</label>
        <input type="text" class="form-control" id="local_de_entrega" name="local_de_entrega" required>
      </div>
      <div class="form-group">
        <label for="local_de_busca">Local de Busca:</label>
        <input type="text" class="form-control" id="local_de_busca" name="local_de_busca" required>
        <div id="map"></div>
      </div>
      <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label for="peso">Peso (em kg):</label>
        <input type="number" class="form-control" id="peso" name="peso" required>
      </div>
      <div class="form-group">
        <label for="tamanho_pacote">Tamanho do Pacote:</label>
        <input type="text" class="form-control" id="tamanho_pacote" name="tamanho_pacote" required>
      </div>
      <div class="form-group">
        <label for="nome_recebedor">Nome recebedor:</label>
        <input type="text" class="form-control" id="nome_recebedor" name="nome_recebedor" required>
      </div>
      <div class="form-group form-check">
        <label class="form-check-label">
          <input class="form-check-input" id="form-check-input" type="checkbox" name="urgencia" onclick="calcularDistancia()"> Urgente
        </label>
      </div>
      <div id="zap"></div>

     
      <button type="submit" class="btn btn-primary" id="submit-form">Enviar</button>
    </form>
  </div>

  <!-- Incluindo a biblioteca jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Script que realiza o envio do formulário via AJAX -->
  <script>
    let distancia;
    let valorPedagio = 0;
    $(document).ready(function() {
      const form = document.querySelector('#form-entrega');

form.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    event.preventDefault();
  }
});
  $('#submit-form').on('click', function(event) {
    event.preventDefault();
    
    // Verifica se todos os campos obrigatórios estão preenchidos
    var form = document.getElementById('form-entrega');
    if (!form.checkValidity()) {
      // Se algum campo obrigatório não estiver preenchido, exibe uma mensagem de erro
      alert('Por favor, preencha todos os campos obrigatórios.');
      return;
    }if (confirm("Todos os dados estão corretos?")) {
      if (document.getElementById("form-check-input").checked){
        var urgenciaa = "1";
      }else{
        var urgenciaa = "0";
        
      }


    
    // Se todos os campos obrigatórios estiverem preenchidos, faz a chamada AJAX
    $.ajax({
      url: "<?= base_Url('apipost'); ?>",
      type: 'POST',
      data: {
        local_de_entrega: $('#local_de_entrega').val(),
        local_de_busca: $('#local_de_busca').val(),
        descricao: $('#descricao').val(),
        peso: $('#peso').val(),
        tamanho_pacote: $('#tamanho_pacote').val(),
        urgencia: urgenciaa,
        distancia: distancia,
        nome_recebedor: $('#nome_recebedor').val(),
      },
      success: function(response) {
        alert(response);
       window.location.href = "<?= base_url('painel'); ?>";
      },
      error: function(xhr, status, error) {
        alert('Ocorreu um erro ao inserir o pedido. Tente novamente mais tarde.');
      }
    });}
  });
});

    let map;

      function initMap() {
        const origem = document.getElementById("local_de_busca");
        const destino = document.getElementById("local_de_entrega");
        const autocompleteOrigem = new google.maps.places.Autocomplete(origem);
        const autocompleteDestino = new google.maps.places.Autocomplete(destino);
      

        // Adiciona evento "blur" aos inputs de origem e destino
        origem.addEventListener("blur", calcularDistancia);
        destino.addEventListener("blur", calcularDistancia);
      }

      function calcularDistancia() {

        var input = document.querySelector("#local_de_busca");
        var inputt = document.querySelector("#local_de_entrega");

const origem = input.value;
const destino = inputt.value;

  if (!origem || !destino) {
    document.getElementById("map").innerHTML = "";
    document.getElementById("map").insertAdjacentHTML("afterbegin", "<p class='error'>Por favor, preencha os campos de origem e destino.</p>");
    return;
  }

  var service = new google.maps.DistanceMatrixService;
  service.getDistanceMatrix({
    origins: [origem],
    destinations: [destino],
    travelMode: 'DRIVING',
    unitSystem: google.maps.UnitSystem.METRIC,
    avoidHighways: false,
    avoidTolls: false,
    drivingOptions: {
      departureTime: new Date(Date.now()),
      trafficModel: 'bestguess'
                    }
    }, function(response, status) {
    if (status !== "OK") {
      alert(`Erro ao calcular a distância: ${status}`);
    } else {
      const distanciaKm = response.rows[0].elements[0].distance.value / 1000; // convertendo de metros para quilômetros
      distancia = distanciaKm;
      var valor = calcularValorCorrida(distanciaKm); // chamando a função calcularValorCorrida() para obter o valor da corrida
    

      document.getElementById("map").innerHTML = "";
      document.getElementById("map").insertAdjacentHTML("afterbegin", `<a style="top:0px;     margin-bottom: 0px;">Distância: ${response.rows[0].elements[0].distance.text}. Valor: R$ ${valor}*.</a>`);
      document.getElementById("zap").innerHTML = "";
      document.getElementById("zap").insertAdjacentHTML("afterbegin", `<p style="font-size:10px; top:0px;     margin-bottom: 0px;"> *valor sujeito a pedagio </p>`);
    }
  });
}

function calcularValorCorrida(distanciaKm) {
  let valor = 0;
  if (distanciaKm <= 4) {
    valor = 10.9;
  } else if (distanciaKm > 4) {
    valor = 10.9 + ((distanciaKm - 4) * 1.30);
  }
  if (document.getElementById("form-check-input").checked) {
    valor = valor * 1.1;
  }
  return valor.toFixed(2); // limitando o valor a 2 casas decimais
}

      
  </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjWfywweufaGU7QzQhUuYWZZCoogOWb90&libraries=places&callback=initMap" async defer></script>
</body>
</html
