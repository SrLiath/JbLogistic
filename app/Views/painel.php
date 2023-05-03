<!DOCTYPE html>
<html lang="en">

  <head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>JB Logistica</title>
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
<link rel="stylesheet" href="assets/css/template.css">
<link rel="stylesheet" href="assets/css/owl.css">
<link rel="stylesheet" href="assets/css/lightbox.css">

<script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
 	<!-- Link para Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Link para jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<!-- Link para Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
      body {
  background-color: white;
  overflow-x: hidden;  
  font-family: 'Montserrat', sans-serif;
}
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
    overflow: auto;
}

.modal-content {  
  overflow: auto;
}
/* Adicione as seguintes regras CSS no seu arquivo CSS */
.modal {
  text-align: center;
}

.modal-dialog {
  width: auto;
  height: auto;
  max-width: 90%;
  margin: 1.75rem auto;
}
.small {
  width: 50%;
  height: 50%;
}


</style>
  </head>

<body>

   
  <!--header-->
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="<?= base_url(); ?>"><em>JB</em> Logistica</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="<?= base_Url(); ?>">Inicial</a></li>
        <li class="menu"><a href="#section2">Sobre nós</a>
        </li>
        <!-- <li><a href="#section5">Video</a></li> -->
        <li><a href="#section6">Contato</a></li>
        <li><a href="<?= base_Url('rastreio'); ?>" class="external">Rastreio</a></li>
        <li class="has-submenu"><a href="#section2">Postar</a>
          <ul class="sub-menu">
            <li><a href="<?= base_Url('login'); ?>" class= "external">Login</a></li>
            <li><a href="#section2">Como fazer?</a></li>
          </ul>
        </li>
      </ul>

    </nav>
  </header>






  <div class="container" style="
    top: 10vh;
    position: absolute;
">
    <h2>Meus pedidos</h2>
    <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#meu-modal">Entregues</button>
    <button class="btn btn-primary entregues-btn" onclick="redirect()">Postar</button>    
    <button id="btnSenha" type="button" class="btn btn-primary" style="right: -9vw; position: absolute;">Alteração de senha</button>
    <div id="modalSenha" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Alteração de senha</h4>
      </div>
      <div class="modal-body">
  <p>Senha atual:</p>
  <input type="password" id="senha" class="form-control" required>
  <p>Nova senha:</p>
  <input type="password" id="newsenha" class="form-control" required minlength="8">
  <p>Repita a senha:</p>
  <input type="password" id="resenha" class="form-control" required>
</div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnEnviar">Enviar</button>
      </div>
    </div>
  </div>
</div>

<script>
function redirect() {
    window.location.href = "<?= base_url('post') ?>";}
</script>

    <!-- Tabela de pedidos --><div class="table-responsive table-responsive-sm"  style=" margin: 0 auto;
    width: 95vw;">
        <table class="table" style="
      margin-left: auto;
    margin-right: auto;
    width: 100vw;
">
    <thead>
      <tr>
        <th>Local de Entrega</th>
        <th>Local de Busca</th>
        <th>Descrição</th>
        <th>Peso</th>
        <th>Tamanho do Pacote</th>
        <th>Urgência</th>
        <th>Status</th>
        <th>Rastreio</th>
        <th>cancelar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pedidos as $pedido) : ?>
        <tr>
          <td><?= $pedido->local_de_entrega ?></td>
          <td><?= $pedido->local_de_busca ?></td>
          <td><?= $pedido->descricao ?></td>
          <td><?= $pedido->peso ?></td>
          <td><?= $pedido->tamanho_pacote ?></td>
          <td><?= $pedido->urgencia ? 'Sim' : 'Não' ?></td>
          <td><?= $pedido->status ?></td>
          <td><?= $pedido->rastreio ?></td>
          <?php if ($pedido->status != "Aguardando confirmação") {
              echo"<td></td>";
          } else {
              echo '<td> <button type="button" class="btn btn-danger btn-cancelar" data-id="'. $pedido->id .'">Cancelar</button></td>';
          }?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade modalb" id="meu-modal" tabindex="-1" role="dialog" aria-labelledby="meu-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <center> <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="meu-modal-label">Pedidos Entregues</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped" id="tabela-pedidos">
          <thead>
            <tr>
              <th>Local de Entrega</th>
              <th>Local de Busca</th>
              <th>Descrição</th>
              <th>Peso</th>
              <th>Tamanho do Pacote</th>
              <th>Status</th>
              <th>Rastreio</th>
            </tr>
          </thead>
          <tbody>
            <!-- Linhas da tabela serão preenchidas via AJAX -->
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div></center>
  </div>
</div>


          
        </div>
        <script>

        $(document).ready(function(){
          $('#btnSenha').click(function() {
      $('#modalSenha').modal('show');
    });
    
    // Quando o botão de envio do modal é clicado, verifica a senha
    $('#btnEnviar').click(function() {
   

      const form = document.querySelector('form');
      var senha = $('#senha').val();
      var newsenha = $('#newsenha').val();
      var resenha = $('#resenha').val();
    
    if (!senha || !newsenha || !resenha) {
      event.preventDefault(); // previne o envio do formulário
      alert('Por favor, preencha todos os campos.');
    } else if (newsenha.length < 8) {
      event.preventDefault(); // previne o envio do formulário
      alert('A nova senha deve ter no mínimo 8 caracteres.');
    } else if (newsenha !== resenha) {
      event.preventDefault(); // previne o envio do formulário
      alert('As senhas digitadas não correspondem.');
    }else{
      $.ajax({
        url: '<?= base_url("apipainel") ?>',
    type: 'POST',
    data: { choice : "pass", senha: senha, newsenha: newsenha },
    success: function(response) {
                    // Exibir o alerta com a resposta
                    alert(response);
                    location.reload();
                },
  });
    };

    });
          
          $('.btn-cancelar').click(function() {
    var pedidoId = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: '<?= base_url("apipainel") ?>',
      data: {id: pedidoId, confirm : 0},
      success: function(response) {
        location.reload()
      },
      error: function() {
        alert('Erro ao cancelar o pedido.');
      }
    });
  });
  // Quando o botão for clicado, exibir o modal
  $("#mostrar-modal").click(function(){
    $("#modal").css("display", "block");
  });
  
  // Quando o botão de fechar o modal for clicado, esconder o modal
  $(".close").click(function(){
    $("#modal").css("display", "none");
  });

  $.ajax({
      url: '<?= base_url('apicon'); ?>',
      method: 'POST',
      dataType: 'json',
      success: function(data) {
        // Limpar a tabela antes de preenchê-la com os novos dados
        $('#tabela-pedidos > tbody').empty();
        // Iterar sobre os dados recebidos e adicionar uma linha para cada pedido
        $.each(data, function(index, pedido) {
          $('#tabela-pedidos > tbody').append(`
            <tr>
              <td>${pedido.local_de_entrega}</td>
              <td>${pedido.local_de_busca}</td>
              <td>${pedido.descricao}</td>
              <td>${pedido.peso}kg</td>
              <td>${pedido.tamanho_pacote}</td>
              <td>${pedido.status}</td>
              <td>${pedido.rastreio}</td>
             
            </tr>
          ` );
        });
      },
      error: function(xhr, textStatus, errorThrown) {
        console.error(xhr.responseText);
      }
    });
});

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html>
