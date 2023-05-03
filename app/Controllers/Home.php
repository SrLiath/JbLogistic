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
            $login = $db->table('usuarios')->where('email', $elogin)->where('senha', $password)->where('id', $eid)->countAllResults();


            if ($login == 1) {

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
            $login = $db->table('usuarios')->where('email', $elogin)->where('senha', $password)->where('id', $eid)->countAllResults();


            if ($login == 1) {
                return view('post');
            } else {
                header("Location: " . base_url('login'));
                die();
            }
        }


    }

}
