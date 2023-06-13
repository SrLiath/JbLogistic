<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Link para jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<!-- Link para Bootstrap JS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Inclui o CSS do Datepicker -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<!-- Inclui o JS do Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<div class="container">
  
	<h2>Painel Administrador</h2> 
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-cadastrar-entregador" style="left:0px;">Cadastrar entregador</button>
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-listar-entregadores" style="margin-left:10px;">Listar entregadores</button>
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#listaUsuariosModal" style="margin-left:10px;">Ver clientes</button>
    <button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancel-modal"  style="margin-left:10px;">cancelados</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="right:12vw;position: absolute;">relatorio</button>
    <hr>
	<br>
    <ul class="nav nav-tabs">
    <li  class="active"><a data-toggle="tab" href="#pedidos">Pedidos</a></li>
    <li><a data-toggle="tab" href="#entregas">Entregas em Andamento</a></li>

</ul>


<!-- Modal principal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Relatorios</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Qual será o relatorio?</p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
          Entregadores
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
          Clientes
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Primeiro modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Entregadores</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <table class="table table-striped">
      <thead>
      <div class="input-group date">
      <input type="date" id="data-relatorio" name="data-relatorio" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
      <div class="input-group-append">
        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
    </div>
</div>




                        <tr>
                            <th>Nome</th>
                            <th>veiculo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $db = \Config\Database::connect();
      $query = $db->query('SELECT * FROM entregadores WHERE online = 1');
      $entregadores = $query->getResult();

      if (!empty($entregadores)) {
          foreach ($entregadores as $entregador) {
              echo "<tr>";
              echo "<td>" . $entregador->nome . "</td>";
              echo "<td>" . $entregador->veiculo . "</td>";
              echo '<td><button type="button" class="btn btn-primary btn-relatorio-entre" data-id_entregador="'. $entregador->id.'" data-dismiss="modal">relatorio</button></td>';
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='3'>Nenhum entregador disponível.</td></tr>";
      }
      ?>
                    </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Segundo modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel2">Clientes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <div class="input-group date">
              <input type="date" id="data-relatorio" name="data-relatorio" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
              <div class="input-group-append">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
            </div>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>CPF</th>
              <th>Telefone</th>
              <th>Ação </th>
            </tr>
          </thead>
          <tbody>
            <?php
              $db = \Config\Database::connect();
      $query = $db->query('SELECT * FROM usuarios');
      $usuarios = $query->getResult();
      if (!empty($usuarios)) {
          foreach ($usuarios as $usuario) {
              echo "<tr>";
              echo "<td>" . $usuario->nome . "</td>";
              echo "<td>" . $usuario->email . "</td>";
              echo "<td>" . $usuario->cpf . "</td>";
              echo '<td><a href="https://wa.me/55'.$usuario->telefone.'" class="btn btn-primary btn-sm">WhatsApp</a></td>';
              echo '<td><button type="button" class="btn btn-primary btn-relatorio-usu" data-id_usuario="'. $usuario->id.'" data-dismiss="modal">relatorio</button></td>';
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='3'>Nenhum entregador disponível.</td></tr>";
      }
      ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<!-- fim dos modals de relatorio -->
<!-- modal de listar usuarios -->
<div class="modal fade" id="listaUsuariosModal" tabindex="-1" role="dialog" aria-labelledby="listaUsuariosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listaUsuariosModalLabel">Lista de usuários</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>CPF</th>
              <th>Telefone</th>
              <th>Whatsapp</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $db = \Config\Database::connect();
              // Consulta ao banco de dados para obter as informações dos usuários
              $query = $db->query('SELECT * FROM usuarios');
              $usuarios = $query->getResult();

              // Exibe os resultados do banco de dados
              if (!empty($usuarios)) {
                  foreach ($usuarios as $usuario) {
                      echo "<tr>";
                      echo "<td>" . $usuario->nome . "</td>";
                      echo "<td>" . $usuario->email . "</td>";
                      echo "<td>" . $usuario->cpf . "</td>";
                      echo "<td>" . $usuario->telefone . "</td>";
                      echo '<td><a href="https://wa.me/55'.$usuario->telefone.'" class="btn btn-primary btn-sm">WhatsApp</a></td>';
                      echo "</tr>";
                  }
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- conteudo de tabs -->
<div class="tab-content">
    <div id="entregas" class="tab-pane fade">
    <input class="form-control" id="filtro-entregas" type="text" placeholder="Filtrar resultados...">
    <br>
    <table class="table">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-entregues">Entregues</button>
        <thead>
            <tr>
                <th>Local de entrega</th>
                <th>Descrição</th>
                <th>Peso</th>
                <th>Status</th>
                <th>Valor</th>
                <th>Cliente</th>
                <th>Entregador</th>
                <th>Whatsapp</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php
      $db = \Config\Database::connect();
      // Consulta ao banco de dados para obter as informações dos pedidos
      $query = $db->query('SELECT pedidos.*, usuarios.nome as nome_usuario, usuarios.telefone as tel, entregadores.nome AS nome_entregador
            FROM pedidos
            JOIN usuarios ON pedidos.id_usuario = usuarios.id
            LEFT JOIN entregadores ON pedidos.id_entregador = entregadores.id
            WHERE pedidos.status IN ("A caminho de entrega", "aguardando usuário")
            ');
      $entregas = $query->getResult();

      // Exibe os resultados do banco de dados
      if (!empty($entregas)) {
          foreach ($entregas as $entrega) {
              echo "<tr>";
              echo "<td>" . $entrega->local_de_entrega . "</td>";
              echo "<td>" . $entrega->descricao . "</td>";
              echo "<td>" . $entrega->peso . " kg</td>";
              echo "<td>" . $entrega->status . "</td>";
              echo "<td>R$" . number_format($entrega->valor, 2, ',', '.') . "</td>";
              echo "<td>" . $entrega->nome_usuario . "</td>";
              echo "<td>" . $entrega->nome_entregador . "</td>";
              echo '<td><a href="https://wa.me/55'.$entrega->tel.'" class="btn btn-primary btn-sm">WhatsApp</a></td>';
              echo '<td><button type="button" class="btn btn-primary btn-editar-status btn btn-warning btn-sm" data-id="'. $entrega->id.'">status</button></td>';
              echo "</tr>";
          }
      }
      ?>
        </tbody>
    </table>
</div>


		
		<div id="pedidos" class="tab-pane fade in active">
			<input class="form-control" id="filtro-pedidos" type="text" placeholder="Filtrar resultados...">
			<br>
			<table class="table">
				<thead>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-entregues">Entregues</button>
					<tr>
						<th>Local de entrega</th>
						<th>Descrição</th>
						<th>Peso</th>
						<th>Status</th>
            <th>Cliente</th>
            <th>Entregador</th>
            <th>Valor</th>
            <th>Whatsapp</th>
						<th>Editar</th>
					</tr>
				</thead>
				<tbody>
					<?php
       $db = \Config\Database::connect();
      // Consulta ao banco de dados para obter as informações dos pedidos
      $query = $db->query('SELECT 
                    pedidos.*, 
                    usuarios.nome AS nome_usuario, 
                    usuarios.telefone AS tel,
                    entregadores.nome AS nome_entregador
                FROM 
                    pedidos
                    JOIN usuarios ON pedidos.id_usuario = usuarios.id
                    LEFT JOIN entregadores ON pedidos.id_entregador = entregadores.id
                WHERE 
                    pedidos.status <> "entregue" AND pedidos.status <> "cancelado";
                    
                    ');
      $pedidos = $query->getResult();

      // Exibe os resultados do banco de dados
      if (!empty($pedidos)) {
          foreach ($pedidos as $pedido) {
              echo "<tr>";
              echo "<td>" . $pedido->local_de_entrega . "</td>";
              echo "<td>" . $pedido->descricao . "</td>";
              echo "<td>" . $pedido->peso . "kg</td>";
              echo "<td>" . $pedido->status . "</td>";
              echo "<td>" . $pedido->nome_usuario . "</td>";
              echo "<td>" . $pedido->nome_entregador . "</td>";
              echo "<td>R$" . number_format($pedido->valor, 2, ',', '.') . "</td>";
              echo '<td><a href="https://wa.me/55'.$pedido->tel.'" class="btn btn-primary btn-sm">WhatsApp</a></td>';
              echo '<td>';
              echo '<button type="button" class="btn btn-primary btn-editar-status" data-id="'. $pedido->id.'">status</button>';
              echo '</td>';
              echo '<td>';
              if($pedido->status == "Aguardando confirmação"){
              echo '<button type="button" class="btn btn-primary btn-confirmar" data-id="'. $pedido->id.'">confirmar</button>';

              }else{
              echo '<button type="button" class="btn btn-primary btn-atribuir-entregador" data-id="'. $pedido->id.'" data-toggle="modal" data-target="#modal-entregadores">Atribuir Entregador</button>';}
              echo '</td>';

              echo "</tr>";
          }
      }
      ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
  
  $('.btn-confirmar').click(function() {
    var id = $(this).data('id');
    $.ajax({
      url: '<?=base_url('confirmentregadorapi')?>',
      type: 'POST',
      data: { id: id, choice: '6' },
      success: function(response) {
        location.reload();
      }
    });
  });

  $(document).on('click', '.btn-relatorio-entre', function() {
  var entregadorId = $(this).data('id_entregador');
  var dataString = $('#data-relatorio').val(); // string da data no formato "yyyy-mm-dd"
var data = new Date(dataString); // cria um objeto Date com a string da data
var ano = data.getFullYear().toString().substr(-4); // extrai os dois últimos dígitos do ano
var mes = (data.getMonth() + 1).toString().padStart(2, '0'); // extrai o mês e adiciona um zero à esquerda se necessário

  var choice = 1;
var novaJanela = window.open('<?= base_url()?>admin/pdf/'+ choice +'/id/'+ entregadorId +'/mes/'+ mes +'/'+ ano +'/download');

});
$(document).on('click', '.btn-relatorio-usu', function() {
  var entregadorId = $(this).data('id_usuario');
  var dataString = $('#data-relatorio').val(); // string da data no formato "yyyy-mm-dd"
var data = new Date(dataString); // cria um objeto Date com a string da data
var ano = data.getFullYear().toString().substr(-4); // extrai os dois últimos dígitos do ano
var mes = (data.getMonth() + 1).toString().padStart(2, '0'); // extrai o mês e adiciona um zero à esquerda se necessário
  var choice = 2;
  var novaJanela = window.open('<?= base_url()?>admin/pdf/'+ choice +'/id/'+ entregadorId +'/mes/'+ mes +'/'+ ano +'/download');

});

	// Filtro para o banco de usuários
	$("#filtro-usuarios").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#usuarios tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	// Filtro para o banco de pedidos
	$("#filtro-pedidos").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#pedidos tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
});
</script>
<!-- modal de cadastro de entregador -->
<div class="modal fade" id="modal-cadastrar-entregador" tabindex="-1" role="dialog" aria-labelledby="modal-cadastrar-entregador-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-cadastrar-entregador-label">Cadastrar entregador</h4>
            </div>
            <div class="modal-body">
                <form id="form-cadastrar-entregador">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">Veiculo:</label>
                        <input type="text" class="form-control" id="veiculo" name="veiculo" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">Placa:</label>
                        <input type="text" class="form-control" id="placa" name="placa" required>
                    </div>
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Atribuir Entregador -->
<div class="modal fade" id="modal-entregadores" tabindex="-1" role="dialog" aria-labelledby="modal-entregadores-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-entregadores-label">Atribuir Entregador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">  
      <div class="form-group col-md-6">
          <label for="repasse">Repasse:</label>
          <input type="text" class="form-control" id="repasse" name="repasse" required pattern="[0-9\.]+">
        </div>
        <div class="form-group col-md-6">
        <button type="button" class="btn btn-primary btn-vision" data-dismiss="modal" style="position: absolute; top: 4vh;" >Atribuir selecionados</button>
        </div>
      </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="selecionar-todos"></th>
              <th>Nome</th>
              <th>Veículo</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = $db->query('SELECT * FROM entregadores WHERE online = 1');
      $entregadores = $query->getResult();
      if (!empty($entregadores)) {
          foreach ($entregadores as $entregador) {
              echo "<tr>";
              echo '<td><input type="checkbox" name="entregadores[]" value="' . $entregador->id . '"></td>';
              echo "<td>" . $entregador->nome . "</td>";
              echo "<td>" . $entregador->veiculo . "</td>";
              echo '<td><button type="button" class="btn btn-primary btn-atribuir" data-id_entregador="'.$entregador->id.'" data-dismiss="modal">Atribuir</button></td>';
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='4'>Nenhum entregador disponível.</td></tr>";
      }
      ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary btn-vision" data-dismiss="modal">Atribuir Selecionados</button>
      </div>
    </div>
  </div>
</div>


<!-- modal cancelados -->
<div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="cancel-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:110%;">
      <div class="modal-header">
        <h5 class="modal-title" id="cancel-modal-label">Cancelados</h5>
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
    </div>
  </div>
</div>

<!-- modal listar entregadores-->
<div class="modal fade bd-example-modal-lg" id="modal-listar-entregadores" tabindex="-1" role="dialog" aria-labelledby="modal-listar-entregadores-label">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content  " style="  overflow-y: auto; ">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-listar-entregadores-label">Lista de entregadores</h4>
      </div>
      <div class="modal-body ">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Email</th>
              <th>CPF</th>
              <th>Placa</th>
              <th>Veiculo</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody>
            <?php
      $db = \Config\Database::connect();
      $query = $db->query("SELECT *
            FROM entregadores
            ");
      $entregadores = $query->getResult();
      foreach ($entregadores as $entregador) {
          echo '<tr>';
          echo '<td>' . $entregador->id . '</td>';
          echo '<td>' . $entregador->nome . '</td>';
          echo '<td>' . $entregador->email . '</td>';
          echo '<td>' . $entregador->cpf . '</td>';
          echo '<td>' . $entregador->placa . '</td>';
          echo '<td>' . $entregador->veiculo . '</td>';
          echo '<td><button class="btn btn-danger btn-sm" onclick="excluirEntregador(' . $entregador->id . ')">Desativar</button></td>';
          echo '</tr>';
      }
      ?>
            </tbody>
          </table>
        </div>
      </div>
 </div>
</div>      


<!--modal de alterar status -->
<div class="modal fade" id="modal-editar-status" tabindex="-1" role="dialog" aria-labelledby="modal-editar-status-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-editar-status">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-editar-status-label">Editar status do pedido</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="select-status">Novo status:</label>
                        <select class="form-control" id="select-status" name="status">
                            <option value="pendente">Pendente</option>
                            <option value="em andamento">Em andamento</option>
                            <option value="entregue">Entregue</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar mudança</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal de entregues -->
<div class="modal fade" id="modal-entregues" tabindex="-1" role="dialog" aria-labelledby="modal-entregues-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal-entregues-label">Pedidos Entregues</h4>
            </div>
            <div class="modal-body">
                <table class="table  table-striped">
                    <thead>
                        <tr>
                            <th>Local de entrega</th>
                            <th>Descrição</th>
                            <th>Peso</th>
                            <th>Status</th>
                            <th>Entregador</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                $db = \Config\Database::connect();

      // Adicione as linhas abaixo para calcular a página atual e o número de registros por página
      $per_page = 10;
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $start = ($page - 1) * $per_page;

      $query = $db->query("SELECT pedidos.*, entregadores.nome AS nome_entregador 
                        FROM pedidos 
                        LEFT JOIN entregadores ON pedidos.id_entregador = entregadores.id 
                        WHERE pedidos.status = 'entregue'
                        LIMIT $start, $per_page");
      $pedidos = $query->getResult();

      if (!empty($pedidos)) {
          foreach ($pedidos as $pedido) {
              echo "<tr>";
              echo "<td>" . $pedido->local_de_entrega . "</td>";
              echo "<td>" . $pedido->descricao . "</td>";
              echo "<td>" . $pedido->peso . "</td>";
              echo "<td>" . $pedido->status . "</td>";
              echo "<td>" . $pedido->nome_entregador . "</td>";
              echo "<td>R$" . $pedido->valor . "</td>";

              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='4'>Nenhum pedido entregue encontrado.</td></tr>";
      }
      ?>
                    </tbody>
                </table>

                <!-- Adicione as linhas abaixo para exibir a paginação -->
                <?php
                $query_count = $db->query("SELECT COUNT(*) AS total FROM pedidos WHERE status = 'entregue'");
      $row = $query_count->getRow();
      $total_pages = ceil($row->total / $per_page);
      ?>

                <nav aria-label="Paginação">
                    <ul class="pagination">
                        <?php
              if ($page > 1) {
                  echo "<li><a href='?page=".($page-1)."'>Anterior</a></li>";
              }

              for ($i = 1; $i <= $total_pages; $i++) {
                  $active = ($i == $page) ? "active" : "";
                  echo "<li class='$active'><a href='?page=$i'>$i</a></li>";
              }

              if ($page < $total_pages) {
                  echo "<li><a href='?page=".($page+1)."'>Próximo</a></li>";
              }
      ?>
                    </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<script>
const inputRepasse = document.getElementById("repasse");

inputRepasse.addEventListener("input", function() {
  // substitui "," por "." e remove caracteres não-numéricos
  this.value = this.value.replace(/[^0-9,.]/g, "").replace(",", ".");

  // garante que apenas um ponto seja permitido na string
  const match = this.value.match(/\./g);
  if (match !== null && match.length > 1) {
    this.value = this.value.slice(0, this.value.lastIndexOf(".")) + this.value.slice(this.value.lastIndexOf(".") + 1);
  }
});


                        
$(document).ready(function() {
  let ids = ";";
  $('input[name="entregadores[]"]').change(function() {
     ids = ';';
    $('input[name="entregadores[]"]:checked').each(function() {
        ids += $(this).val() + ';';
    });
    $(this).closest('tr').data('ids', ids);
});
    $('#selecionar-todos').click(function() {
    $('input[name="entregadores[]"]').prop('checked', this.checked);
     ids = ';';
    $('input[name="entregadores[]"]:checked').each(function() {
        ids += $(this).val() + ';';
    });
  });

    
    $('.btn-atribuir-entregador').click(function() {
        var id_pedido = $(this).data('id');
        $('#modal-entregadores').data('id-pedido', id_pedido);
    });
    $('.btn-vision').click(function() {
    var id_pedido = $('#modal-entregadores').data('id-pedido');
    var repasse = $('#repasse').val();

    $.ajax({
      url: '<?=base_url('confirmentregadorapi')?>',
      type: 'POST',
      data: {pedido_id: id_pedido, ids: ids, repasse: repasse},
      success: function(response) {
        alert(response);
        location.reload();
    },
      error: function(xhr, status, error) {
        console.error(error);
        console.error(xhr.responseText);

      }
    });
  });
  $('.btn-atribuir').click(function() {
    var entregadorId = $(this).data('id_entregador');
    var id_pedido = $('#modal-entregadores').data('id-pedido');
    var repasse = $('#repasse').val();

    $.ajax({
      url: '<?=base_url('confirmentregadorapi')?>',
      type: 'POST',
      data: {pedido_id: id_pedido, entregador_id: entregadorId, repasse: repasse},
      success: function(response) {
        alert(response);
        location.reload();
    },
      error: function(xhr, status, error) {
        console.error(error);
        console.error(xhr.responseText);

      }
    });
  });
});
    function excluirEntregador(id) {
  if (confirm('Tem certeza que deseja excluir este entregador?')) {
    $.ajax({
      url: '<?= base_url('apientregador')?>',
      type: 'POST',
      data: { id: id },
      success: function(data) {
    location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  }
}
$(document).ready(function() {

  var itemsPerPage = 10; // número de itens por página
  var currentPage = 1; // página atual
  var totalItems = $('#tabela-pedidos tbody tr').length; // total de itens
  var totalPages = Math.ceil(totalItems / itemsPerPage); // número total de páginas

  // Mostrar a primeira página e esconder as demais
  $('#tabela-pedidos tbody tr').slice(itemsPerPage).hide();

  // Adicionar os links de navegação da páginação
  var pagination = '<ul class="pagination">';
  pagination += '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>';
  for (var i = 1; i <= totalPages; i++) {
    pagination += '<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>';
  }
  pagination += '<li class="page-item"><a class="page-link" href="#">Próxima</a></li>';
  pagination += '</ul>';
  $('.modal-footer').append(pagination);

  // Atualizar a página ao clicar nos links de navegação
  $('.pagination').on('click', 'a', function(event) {
    event.preventDefault();
    var pageNumber = $(this).text();
    if ($(this).text() == 'Anterior') {
      if (currentPage == 1) return false;
      pageNumber = parseInt(currentPage) - 1;
    }
    if ($(this).text() == 'Próxima') {
      if (currentPage == totalPages) return false;
      pageNumber = parseInt(currentPage) + 1;
    }
    var startItem = (pageNumber - 1) * itemsPerPage;
    var endItem = startItem + itemsPerPage;
    $('#tabela-pedidos tbody tr').hide().slice(startItem, endItem).fadeIn(1000);
    $('.pagination li').removeClass('active');
    $('.pagination li:nth-child(' + (parseInt(pageNumber) + 1) + ')').addClass('active');
    currentPage = pageNumber;
  });

    $.ajax({
      url: '<?= base_url('apicone'); ?>',
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
              <td>${pedido.nome}</td>
             
            </tr>
          ` );
        });
      },
    });

$("#excluirentre").click(function() {
    var id = $(this).data("id");
    excluirEntregador(id);
  });


    $("#form-cadastrar-entregador").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            type: "POST",
            url: "<?= base_url('apientregador')?>",
            data: data,
            success: function(data) {
                // Exibir mensagem de sucesso
                alert("Entregador cadastrado com sucesso!");
                // Fechar popup
                $('#modal-cadastrar-entregador').modal('hide');
                // Limpar formulário
                form.trigger("reset");
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Exibir mensagem de erro
                //alert("Ocorreu um erro ao cadastrar o entregador: " + jqXHR.responseText);
            }
        });
    });
	
    // Abre o modal de edição do status quando o botão "Editar" é clicado
    $('.btn-editar-status').click(function() {
		  $("#filtro-pedidos").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#pedidos tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    // Exibir modal de pedidos entregues
    $("#pedidos .btn-entregues").on("click", function() {
        $("#modal-entregues").modal("show");
    });

        var id = $(this).data('id');
        $('#form-editar-status').data('id', id);
        $('#modal-editar-status').modal('show');
    });

    // Envia a requisição AJAX para alterar o status do pedido
    $('#form-editar-status').submit(function(event) {
        event.preventDefault();

        var id = $(this).data('id');
        var novoStatus = $('#select-status').val();

        $.ajax({
            url: "<?= base_url('admins')?>",
            type: 'POST',
            data: {id: id, status: novoStatus},
            success: function(response) {
                // Atualiza a tabela de pedidos com o novo status
                $('#pedidos tbody tr').each(function() {
                    if ($(this).find('td:first').text() == id) {
                        $(this).find('td:last').text(novoStatus);
                    }
                });

                // Fecha o modal de edição do status
                $('#modal-editar-status').modal('hide');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            }
        });
    });
});
</script>
