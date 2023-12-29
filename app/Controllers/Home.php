<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function rastreio()
    {
        return view('rastreio');
    }
    public function login()
    {
        return view('login');
    }
    public function painel()
    {
        $db = \Config\Database::connect();
        $eid = session()->get('eid');
        $elogin = session()->get('elogin');
        $password = session()->get('password');
        if($eid == "" || $elogin == ""|| $password == "") {
            header("Location: " . base_url('login'));
            die();
        } else {
            $login = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->countAllResults();


            if ($login == 1) {
                $checke = $db->table('usuarios')
                ->where('email', $elogin)
                ->get()->getRow();
                if(password_verify($password, $checke->senha)){
                // Seleciona todos os pedidos da tabela
                $pedidos = $db->table('pedidos')
                        ->where('id_usuario', $eid)
                        ->where('status not like', '%entregue%')
                        ->where('status not like', '%cancelado%')
                        ->get()
                        ->getResult();

                // Passa os dados dos pedidos para a view
                $data = [
                    'pedidos' => $pedidos,
                ];

                // Carrega a view e passa os dados
                return view('painel', $data);

            }else{
                header("Location: " . base_url('login'));
                die();
            }
            } else {
                header("Location: " . base_url('login'));
                die();
            }
        }


    }

    public function post()
    {
        $db = \Config\Database::connect();
        $eid = session()->get('eid');
        $elogin = session()->get('elogin');
        $password = session()->get('password');
        if($eid == "" || $elogin == ""|| $password == "") {
            header("Location: " . base_url('login'));
            die();
        } else {
            $login = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->countAllResults();


            if ($login == 1) {
                $checke = $db->table('entregadores')
                ->where('email', $elogin)
                ->get()->getRow();
                if(password_verify($password, $checke->senha)){
                return view('post');
            }else{
                header("Location: " . base_url('login'));
                die();
            }
            } else {
                header("Location: " . base_url('login'));
                die();
            }
        }


    }
    public function email()
    {
        $nome = $this->request->getPost('name');
        $emailUsuario = $this->request->getPost('email');
        $cpf = $this->request->getPost('cpf');
        $telefone = $this->request->getPost('phone');
        $mensagem = $this->request->getPost('message');

        $arquivoPDF = $this->request->getFile('resume');

        if ($arquivoPDF->isValid() && !$arquivoPDF->hasMoved()) {
            $novoNomeArquivo = $arquivoPDF->getRandomName();

            $arquivoPDF->move(WRITEPATH . 'uploads', $novoNomeArquivo);

            $email = \Config\Services::email();
            $email->setTo('contato@jblogistic.com.br');
            $email->setFrom('contato@jblogistic.com.br');
            $email->setSubject('Comentario Site - ' . $nome);

            $mensagemCorpo = "<p><strong>Nome:</strong> $nome</p>";
            $mensagemCorpo .= "<p><strong>Email:</strong> $emailUsuario</p>";
            $mensagemCorpo .= "<p><strong>CPF:</strong> $cpf</p>";
            $mensagemCorpo .= "<p><strong>Telefone:</strong> $telefone</p>";
            $mensagemCorpo .= "<p><strong>Mensagem:</strong> $mensagem</p>";

            $email->setMessage($mensagemCorpo);

            $caminhoDoPDF = WRITEPATH . 'uploads/' . $novoNomeArquivo;
            $email->attach($caminhoDoPDF);
            
            if ($email->send()) {
                return $this->response->setJSON(['status' => 'success']);
            } else {
                return $this->response->setJSON(['status' => 'error']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Arquivo inválido']);
        }
    
    }

}
