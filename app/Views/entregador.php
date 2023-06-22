<!DOCTYPE html>
<html>
<head>
  <title>Pedidos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<!-- Link para jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<!-- Link para Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
  /* Estilos para o modal */
.modale {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal-contente {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}

/* Estilos para o botão de fechar */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
</head>
<body>
<div id="relatorioModal" class="modale">
  <div class="modal-contente">
    <span class="close">&times;</span>
    <p>Selecione o mês e o ano:</p>
    <select id="mes">
      <option value="1">Janeiro</option>
      <option value="2">Fevereiro</option>
      <option value="3">Março</option>
      <option value="4">Abril</option>
      <option value="5">Maio</option>
      <option value="6">Junho</option>
      <option value="7">Julho</option>
      <option value="8">Agosto</option>
      <option value="9">Setembro</option>
      <option value="10">Outubro</option>
      <option value="11">Novembro</option>
      <option value="12">Dezembro</option>
    </select>
    <input type="number" id="ano" placeholder="Digite o ano" value='2023'>
    <button id="btnSelecionar" type="button" class="btn-relatorio">Selecionar</button>
  </div>
</div>


  <div class="container">
    <h1>Pedidos Aguardando Confirmação</h1> 
    <button id="btnSenha" type="button" class="btn btn-primary">Alteração de senha</button>
    <div id="modalSenha" class="modal fade">
  <div class="modal-dialog">
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
    <button type="button" class="btn btn-success"  style="right:8vw; top:5vh; position: absolute;">Relatorio mensal</button>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Clientes</th>
          <th>Endereço de Busca</th>
          <th>Endereço de Entrega</th>
          <th>Descrição</th>
          <th>Status</th>
          <th>Peso</th>
          <th>Tamanho</th>
          <th>Recebedor     </th>
          <th>Ação</th>
          <th>valor</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php if(empty($pedidos)): ?> <script>
  alert("sem entregas em andamento no momento");
  </script>
<?php endif; ?>

        <?php foreach ($pedidos as $pedido): ?>
          <tr>
            <td><?php echo $pedido->nome_usuario; ?></td>
            <td><?php echo $pedido->local_de_busca; ?></td>
            <td><?php echo $pedido->local_de_entrega; ?></td>
            <td><?php echo $pedido->descricao; ?></td>
            <td><?php echo $pedido->status; ?></td>
            <td><?php echo $pedido->peso; ?>kg</td>
            <td><?php echo $pedido->tamanho_pacote; ?></td>
            <td><?php echo $pedido->recebedor; ?></td>

           <?php if ($value == 2) { ?>
    <td>
        <form method="post">
       <?php if($pedido->status == 'Aguardando coleta'){?>
          <button type="button" class="btn btn-success coletar-btn" data-pedido-id="<?php echo $pedido->id; ?>" data-toggle="modal" data-target="#coleta-modal" onclick='exec("<?= $pedido->id ?>")'>Coletar</button>

          <?php }else{?>
          <button type="button" class="btn btn-success" data-pedido-id="<?php echo $pedido->id; ?>" data-toggle="modal" data-target="#finalizar-modal">Finalizar</button>
        <?php }?>
        </form>
            </td>
        <?php }else{echo "<td></td>";}; ?>
            <td><?php echo $pedido->repasse; ?></td>
            <?php echo '<td><button><a href="https://www.google.com/maps/dir/'. $pedido->local_de_busca .'/'. $pedido->local_de_entrega .'" target="_blank">Rota</a></button></td>';?>
            <?php endforeach; ?>



            <?php foreach ($atribuir as $pedido): ?>
          <tr>
            <td></td>
            <td><?php echo $pedido->local_de_busca; ?></td>
            <td><?php echo $pedido->local_de_entrega; ?></td>
            <td><?php echo $pedido->descricao; ?></td>
            <td><?php echo $pedido->status; ?></td>
            <td><?php echo $pedido->peso; ?>kg</td>
            <td><?php echo $pedido->tamanho_pacote; ?></td>
            <td></td>
            <td>
            <button type="button" class="btn btn-primary btn-atribuir" data-pedidoid="<?php echo $pedido->id; ?>">Aceitar/Negar</button>

            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
     

  // Evento de clique para o botão de atribuir
  $(document).on("click", ".btn-atribuir", function() {
    var pedidoId = $(this).data('pedidoid');
    Swal.fire({
      title: 'Deseja aceitar a corrida?',
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não',
      showLoaderOnConfirm: true,
      preConfirm: function(choice) {

      }
    })
    .then(function(result) {
      if (result.isConfirmed) {
        // Lógica de sucesso
        $.ajax({
          url: '<?= base_url('econfirmentregadorapi')?>',
          method: 'POST',
          data: { pedidoId: pedidoId },
          success: function(response) {
            // Lógica para lidar com a resposta do servidor
            location.reload();
          },
          error: function(xhr, status, error) {
            // Lógica para lidar com erros de solicitação
          }
        });
      } else {
        $.ajax({
          url: '<?= base_url('declineentregadorapi')?>',
          method: 'POST',
          data: { pedidoId: pedidoId },
          success: function(response) {
            // Lógica para lidar com a resposta do servidor
            location.reload();
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      }
    });
  });

</script>

            </td>

            <td><?php echo $pedido->repasse; ?></td>
            <?php echo '<td><button><a href="https://www.google.com/maps/dir/'. $pedido->local_de_busca .'/'. $pedido->local_de_entrega .'">Rota</a></button></td>';?>
            <?php endforeach; ?>


<!-- Modal -->
<div class="modal fade" id="finalizar-modal" tabindex="-1" aria-labelledby="finalizar-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="finalizar-modal-label">Dados do recebedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Nome:</p>
                <input type="text" id="nome-input" class="form-control" placeholder="Insira o nome do recebedor">                
                <p>Documento:</p>
                <input type="text" id="doc-input" class="form-control" placeholder="Insira o documento do recebedor">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary finalizar-submit" id="finalizar-submit">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="coleta-modal" tabindex="-1" aria-labelledby="coleta-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="coleta-modal-label">Dados do recebedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Nome:</p>
        <input type="text" id="coletanome-input" class="form-control" placeholder="Insira o nome do cliente">                
        <p>Documento:</p>
        <input type="text" id="coletadoc-input" class="form-control" placeholder="Insira o documento do cliente">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="coleta-submit">Confirmar</button>
      </div>
    </div>
  </div>
</div>

          </tr>
      </tbody>
    </table>
  </div>
  <script>
    var suporte;
    
    function exec(id){
      suporte = id;
    }

    $(document).on("click", "#coleta-submit", function() {
    // Obtenha o ID do pedido e os valores dos inputs
    var pedidoId = suporte;
    var nome = $("#coletanome-input").val();
    var documento = $("#coletadoc-input").val();


    // Crie um objeto de dados para enviar os dados
    var data = {
      pedidoId: pedidoId,
      nome: nome,
      documento: documento
    };

    // Faça a solicitação AJAX
    $.ajax({
      type: "POST",
      url: "<?= base_url('coletaconfirmapi') ?>",
      data: data,
      success: function(response) {
   location.reload();
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Houve um erro na solicitação AJAX
        console.error("Erro na solicitação AJAX. Status: " + xhr.responseText);
      }
    });
  });

            // Quando o botão de senha é clicado, exibe o modal
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
    url: '<?= base_url('econfirmentregadorapi')?>',
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
        

// Quando o usuário clicar no botão de selecionar, armazene o valor selecionado e feche o modal
var btnSelecionar = document.getElementById("btnSelecionar");
btnSelecionar.onclick = function() {
  var mes = document.getElementById("mes").value;
  var ano = document.getElementById("ano").value;
  var id = <?= $id ?>;
  var novaJanela = window.open('<?= base_url()?>entregador/download/'+ id +'/mes/'+ mes +'/ano/'+ ano);  
  modal.style.display = "none";
  // Use a variável "mes" como quiser a partir daqui
}

            // Obtenha o botão e o modal
var btn = document.querySelector(".btn-success");
var modal = document.getElementById("relatorioModal");

// Obtenha o botão de fechar
var span = document.querySelector(".close");

// Quando o usuário clicar no botão, abra o modal
btn.onclick = function() {
  modal.style.display = "block";
}

// Quando o usuário clicar no botão de fechar, feche o modal
span.onclick = function() {
  modal.style.display = "none";
}

// Quando o usuário clicar em qualquer lugar fora do modal, feche-o
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


        $('#finalizar-modal').on('shown.bs.modal', function() {
            $('#finalizar-input').focus();
        });


        $('#finalizar-submit').on('click', function() {
          // Encontre o botão na página
          const botao = document.querySelector('.btn[data-toggle="modal"]');

          // Obtenha o valor do atributo data-pedido-id
          const pedidoId = botao.getAttribute('data-pedido-id'); 
            var nome = $('#nome-input').val();
            var doc = $('#doc-input').val();


            // Fazer a chamada AJAX
            $.ajax({
              url: '<?= base_url('econfirmentregadorapi')?>',
                type: 'POST',
                data: { pedidoId: pedidoId, nome: nome, doc: doc },
                success: function(response) {
                    // Exibir o alerta com a resposta
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
          alert('contate um administrador');
          console.log(xhr.responseText);}
            });
        });

        $('#finalizar-modal').on('shown.bs.modal', function() {
            $('#finalizar-input').focus();
        });

        $('#finalizar-submit').on('click', function() {
            var pedidoId = $('.btn-success').data('pedido-id');
            var inputVal = $('#finalizar-input').val();
        });


  </script>
</body>
</html>