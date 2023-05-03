<?php

namespace App\Controllers;

use TCPDF;

class Admin extends BaseController
{
    public function adminv()
    {
        return view('admin');
    }
    public function admin()
    {



        $db = \Config\Database::connect();

        $id = $_POST['id'];
        $novoStatus = $_POST['status'];

        $db->query("UPDATE pedidos SET status = '$novoStatus' WHERE id = $id");




    }
    public function entregador()
    {


        $db = \Config\Database::connect();

        // Verifica se foi enviado um formulário
        if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['cpf'])) {
            // Obtém os valores do formulário
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = hash('sha3-256', $_POST['senha']);
            $cpf = $_POST['cpf'];
            $veiculo = $_POST['veiculo'];
            $placa = $_POST['placa'];

            // Insere o entregador no banco de dados
            $data = [
              'nome' => $nome,
              'email' => $email,
              'senha' => $senha,
              'cpf' => $cpf,
              'veiculo' => $veiculo,
              'placa' => $placa
            ];
            $builder = $db->table('entregadores');
            $builder->insert($data);

            // Redireciona de volta para a página anterior
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } elseif (isset($_POST['id'])) {
            $id = $_POST['id'];

            // Deleta o entregador no banco de dados
            $builder = $db->table('entregadores');
            $builder->where('id', $id);
            $builder->update('online', '0');
            $builder = $db->table('entregadores');
            $builder->where('id', $id);
            $builder->update('ultimo_pedido', '');

            // Retorna uma mensagem de sucesso para o JavaScript
            echo json_encode(['success' => true]);
            exit();


        }
    }

public function apicon()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = \Config\Database::connect();
        $builder = $db->table('pedidos');
        $builder->select('*');
        $builder->join('usuarios', 'usuarios.id = pedidos.id_usuario');
        $builder->where('pedidos.status', 'cancelado');
        $pedidos = $builder->get()->getResult();


        echo json_encode($pedidos);
    } else {
        header("Location: " . base_url('login'));
        die();

    }
}
  public function confirmentregadorapi()
  {
      $db = \Config\Database::connect();
      if (isset($_POST['choice'])){
      $check = $_POST['choice'];
      if ($check == "6"){
        $builder = $db->table('pedidos');

      $pedido_id = $_POST['id'];
      $data = [
        'status' => 'Confirmado, aguardando entregador'
      ];
      $builder->where('id', $pedido_id);
          $builder->update($data);
          die();
      }}

     
      $builder = $db->table('pedidos');

      $pedido_id = $_POST['pedido_id'];
      $repasse = $_POST['repasse'];
      if (isset($_POST['ids'])) {
          $vision = $_POST['ids'];
      } else {
          $vision = "0";
      }
      if (isset($_POST['entregador_id'])) {
          $entregador_id = $_POST['entregador_id'];
      } else {
          $data = [
            'status' => 'Aguardando entregador',
            'repasse' => $repasse,
            'vision' => $vision];
          $builder->where('id', $pedido_id);
          $builder->update($data);

          echo "atribuido";
          die();
      }
      $data = [
                'id_entregador' => $entregador_id,
                'status' => 'Aguardando usuario',
                'repasse' => $repasse,
                'vision' => $vision];
      $builder->where('id', $pedido_id);
      $builder->update($data);

      echo "atribuido";
  }

  public function download($choice, $id, $mes)
  {
      if ($choice==1) {


          $db = \Config\Database::connect();
          $id_entregador = $id;
          $mes = $mes;
          $pedidos = $db->table('pedidos')
              ->join('entregadores', 'entregadores.id = pedidos.id_entregador')
              ->where('pedidos.id_entregador', $id_entregador)
              ->where('MONTH(pedidos.date)', $mes)
              ->where('pedidos.status', 'entregue')
              ->select('pedidos.*, entregadores.nome as nome_entregador')
              ->get()
              ->getResultArray();
          $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
          // Verifica se a consulta SQL não retornou nenhum registro
          if (count($pedidos) == 0) {
              $pdf->SetFont('helvetica', '', 12);
              $pdf->AddPage();
              $pdf->Ln();
              $pdf->Write(5, 'Sem entregas');
          } else {


              // Cria uma instância do TCPDF


              // Define o conteúdo do PDF
              $pdf->SetFont('helvetica', '', 12);
              $pdf->AddPage();
              $pdf->Ln();
              $qntpedidos = "0";
              $hr = '<hr>';
              $pdf->writeHTML($hr);
              $valorTotal = "0";


              // Adiciona os dados dos pedidos ao PDF
              foreach ($pedidos as $pedido) {
                  $pdf->Write(5, 'Pedido #' . $qntpedidos + 1);
                  $qntpedidos = $qntpedidos + 1;
                  $pdf->Ln();
                  $pdf->Write(5, 'Data: ' . $pedido['date']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Descrição: ' . $pedido['descricao']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Local de busca: ' . $pedido['local_de_busca']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Local de entrega: ' . $pedido['local_de_entrega']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Peso: ' . $pedido['peso'] . ' kg');
                  $pdf->Ln();
                  $pdf->Write(5, 'Status: ' . $pedido['status']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Valor: R$' . number_format($pedido['repasse'], 2));
                  $pdf->Ln();
                  $pdf->Ln();
                  $pdf->writeHTML($hr);
                  $valorTotal = $valorTotal + $pedido['repasse'];

              }

              $pdf->Write(5, 'Valor total: R$' . number_format($valorTotal, 2));
          }
          // Gera o PDF e o exibe na tela
          $pdf->Output('pedidos_entregador_' . $id . '_mes_' . $mes . '.pdf', 'D');
          return;


      } elseif($choice==2) {

          $db = \Config\Database::connect();
          $id_usuario = $id;
          $mes = $mes;
          $pedidos = $db->table('pedidos')
                  ->join('usuarios', 'usuarios.id = pedidos.id_usuario')
                  ->where('pedidos.id_usuario', $id_usuario)
                  ->where('MONTH(pedidos.date)', $mes)
                  ->where('pedidos.status', 'entregue')
                  ->select('pedidos.*, usuarios.nome as nome_usuario')
                  ->get()
                  ->getResultArray();

          // Cria uma instância do TCPDF
          $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
          if (count($pedidos) == 0) {
              $pdf->SetFont('helvetica', '', 12);
              $pdf->AddPage();
              $pdf->Ln();
              $pdf->Write(5, 'Sem entregas');
              $pdf->Output('pedidos_cliente_' . $id . '_mes_' . $mes . '.pdf', 'D');
              die();
              return;
          } else {
              // Define o conteúdo do PDF
              $pdf->SetFont('helvetica', '', 12);
              $pdf->AddPage();
              $pdf->Write(5, 'Pedidos do cliente ' . $pedidos[0]['nome_usuario']  . ' no mês ' . $mes . ':');
              $pdf->Ln();
              $qntpedidos = "0";
              $hr = '<hr>';
              $pdf->writeHTML($hr);
              $valorTotal = "0";

              // Adiciona os dados dos pedidos ao PDF
              foreach ($pedidos as $pedido) {
                  $pdf->Write(5, 'Pedido #' . $qntpedidos + 1);
                  $qntpedidos = $qntpedidos + 1;
                  $pdf->Ln();
                  $pdf->Write(5, 'Data: ' . $pedido['date']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Descrição: ' . $pedido['descricao']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Local de busca: ' . $pedido['local_de_busca']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Local de entrega: ' . $pedido['local_de_entrega']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Peso: ' . $pedido['peso'] . ' kg');
                  $pdf->Ln();
                  $pdf->Write(5, 'Status: ' . $pedido['status']);
                  $pdf->Ln();
                  $pdf->Write(5, 'Valor: R$' . number_format($pedido['valor'], 2));
                  $pdf->Ln();
                  $pdf->Ln();
                  $pdf->writeHTML($hr);
                  $valorTotal = $valorTotal + $pedido['valor'];
              }
              $pdf->Write(5, 'Valor total: R$' . number_format($valorTotal, 2));
          }

          // Gera o PDF e o exibe na tela
          $pdf->Output('pedidos_cliente_' . $id_usuario . '_mes_' . $mes . '.pdf', 'D');


      } else {
          die();
      }


  }
}
