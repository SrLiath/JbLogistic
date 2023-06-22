<?php

namespace App\Controllers;

use TCPDF;

class Entregador extends BaseController
{
    public function entregador()
    {
        $entid = session()->get('entid');
        $elogin = session()->get('elogin');
        $password = session()->get('password');
        if($entid == "" || $elogin == ""|| $password == "") {
            header("Location: " . base_url('login'));
            die();
        } else {
            $db = \Config\Database::connect();
            $le = "0";
            // Usando o Query Builder para verificar o login do entregador
            $logine = $db->table('entregadores')
                        ->where('email', $elogin)
                        ->where('senha', $password)
                        ->countAllResults();

            if ($logine == 1) {
                // Usando o Query Builder para verificar se o entregador está online
                $entregador = $db->table('entregadores')
                               ->select('online')
                               ->where('id', $entid)
                               ->get()
                               ->getRow();

                if ($entregador->online) {
                    // Usando o Query Builder para buscar pedidos do entregador
                    $pedidos = $db->table('pedidos')
                               ->select('pedidos.*, usuarios.nome as nome_usuario')
                               ->join('usuarios', 'pedidos.id_usuario = usuarios.id')
                               ->where('pedidos.status <>', 'Entregue')
                               ->where('pedidos.status <>', 'Cancelado')
                               ->where('pedidos.id_entregador', $entid)

                               ->get()
                               ->getResult();
                    $atribuir = $db->table('pedidos')
                               ->select('*')
                               ->where('pedidos.status', 'Aguardando entregador')
                               ->like('pedidos.vision', '%;'.$entid.';%')
                               ->get()
                               ->getResult();


                    if ($pedidos) {
                        echo view('entregador', ['pedidos' => $pedidos, 'atribuir' => $atribuir, 'value' => '2', 'id' => $entid]);
                    } else {
                        // Usando o Query Builder para buscar outros pedidos do entregador
                        $pedidos = $db->table('pedidos')
                                   ->select('pedidos.*, usuarios.nome as nome_usuario')
                                   ->join('usuarios', 'pedidos.id_usuario = usuarios.id')
                                   ->where('pedidos.status <>', 'Entregue')
                                   ->where('pedidos.status <>', 'Cancelado')



                                   ->where('pedidos.id_entregador', $entid)
                                   ->get()
                                   ->getResult();
                        $atribuir = $db->table('pedidos')
                                   ->select('*')
                                   ->where('status', 'Aguardando entregador')
                                   ->like('vision', '%;'.$entid.';%')
                                   ->get()
                                   ->getResult();

                        echo view('entregador', ['pedidos' => $pedidos, 'atribuir' => $atribuir, 'value' => '1', 'id' => $entid]);
                    }
                } else {
                    header("Location: " . base_url('login'));
                    die();
                }
            } else {
                header("Location: " . base_url('login'));
                die();
            }

        }

    }


public function confirmentregadorapi()
{
    $entid = session()->get('entid');
    $elogin = session()->get('elogin');
    $password = session()->get('password');
    if($entid == "" || $elogin == ""|| $password == "") {
        die();
    } else {
        $db = \Config\Database::connect();
        $logine = $db->table('entregadores')->where('email', $elogin)->where('senha', $password)->countAllResults();
        if ($logine == 1) {

            if(isset($_POST['choice'])){
                $pass = $_POST['choice'];
                #aqui verifica se foi selecionado alterar a senha
                if ($pass === "pass"){
                    $senha = hash('sha3-256', $_POST['senha']);
                    $newsenha = hash('sha3-256', $_POST['newsenha']);
                   $check = $db->table('entregadores')->where('email', $elogin)->where('senha', $senha)->countAllResults();
                   if($check == 1){ 
                   $builder = $db->table('entregadores');
                    $data = ['senha' => $newsenha];
                    $builder->where('senha', $senha);
                    $builder->update($data);
                    echo "alterado com sucesso";}
                    else {echo "senha incorreta";};
                    die();

                }
            }
            if(isset($_POST['doc'])){
            $doc = $_POST['doc'];
            $nome = $_POST['nome'];
            $pedido_id = $_POST['pedidoId'];
            $builder = $db->table('pedidos');
            $data = ['nome_recebedor' => $nome,
                     'doc_recebedor' => $doc,
                     'status' => 'entregue'];
            $builder->where('id', $pedido_id);
            $builder->where('id_entregador', $entid);
            $builder->update($data);
            echo "concluido";}else{
                $builder = $db->table('pedidos');
                $pedido_id = $_POST['pedidoId'];
                $data = ['status' => 'Aguardando coleta',
                         'id_entregador' => $entid,
                         'vision' => '0'
                ];
                $builder->where('id', $pedido_id);
                $builder->update($data);

            }





        } else {
            die();
        }
    }
}

public function download($id, $mes, $ano)
{
    $entid = session()->get('entid');
    $elogin = session()->get('elogin');
    $password = session()->get('password');
    if($entid == "" || $elogin == ""|| $password == "") {
        die();
    } else {
        $db = \Config\Database::connect();
        $logine = $db->table('entregadores')->where('email', $elogin)->where('senha', $password)->countAllResults();
        if ($logine == 1) {
            if ($entid == $id){
        $db = \Config\Database::connect();
        $id_usuario = $entid;
        $mes = $mes;
        $pedidos = $db->table('pedidos')
                ->join('entregadores', 'entregadores.id = pedidos.id_entregador')
                ->where('pedidos.id_entregador', $id_usuario)
                ->where('MONTH(pedidos.date)', $mes)
                ->where('YEAR(pedidos.date)', $ano)
                ->where('pedidos.status', 'entregue')
                ->select('pedidos.*, entregadores.nome as nome_usuario')
                ->get()
                ->getResultArray();

        // Cria uma instância do TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        if (count($pedidos) == 0) {
            $pdf->SetFont('helvetica', '', 12);
            $pdf->AddPage();
            $pdf->Ln();
            $pdf->Write(5, 'Sem entregas');
            $pdf->Output('pedidos_entregador_mes_' . $mes . '.pdf', 'D');
            die();
            return;
        } else {
            // Define o conteúdo do PDF
            $pdf->SetFont('helvetica', '', 12);
            $pdf->AddPage();
            $pdf->Write(5, 'Pedidos do entregador ' . $pedidos[0]['nome_usuario']  . ' no mês ' . $mes . ':');
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
        $pdf->Output('pedidos_entregador_mes_' . $mes . '.pdf', 'D');
    }else{die();}}else{die();}}




}
    public function declineentregadorapi()
    {
        $entid = session()->get('entid');
        $elogin = session()->get('elogin');
        $password = session()->get('password');
        if($entid == "" || $elogin == ""|| $password == "") {
            die();
        } else {
            $db = \Config\Database::connect();
            $logine = $db->table('entregadores')->where('email', $elogin)->where('senha', $password)->countAllResults();
            if ($logine == 1) {
    
                $db->query("UPDATE pedidos SET vision = REPLACE(vision, ';" . $entid . ";', ';')");
    
            } else {
                die();
            }
        }
    }

    public function coletaconfirmapi()
    {
        $entid = session()->get('entid');
        $elogin = session()->get('elogin');
        $password = session()->get('password');
        if($entid == "" || $elogin == ""|| $password == "") {
            die();
        } else {
            $db = \Config\Database::connect();
            $logine = $db->table('entregadores')->where('email', $elogin)->where('senha', $password)->countAllResults();
            if ($logine == 1) {
                $pedidoId = $_POST['pedidoId'];
                $nome = $_POST['nome'];
                $documento = $_POST['documento'];
    
                // Insert the data into the database
                $data = [
                    'doc_env' => $documento,
                    'nome_env' => $nome,
                    'status' => 'Coletado, a caminho'
                ];
    
                $db->table('pedidos')->where('id', $pedidoId)->update($data);
                echo "okay";


            } else {
                die();
            }
        }
    }
}
